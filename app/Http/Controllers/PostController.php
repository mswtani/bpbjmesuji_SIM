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
use Mews\Purifier\Facades\Purifier;
use App\Models\User;

class PostController extends Controller
{

    /**
     * Menampilkan daftar konten.
     */
    public function index(Request $request): View
    {
        /*
        * Jumlah data per halaman.
        */
        $perPage = (int) $request->input(
            'per_page',
            10
        );

        /*
        * Pastikan hanya nilai yang diizinkan.
        */
        if (! in_array(
            $perPage,
            [10, 25, 50, 100]
        )) {
            $perPage = 10;
        }


        $query = Post::with('author')
            ->latest('created_at');


        /*
        * Filter jenis konten.
        */
        if ($request->filled('type')) {

            $query->where(
                'type',
                $request->string('type')->toString()
            );

        }


        /*
        * Filter status.
        */
        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->string('status')->toString()
            );

        }


        /*
        * Filter penulis.
        */
        if ($request->filled('author')) {

            $query->where(
                'author_id',
                $request->integer('author')
            );

        }


        /*
        * Pencarian konten.
        */
        if ($request->filled('search')) {

            $search = $request
                ->string('search')
                ->toString();

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'excerpt',
                    'like',
                    "%{$search}%"
                );

            });

        }


        /*
        * Ambil daftar penulis yang memiliki konten.
        */
        $authors = User::query()
            ->whereIn(
                'id',
                Post::query()
                    ->select('author_id')
                    ->whereNotNull('author_id')
                    ->distinct()
            )
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);


        /*
        * Pagination.
        */
        $posts = $query
            ->paginate($perPage)
            ->withQueryString();


        return view('posts.index', [

            'posts' => $posts,

            'authors' => $authors,

            'perPage' => $perPage,

        ]);
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
        | Default Status Hukum Regulasi
        |--------------------------------------------------------------------------
        */

        if (
            $data['type'] === 'regulation' &&
            empty($data['legal_status'])
        ) {
            $data['legal_status'] = 'berlaku';
        }


        if (in_array($data['type'], ['news', 'announcement'], true)) {
            $data['content'] = Purifier::clean(
                $data['content'],
                'news'
            );

            $data['excerpt'] = Purifier::clean(
                $data['excerpt'] ?? '',
                'news'
            );
        }


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

        $amendedByPostId = $request->input('amended_by_post_id');

        $repealsPostId = $request->input('repeals_post_id');

        $repealedByPostId = $request->input('repealed_by_post_id');


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
            $data['amended_by_post_id'],
            $data['repeals_post_id'],
            $data['repealed_by_post_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Jika bukan Regulasi
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
        | Normalisasi Status Hukum Regulasi
        |--------------------------------------------------------------------------
        */

        if ($data['type'] === 'regulation') {

            if (
                empty($data['legal_status']) ||
                in_array(
                    $data['legal_status'],
                    [
                        'mengubah',
                        'mencabut',
                        'diubah',
                        'dicabut',
                    ],
                    true
                )
            ) {

                $data['legal_status'] = 'berlaku';

            }

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
        | MENGUBAH  : post ini -> regulasi yang diubah
        | DIUBAH    : regulasi yang dipilih -> post ini
        | MENCABUT  : post ini -> regulasi yang dicabut
        | DICABUT   : regulasi yang dipilih -> post ini
        |
        | Untuk hubungan pencabutan:
        |
        | Regulasi yang mencabut
        |     status = mencabut
        |
        | Regulasi yang dicabut
        |     status = tidak_berlaku
        |
        */

        if ($post->type === 'regulation') {

            /*
            |--------------------------------------------------------------------------
            | MENGUBAH
            |--------------------------------------------------------------------------
            */

            if (
                $regulationRelationStatus === 'mengubah' &&
                $amendsPostId
            ) {

                $relatedPost = Post::query()
                    ->where('type', 'regulation')
                    ->whereKeyNot($post->id)
                    ->findOrFail($amendsPostId);

                RegulationRelation::create([
                    'post_id' => $post->id,
                    'related_post_id' => $relatedPost->id,
                    'relation_type' => 'amends',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | DIUBAH
            |--------------------------------------------------------------------------
            */

            elseif (
                $regulationRelationStatus === 'diubah' &&
                $amendedByPostId
            ) {

                $relatedPost = Post::query()
                    ->where('type', 'regulation')
                    ->whereKeyNot($post->id)
                    ->findOrFail($amendedByPostId);

                RegulationRelation::create([
                    'post_id' => $relatedPost->id,
                    'related_post_id' => $post->id,
                    'relation_type' => 'amends',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | MENCABUT
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | Perpres 16 Tahun 2018
            |        mencabut
            |             ↓
            | Perpres 54 Tahun 2010
            |
            */

            elseif (
                $regulationRelationStatus === 'mencabut' &&
                $repealsPostId
            ){

                $relatedPost = Post::query()
                    ->where('type', 'regulation')
                    ->whereKeyNot($post->id)
                    ->findOrFail($repealsPostId);


                /*
                |--------------------------------------------------------------------------
                | Simpan hubungan pencabutan
                |--------------------------------------------------------------------------
                */

                RegulationRelation::create([
                    'post_id' => $post->id,
                    'related_post_id' => $relatedPost->id,
                    'relation_type' => 'repeals',
                ]);


                /*
                |--------------------------------------------------------------------------
                | Regulasi yang dicabut otomatis tidak berlaku
                |--------------------------------------------------------------------------
                */

                $relatedPost->update([
                    'legal_status' => 'tidak_berlaku',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | DICABUT
            |--------------------------------------------------------------------------
            |
            | Contoh ketika membuat regulasi lama:
            |
            | Perpres 54 Tahun 2010
            | status: Dicabut
            |
            | Dicabut oleh:
            | Perpres 16 Tahun 2018
            |
            */

            elseif (
                $regulationRelationStatus === 'dicabut' &&
                $repealedByPostId
            ) {

                $relatedPost = Post::query()
                    ->where('type', 'regulation')
                    ->whereKeyNot($post->id)
                    ->findOrFail($repealedByPostId);


                /*
                |--------------------------------------------------------------------------
                | Simpan hubungan kanonik
                |--------------------------------------------------------------------------
                |
                | Regulasi pencabut -> regulasi yang dicabut
                |
                */

                RegulationRelation::create([
                    'post_id' => $relatedPost->id,
                    'related_post_id' => $post->id,
                    'relation_type' => 'repeals',
                ]);


                /*
                |--------------------------------------------------------------------------
                | Regulasi ini otomatis tidak berlaku
                |--------------------------------------------------------------------------
                */

                $post->update([
                    'legal_status' => 'tidak_berlaku',
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
        abort_if(
            $post->status === 'archived',
            403,
            'Konten yang sudah diarsipkan tidak dapat diedit. Kembalikan ke draft terlebih dahulu.'
        );

        if ($post->status === 'published') {
            abort_unless(
                auth()->user()?->hasPermission('posts.update-published'),
                403,
                'Anda tidak memiliki izin untuk mengedit konten yang sudah dipublikasikan.'
            );
        }

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

        abort_if(
            $post->status === 'archived',
            403,
            'Konten yang sudah diarsipkan tidak dapat diedit. Kembalikan ke draft terlebih dahulu.'
        );

        if ($post->status === 'published') {
            abort_unless(
                auth()->user()?->hasPermission('posts.update-published'),
                403,
                'Anda tidak memiliki izin untuk mengedit konten yang sudah dipublikasikan.'
            );
        }
        /*
        |--------------------------------------------------------------------------
        | Ambil data yang sudah divalidasi
        |--------------------------------------------------------------------------
        */

        $data = $request->validated();


        /*
        |--------------------------------------------------------------------------
        | Default Status Hukum Regulasi
        |--------------------------------------------------------------------------
        |
        | Jika regulasi belum memiliki status hukum,
        | gunakan status hukum yang sudah tersimpan.
        |
        */

        if (
            $data['type'] === 'regulation' &&
            empty($data['legal_status'])
        ) {
            $data['legal_status'] =
                $post->legal_status ?? 'berlaku';
        }


        if (in_array($data['type'], ['news', 'announcement'], true)) {

            $data['content'] = Purifier::clean(
                $data['content'],
                'news'
            );

            $data['excerpt'] = Purifier::clean(
                $data['excerpt'] ?? '',
                'news'
            );
        }


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

        $amendedByPostId = $request->input('amended_by_post_id');

        $repealsPostId = $request->input('repeals_post_id');

        $repealedByPostId = $request->input('repealed_by_post_id');


        /*
        |--------------------------------------------------------------------------
        | Simpan pilihan jenis hubungan regulasi
        |--------------------------------------------------------------------------
        */

        $regulationRelationStatus =
            $data['legal_status'] ?? null;


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

            RegulationRelation::query()
                ->where(function ($query) use ($post) {
                    $query
                        ->where('post_id', $post->id)
                        ->orWhere('related_post_id', $post->id);
                })
                ->delete();

        }


       /*
        |--------------------------------------------------------------------------
        | Simpan hubungan pencabutan lama
        |--------------------------------------------------------------------------
        |
        | Digunakan untuk mengembalikan status regulasi lama apabila
        | hubungan pencabutan diubah atau dihapus.
        |
        */

        $previousRepealedPostIds = [];

        if ($post->type === 'regulation') {

            $previousRepealedPostIds = RegulationRelation::query()
                ->where('post_id', $post->id)
                ->where('relation_type', 'repeals')
                ->pluck('related_post_id')
                ->all();
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
        | MENGUBAH:
        |   post ini -> regulasi yang diubah
        |
        | DIUBAH:
        |   regulasi yang dipilih -> post ini
        |
        | MENCABUT:
        |   post ini -> regulasi yang dicabut
        |
        | DICABUT:
        |   regulasi yang dipilih -> post ini
        |
        | Database tetap menggunakan satu arah kanonik:
        |
        |   source -> target
        |
        | relation_type:
        |   amends
        |   repeals
        |
        */

        if ($data['type'] === 'regulation') {

            /*
            |--------------------------------------------------------------------------
            | Hapus hubungan KELUAR yang dibuat oleh regulasi ini
            |--------------------------------------------------------------------------
            |
            | Jangan menghapus hubungan masuk.
            |
            | Ini penting untuk rantai:
            |
            | 16/2018
            |    ↑
            | 12/2021
            |    ↑
            | 46/2025
            |
            */

            RegulationRelation::query()
                ->where('post_id', $post->id)
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | Kembalikan status regulasi yang sebelumnya dicabut
            |--------------------------------------------------------------------------
            |
            | Jika hubungan pencabutan lama dihapus atau diganti,
            | regulasi lama dikembalikan menjadi "berlaku".
            |
            */

            if (!empty($previousRepealedPostIds)) {

                Post::query()
                    ->whereIn('id', $previousRepealedPostIds)
                    ->update([
                        'legal_status' => 'berlaku',
                    ]);
            }


            /*
            |--------------------------------------------------------------------------
            | MENGUBAH
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | 12/2021 -> 16/2018
            |
            */

            if (
                ($data['legal_status'] ?? null) === 'mengubah' &&
                $amendsPostId
            ) {

                $relatedPost = Post::query()
                    ->where('type', 'regulation')
                    ->whereKeyNot($post->id)
                    ->findOrFail($amendsPostId);

                RegulationRelation::updateOrCreate(
                    [
                        'post_id' => $post->id,
                        'related_post_id' => $relatedPost->id,
                        'relation_type' => 'amends',
                    ]
                );
            }


            /*
            |--------------------------------------------------------------------------
            | DIUBAH
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | 12/2021 -> 16/2018
            |
            | Ketika sedang edit 16/2018:
            |
            | Diubah oleh = 12/2021
            |
            */

            elseif (
                ($data['legal_status'] ?? null) === 'diubah' &&
                $amendedByPostId
            ) {

                $relatedPost = Post::query()
                    ->where('type', 'regulation')
                    ->whereKeyNot($post->id)
                    ->findOrFail($amendedByPostId);

                RegulationRelation::updateOrCreate(
                    [
                        'post_id' => $relatedPost->id,
                        'related_post_id' => $post->id,
                        'relation_type' => 'amends',
                    ]
                );
            }


            /*
            |--------------------------------------------------------------------------
            | MENCABUT
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | 16/2018 -> 54/2010
            |
            */

            elseif (
                ($data['legal_status'] ?? null) === 'mencabut' &&
                $repealsPostId
            ) {

                $relatedPost = Post::query()
                    ->where('type', 'regulation')
                    ->whereKeyNot($post->id)
                    ->findOrFail($repealsPostId);


                RegulationRelation::updateOrCreate(
                    [
                        'post_id' => $post->id,
                        'related_post_id' => $relatedPost->id,
                        'relation_type' => 'repeals',
                    ]
                );


                /*
                |--------------------------------------------------------------------------
                | Otomatis ubah status regulasi yang dicabut
                |--------------------------------------------------------------------------
                */

                $relatedPost->update([
                    'legal_status' => 'tidak_berlaku',
                ]);

            }


            /*
            |--------------------------------------------------------------------------
            | DICABUT
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | 16/2018 -> 54/2010
            |
            | Ketika sedang edit 54/2010:
            |
            | Dicabut oleh = 16/2018
            |
            | Maka kita membuat:
            |
            | post_id         = 16
            | related_post_id = 54
            | relation_type   = repeals
            |
            */

            elseif (
                ($data['legal_status'] ?? null) === 'dicabut' &&
                $repealedByPostId
            ) {

                $relatedPost = Post::query()
                    ->where('type', 'regulation')
                    ->whereKeyNot($post->id)
                    ->findOrFail($repealedByPostId);


                /*
                |--------------------------------------------------------------------------
                | Hapus hubungan pencabutan lama yang menuju regulasi ini
                |--------------------------------------------------------------------------
                |
                | Untuk pencabutan, satu regulasi dianggap memiliki satu
                | regulasi pencabut utama.
                |
                */

                RegulationRelation::query()
                    ->where('related_post_id', $post->id)
                    ->where('relation_type', 'repeals')
                    ->delete();


                RegulationRelation::create([
                    'post_id' => $relatedPost->id,
                    'related_post_id' => $post->id,
                    'relation_type' => 'repeals',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Regulasi ini otomatis tidak berlaku
                |--------------------------------------------------------------------------
                */

                $post->update([
                    'legal_status' => 'tidak_berlaku',
                ]);

            }
            
        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('posts.show', $post);
            
    }


    /**
     * Menghapus konten.
     */
    public function destroy(Post $post): RedirectResponse
    {
        abort_unless(
            $post->status === 'draft',
            403,
            'Konten yang sudah dipublikasikan atau diarsipkan tidak dapat dihapus. Silakan gunakan fitur arsip untuk konten yang sudah dipublikasikan.'
        );
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
        | Hapus seluruh hubungan regulasi
        |--------------------------------------------------------------------------
        */

        RegulationRelation::query()
            ->where(function ($query) use ($post) {
                $query
                    ->where('post_id', $post->id)
                    ->orWhere('related_post_id', $post->id);
            })
            ->delete();


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
        abort_unless(
            $post->status === 'draft',
            422,
            'Hanya konten yang masih berstatus draft yang dapat dipublikasikan.'
        );

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
            ! auth()->check() &&
            (
                $post->status !== 'published' ||
                ! $post->published_at
            )
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

        $extension = strtolower(
            pathinfo(
                $post->document_path,
                PATHINFO_EXTENSION
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Preview hanya PDF
        |--------------------------------------------------------------------------
        */

        if ($extension !== 'pdf') {
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
     * Download dokumen regulasi.
     */
    public function downloadDocument(Post $post)
    {
        if (
            $post->type !== 'regulation' ||
            ! $post->document_path
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Dokumen publik hanya boleh diakses jika sudah published.
        |--------------------------------------------------------------------------
        |
        | Operator yang sudah login tetap dapat mengakses dokumen,
        | termasuk dokumen yang belum dipublikasikan.
        |
        */

        if (
            ! auth()->check() &&
            (
                $post->status !== 'published' ||
                ! $post->published_at
            )
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

        $extension = strtolower(
            pathinfo($post->document_path, PATHINFO_EXTENSION)
        );

        $filename = trim($post->title);

        // Bersihkan karakter yang tidak diperbolehkan dalam nama file.
        $filename = str_replace(
            ['/', '\\'],
            '-',
            $filename
        );

        // Hilangkan karakter kontrol dan rapikan spasi.
        $filename = preg_replace(
            '/[\x00-\x1F\x7F]/u',
            '',
            $filename
        );

        $filename = preg_replace(
            '/\s+/u',
            ' ',
            $filename
        );

        $filename = trim(
            $filename,
            " ."
        );

        if ($extension !== '') {
            $filename .= '.' . $extension;
        }

        return Storage::disk('public')->download(
            $post->document_path,
            $filename
        );
    }


    /**
     * Arsipkan konten.
     */
    public function archive(Post $post): RedirectResponse
    {
        abort_unless(
            $post->status === 'published',
            422,
            'Hanya konten yang sudah dipublikasikan yang dapat diarsipkan.'
        );

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
     * Mengembalikan konten yang diarsipkan menjadi draft.
     */
    public function restore(Post $post): RedirectResponse
    {
        abort_unless(
            $post->status === 'archived',
            422,
            'Hanya konten yang diarsipkan yang dapat dikembalikan menjadi draft.'
        );

        $post->update([
            'status' => 'draft',
            'published_at' => null,
        ]);

        return redirect()
            ->route('posts.show', $post)
            ->with(
                'success',
                'Konten berhasil dikembalikan menjadi draft.'
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

        abort_if(
            $post->status === 'archived',
            403,
            'Konten yang sudah diarsipkan tidak dapat diubah. Kembalikan ke draft terlebih dahulu.'
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

        abort_if(
            $post->status === 'archived',
            403,
            'Konten yang sudah diarsipkan tidak dapat diubah. Kembalikan ke draft terlebih dahulu.'
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