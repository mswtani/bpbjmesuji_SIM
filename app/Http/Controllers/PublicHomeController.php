<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Post;
use Illuminate\View\View;

class PublicHomeController extends Controller
{
    public function index(): View
    {
        $carousels = Carousel::query()
            ->with([
                'post' => function ($query) {
                    $query->where('status', 'published');
                },
            ])
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->whereHas('post', function ($query) {
                $query->where('status', 'published');
            })
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $posts = Post::query()
            ->where('status', 'published')
            ->where('type', '!=', 'regulation')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        $regulations = Post::query()
            ->with('regulationType')
            ->where('status', 'published')
            ->where('type', 'regulation')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        return view('public.index', compact(
            'carousels',
            'posts',
            'regulations'
        ));
    }
}