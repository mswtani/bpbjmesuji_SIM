<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\RegulationRelation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Menampilkan daftar konten.
     */
    public function index(): View
    {
        $posts = Post::with([
                'author',
                'regulationType',
            ])
            ->latest()
            ->paginate(15);

        return view('posts.index', compact('posts'));
    }


    /**
     * Menampilkan form tambah konten.
     */
    public function create(): View
    {
        $regulations = Post::query()
            ->where('type', 'regulation')
            ->orderByDesc('regulation_year')
            ->orderBy('title')
            ->get();

        return view('posts.create', [
            'regulations' => $regulations,
        ]);
    }


    /**
     * Menyimpan konten baru sebagai draft.
     */
    public function store(
        StorePostRequest $request
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Ambil data yang sudah divalidasi
        |--------------------------------------------------------------------------
        */

        $data = $request->validated();


        /*
        |--------------------------------------------------------------------------
        | Ambil data hubungan regulasi
        |--------------------------------------------------------------------------
        |
        | Field ini digunakan untuk regulation_relations,
        | bukan untuk tabel posts.
        |
        */

        $amendsPostId = $request->input('amends_post_id');

        $repealsPostId = $request->input('repeals_post_id');


        /*
        |--------------------------------------------------------------------------
        | Author
        |--------------------------------------------------------------------------
        */

        $data['author_id'] =
            $request->user()->id;


        /*
        |--------------------------------------------------------------------------
        | Status awal selalu Draft
        |--------------------------------------------------------------------------
        */

        $data['status'] = 'draft';

        $data['published_at'] = null;


        /*
        |--------------------------------------------------------------------------
        | Slug otomatis
        |--------------------------------------------------------------------------
        */

        if (empty($data['slug'])) {

            $data['slug'] =
                Str::slug($data['title']);
        }


        /*
        |--------------------------------------------------------------------------
        | Upload gambar utama
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('featured_image')) {

            $data['featured_image'] =
                $request
                    ->file('featured_image')
                    ->store(
                        'posts',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Upload dokumen PDF Regulasi
        |--------------------------------------------------------------------------
        */

        if (
            $request->input('type') === 'regulation' &&
            $request->hasFile('document')
        ) {

            $file =
                $request->file('document');


            $path =
                $file->store(
                    'posts/documents',
                    'public'
                );


            $data['document_path'] =
                $path;


            $data['document_original_name'] =
                $file->getClientOriginalName();


            $data['document_size'] =
                $file->getSize();
        }


        /*
        |--------------------------------------------------------------------------
        | Jangan pernah menyimpan field upload "document"
        | langsung ke database.
        |--------------------------------------------------------------------------
        */

        unset($data['document']);


        /*
        |--------------------------------------------------------------------------
        | Jangan pernah menyimpan field hubungan regulasi
        | langsung ke tabel posts.
        |--------------------------------------------------------------------------
        */

        unset(
            $data['amends_post_id'],
            $data['repeals_post_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Jika bukan Regulasi
        |--------------------------------------------------------------------------
        |
        | Bersihkan seluruh metadata regulasi.
        |--------------------------------------------------------------------------
        */

        if ($data['type'] !== 'regulation') {

            $data['regulation_type_id'] = null;

            $data['regulation_number'] = null;

            $data['regulation_year'] = null;

            $data['regulation_date'] = null;

            $data['legal_status'] = null;

            $data['document_path'] = null;

            $data['document_original_name'] = null;

            $data['document_size'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan Post
        |--------------------------------------------------------------------------
        */

        $post = Post::create($data);


        /*
        |--------------------------------------------------------------------------
        | Simpan Hubungan Regulasi
        |--------------------------------------------------------------------------
        |
        | Hanya Regulasi yang mempunyai hubungan.
        |
        */

        if ($post->type === 'regulation') {

            /*
            |--------------------------------------------------------------------------
            | Status DIUBAH
            |--------------------------------------------------------------------------
            */

            if (
                $post->legal_status === 'diubah' &&
                $amendsPostId
            ) {

                $relatedPost =
                    Post::query()
                        ->where(
                            'type',
                            'regulation'
                        )
                        ->whereKeyNot($post->id)
                        ->findOrFail(
                            $amendsPostId
                        );


                RegulationRelation::create([

                    'post_id' =>
                        $post->id,

                    'related_post_id' =>
                        $relatedPost->id,

                    'relation_type' =>
                        'amends',

                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Status DICABUT
            |--------------------------------------------------------------------------
            */

            elseif (
                $post->legal_status === 'dicabut' &&
                $repealsPostId
            ) {

                $relatedPost =
                    Post::query()
                        ->where(
                            'type',
                            'regulation'
                        )
                        ->whereKeyNot($post->id)
                        ->findOrFail(
                            $repealsPostId
                        );


                RegulationRelation::create([

                    'post_id' =>
                        $post->id,

                    'related_post_id' =>
                        $relatedPost->id,

                    'relation_type' =>
                        'repeals',

                ]);
            }

        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'posts.show',
                $post
            )
            ->with(
                'success',
                'Konten berhasil disimpan sebagai draft.'
            );
    }


    /**
     * Menampilkan detail konten.
     */
    public function show(Post $post): View
{
        $post->load([
            'author',
            'regulationType',
            'regulationRelations.relatedPost',
            'amendedBy.post',
            'repealedBy.post',
        ]);

        return view('posts.show', compact('post'));
    }


    /**
     * Menampilkan form edit konten.
     */
    public function edit(Post $post): View
    {
        $post->load([
            'author',
            'regulationType',
            'regulationRelations.relatedPost',
            'amendments.relatedPost',
            'repeals.relatedPost',
        ]);

        $regulations = Post::query()
            ->where('type', 'regulation')
            ->whereKeyNot($post->id)
            ->orderByDesc('regulation_year')
            ->orderBy('title')
            ->get();

        return view('posts.edit', [
            'post' => $post,
            'regulations' => $regulations,
        ]);
    }


    /**
     * Memperbarui konten.
     */
    /**
 * Memperbarui konten.
 */
    public function update(
        UpdatePostRequest $request,
        Post $post
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Ambil data yang sudah divalidasi
        |--------------------------------------------------------------------------
        */

        $data = $request->validated();


        /*
        |--------------------------------------------------------------------------
        | Ambil data hubungan regulasi dari request
        |--------------------------------------------------------------------------
        |
        | Field ini hanya digunakan untuk mengelola
        | regulation_relations dan tidak disimpan
        | langsung ke tabel posts.
        |
        */

        $amendsPostId = $request->input('amends_post_id');
        $repealsPostId = $request->input('repeals_post_id');


        /*
        |--------------------------------------------------------------------------
        | Slug otomatis
        |--------------------------------------------------------------------------
        */

        if (empty($data['slug'])) {

            $data['slug'] =
                Str::slug($data['title']);
        }


        /*
        |--------------------------------------------------------------------------
        | Upload gambar baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('featured_image')) {

            /*
            |--------------------------------------------------------------------------
            | Hapus gambar lama
            |--------------------------------------------------------------------------
            */

            if (
                $post->featured_image &&
                Storage::disk('public')->exists(
                    $post->featured_image
                )
            ) {

                Storage::disk('public')->delete(
                    $post->featured_image
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Simpan gambar baru
            |--------------------------------------------------------------------------
            */

            $data['featured_image'] =
                $request
                    ->file('featured_image')
                    ->store(
                        'posts',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Upload PDF Regulasi baru
        |--------------------------------------------------------------------------
        */

        if (
            $data['type'] === 'regulation' &&
            $request->hasFile('document')
        ) {

            $file = $request->file('document');


            /*
            |--------------------------------------------------------------------------
            | Hapus PDF lama
            |--------------------------------------------------------------------------
            */

            if (
                $post->document_path &&
                Storage::disk('public')->exists(
                    $post->document_path
                )
            ) {

                Storage::disk('public')->delete(
                    $post->document_path
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Simpan PDF baru
            |--------------------------------------------------------------------------
            */

            $data['document_path'] =
                $file->store(
                    'posts/documents',
                    'public'
                );


            $data['document_original_name'] =
                $file->getClientOriginalName();


            $data['document_size'] =
                $file->getSize();
        }


        /*
        |--------------------------------------------------------------------------
        | Jangan masukkan field upload document
        | ke database.
        |--------------------------------------------------------------------------
        */

        unset($data['document']);


        /*
        |--------------------------------------------------------------------------
        | Jika type bukan Regulasi
        |--------------------------------------------------------------------------
        |
        | Metadata regulasi, PDF, dan hubungan regulasi
        | harus dibersihkan.
        |
        */

        if ($data['type'] !== 'regulation') {

            /*
            |--------------------------------------------------------------------------
            | Hapus PDF jika sebelumnya adalah Regulasi
            |--------------------------------------------------------------------------
            */

            if (
                $post->document_path &&
                Storage::disk('public')->exists(
                    $post->document_path
                )
            ) {

                Storage::disk('public')->delete(
                    $post->document_path
                );
            }


            $data['regulation_type_id'] = null;

            $data['regulation_number'] = null;

            $data['regulation_year'] = null;

            $data['regulation_date'] = null;

            $data['legal_status'] = null;

            $data['document_path'] = null;

            $data['document_original_name'] = null;

            $data['document_size'] = null;


            /*
            |--------------------------------------------------------------------------
            | Bukan Regulasi → hapus seluruh hubungan
            |--------------------------------------------------------------------------
            */

            $post->regulationRelations()->delete();

        }


        /*
        |--------------------------------------------------------------------------
        | Update Post
        |--------------------------------------------------------------------------
        */

        $post->update($data);


        /*
        |--------------------------------------------------------------------------
        | Sinkronisasi Hubungan Regulasi
        |--------------------------------------------------------------------------
        |
        | Hanya berlaku untuk konten bertipe regulation.
        |
        */

        if ($data['type'] === 'regulation') {

            /*
            |--------------------------------------------------------------------------
            | Hapus hubungan lama terlebih dahulu
            |--------------------------------------------------------------------------
            |
            | Dengan cara ini kita mencegah:
            |
            | repeals lama tetap tersisa ketika status
            | berubah menjadi amends.
            |
            */

            $post->regulationRelations()->delete();


            /*
            |--------------------------------------------------------------------------
            | Status BERLAKU / TIDAK BERLAKU
            |--------------------------------------------------------------------------
            |
            | Tidak boleh mempunyai hubungan regulasi.
            |
            */

            if (
                in_array(
                    $data['legal_status'] ?? null,
                    [
                        'berlaku',
                        'tidak_berlaku',
                    ],
                    true
                )
            ) {

                // Tidak membuat relation apa pun.

            }


            /*
            |--------------------------------------------------------------------------
            | Status DIUBAH
            |--------------------------------------------------------------------------
            */

            elseif (
                ($data['legal_status'] ?? null) === 'diubah' &&
                $amendsPostId
            ) {

                $relatedPost =
                    Post::query()
                        ->where('type', 'regulation')
                        ->whereKeyNot($post->id)
                        ->findOrFail($amendsPostId);


                RegulationRelation::create([

                    'post_id' =>
                        $post->id,

                    'related_post_id' =>
                        $relatedPost->id,

                    'relation_type' =>
                        'amends',

                ]);

            }


            /*
            |--------------------------------------------------------------------------
            | Status DICABUT
            |--------------------------------------------------------------------------
            */

            elseif (
                ($data['legal_status'] ?? null) === 'dicabut' &&
                $repealsPostId
            ) {

                $relatedPost =
                    Post::query()
                        ->where('type', 'regulation')
                        ->whereKeyNot($post->id)
                        ->findOrFail($repealsPostId);


                RegulationRelation::create([

                    'post_id' =>
                        $post->id,

                    'related_post_id' =>
                        $relatedPost->id,

                    'relation_type' =>
                        'repeals',

                ]);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('posts.show', $post)
            ->with(
                'success',
                'Konten berhasil diperbarui.'
            );
    }


    /**
     * Menghapus konten.
     */
    public function destroy(Post $post): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus gambar utama
        |--------------------------------------------------------------------------
        */

        if (
            $post->featured_image &&
            Storage::disk('public')->exists(
                $post->featured_image
            )
        ) {

            Storage::disk('public')->delete(
                $post->featured_image
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus dokumen PDF Regulasi
        |--------------------------------------------------------------------------
        */

        if (
            $post->document_path &&
            Storage::disk('public')->exists(
                $post->document_path
            )
        ) {

            Storage::disk('public')->delete(
                $post->document_path
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus Post
        |--------------------------------------------------------------------------
        */

        $post->delete();


        return redirect()
            ->route('posts.index')
            ->with(
                'success',
                'Konten berhasil dihapus.'
            );
    }


    /**
     * Publish konten.
     */
    public function publish(Post $post): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Regulasi wajib mempunyai PDF
        |--------------------------------------------------------------------------
        */

        if (
            $post->type === 'regulation' &&
            ! $post->document_path
        ) {

            return back()->with(
                'error',
                'Regulasi tidak dapat dipublish karena dokumen PDF belum diunggah.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Publish
        |--------------------------------------------------------------------------
        */

        $post->update([
            'status' => 'published',
            'published_at' => now(),
        ]);


        return redirect()
            ->route('posts.show', $post)
            ->with(
                'success',
                'Konten berhasil dipublikasikan.'
            );
    }




    /**
     * Preview dokumen PDF regulasi.
     */
    public function previewDocument(Post $post)
    {
        if (
            $post->type !== 'regulation' ||
            ! $post->document_path
        ) {
            abort(404);
        }

        if (
            ! Storage::disk('public')->exists(
                $post->document_path
            )
        ) {
            abort(404);
        }

        return Storage::disk('public')->response(
            $post->document_path,
            $post->document_original_name ?? 'dokumen-regulasi.pdf',
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline',
            ]
        );
    }


    /**
     * Download dokumen PDF regulasi.
     */
    public function downloadDocument(Post $post)
    {
        if (
            $post->type !== 'regulation' ||
            ! $post->document_path
        ) {
            abort(404);
        }

        if (
            ! Storage::disk('public')->exists(
                $post->document_path
            )
        ) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $post->document_path,
            $post->document_original_name ?? 'dokumen-regulasi.pdf'
        );
    }


    /**
     * Arsipkan konten.
     */
    public function archive(Post $post): RedirectResponse
    {
        $post->update([
            'status' => 'archived',
        ]);


        return redirect()
            ->route('posts.show', $post)
            ->with(
                'success',
                'Konten berhasil diarsipkan.'
            );
    }


    /**
     * Relasi hubungan regulasi Menyimpan Hubungan.
     */

    public function storeRelation(
        Request $request,
        Post $post
    ): RedirectResponse {
        abort_unless(
            $post->type === 'regulation',
            404
        );

        $data = $request->validate([
            'related_post_id' => [
                'required',
                'integer',
                'exists:posts,id',
            ],

            'relation_type' => [
                'required',
                'string',
                'in:amends,repeals',
            ],
        ]);

        $relatedPost = Post::findOrFail(
            $data['related_post_id']
        );

        abort_unless(
            $relatedPost->type === 'regulation',
            422
        );

        abort_if(
            $relatedPost->id === $post->id,
            422,
            'Regulasi tidak dapat berhubungan dengan dirinya sendiri.'
        );

        RegulationRelation::updateOrCreate(
            [
                'post_id' => $post->id,
                'related_post_id' => $relatedPost->id,
                'relation_type' => $data['relation_type'],
            ]
        );

        return redirect()
            ->route('posts.show', $post)
            ->with(
                'success',
                'Hubungan regulasi berhasil ditambahkan.'
            );
    }


    /**
     * Relasi hubungan regulasi Menghapus Hubungan.
     */
    public function destroyRelation(
        Post $post,
        RegulationRelation $relation
    ): RedirectResponse {
        abort_unless(
            $relation->post_id === $post->id,
            403
        );

        $relation->delete();

        return redirect()
            ->route('posts.show', $post)
            ->with(
                'success',
                'Hubungan regulasi berhasil dihapus.'
            );
    }

}