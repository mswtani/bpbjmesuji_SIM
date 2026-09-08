<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicPostController extends Controller
{
    /**
     * Daftar berita.
     */
    // public function news(): View
    // {
    //     $posts = Post::query()
    //         ->with('author')
    //         ->where('type', 'news')
    //         ->where('status', 'published')
    //         ->whereNotNull('published_at')
    //         ->latest('published_at')
    //         ->paginate(9);

    //     return view('public.posts.index', [
    //         'posts' => $posts,
    //         'type' => 'news',
    //         'pageTitle' => 'Berita',
    //         'pageDescription' => 'Berita dan informasi terbaru.',
    //     ]);
    // }
    /**
     * Pencarian seluruh konten publik.
     */
    public function search(Request $request): View
    {
        $search = trim($request->query('q', ''));

        $posts = Post::query()
            ->with([
                'author',
                'regulationType',
            ])
            ->whereIn('type', [
                'news',
                'announcement',
                'regulation',
            ])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->when(
                $search !== '',
                fn ($query) => $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                })
            )
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('public.search', [
            'posts' => $posts,
            'search' => $search,
        ]);
    }

   public function news(Request $request): View
    {
        $type = $request->query('type', 'all');
        $search = trim($request->query('search', ''));

        $posts = Post::query()
            ->with('author')
            ->whereIn('type', ['news', 'announcement'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->when(
                in_array($type, ['news', 'announcement'], true),
                fn ($query) => $query->where('type', $type)
            )
            ->when(
                $search !== '',
                fn ($query) => $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%');
                })
            )
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('public.posts.index', [
            'posts' => $posts,
            'type' => $type,
            'search' => $search,
            'pageTitle' => 'Berita & Pengumuman',
            'pageDescription' => 'Berita dan informasi resmi terbaru dari BPBJ Kabupaten Mesuji.',
        ]);
    }

    /**
     * Detail berita.
     */
    public function newsShow(string $slug): View
    {
        $post = Post::query()
            ->with('author')
            ->whereIn('type', ['news', 'announcement'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Daftar pengumuman.
     */
    // public function announcements(): View
    // {
    //     $posts = Post::query()
    //         ->with('author')
    //         ->where('type', 'announcement')
    //         ->where('status', 'published')
    //         ->whereNotNull('published_at')
    //         ->latest('published_at')
    //         ->paginate(9);

    //     return view('public.posts.index', [
    //         'posts' => $posts,
    //         'type' => 'announcement',
    //         'pageTitle' => 'Pengumuman',
    //         'pageDescription' => 'Pengumuman dan informasi resmi.',
    //     ]);
    // }

    /**
     * Daftar pengumuman.
     */
    public function announcements(Request $request): View
    {
        $type = 'announcement';
        $search = trim($request->query('search', ''));

        $posts = Post::query()
            ->with('author')
            ->where('type', 'announcement')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->when(
                $search !== '',
                fn ($query) => $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%');
                })
            )
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('public.posts.index', [
            'posts' => $posts,
            'type' => $type,
            'search' => $search,
            'pageTitle' => 'Pengumuman',
            'pageDescription' => 'Pengumuman dan informasi resmi terbaru dari BPBJ Kabupaten Mesuji.',
        ]);
    }

    /**
     * Detail pengumuman.
     */
    // public function announcementShow(string $slug): View
    // {
    //     $post = Post::query()
    //         ->with('author')
    //         ->where('type', 'announcement')
    //         ->where('status', 'published')
    //         ->whereNotNull('published_at')
    //         ->where('slug', $slug)
    //         ->firstOrFail();

    //     return view('public.posts.show', [
    //         'post' => $post,
    //     ]);
    // }

    /**
     * Daftar regulasi.
     */
    public function regulations(): View
    {
        $query = Post::query()
            ->with('regulationType')
            ->where('type', 'regulation')
            ->where('status', 'published')
            ->whereNotNull('published_at');


        /*
        |--------------------------------------------------------------------------
        | Pencarian
        |--------------------------------------------------------------------------
        */

        $search = request('q');

        if ($search) {

            $query->where(function ($builder) use ($search) {

                $builder
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere(
                        'regulation_number',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'excerpt',
                        'like',
                        '%' . $search . '%'
                    );

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Filter Jenis Regulasi
        |--------------------------------------------------------------------------
        */

        $regulationType = request('regulation_type');

        if ($regulationType) {

            $query->where(
                'regulation_type_id',
                $regulationType
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Filter Tahun
        |--------------------------------------------------------------------------
        */

        $year = request('year');

        if ($year) {

            $query->where(
                'regulation_year',
                $year
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Filter Status Hukum
        |--------------------------------------------------------------------------
        */

        $legalStatus = request('legal_status');

        if ($legalStatus) {

            $query->where(
                'legal_status',
                $legalStatus
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Data filter
        |--------------------------------------------------------------------------
        */

        $regulationTypes = \App\Models\RegulationType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();


        $years = Post::query()
            ->where('type', 'regulation')
            ->where('status', 'published')
            ->whereNotNull('regulation_year')
            ->distinct()
            ->orderByDesc('regulation_year')
            ->pluck('regulation_year');


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $posts = $query
            ->latest('regulation_year')
            ->latest('regulation_date')
            ->paginate(12)
            ->withQueryString();


        return view('public.regulations.index', [
            'posts' => $posts,
            'regulationTypes' => $regulationTypes,
            'years' => $years,
            'pageTitle' => 'Regulasi',
            'pageDescription' => 'Jaringan Dokumentasi dan Informasi Hukum.',
        ]);
    }

    /**
     * Detail regulasi.
     */
    public function regulationShow(string $slug): View
    {
        $post = Post::query()
            ->with([
                'author',
                'regulationType',

                // Regulasi yang diubah/dicabut oleh regulasi ini
                'amendments.relatedPost',
                'repeals.relatedPost',

                // Regulasi yang mengubah/mencabut regulasi ini
                'amendedBy.post',
                'repealedBy.post',
            ])
            ->where('type', 'regulation')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.regulations.show', [
            'post' => $post,
        ]);
    }
}