<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarouselRequest;
use App\Http\Requests\UpdateCarouselRequest;
use App\Models\Carousel;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CarouselController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless(
            auth()->user()?->hasPermission('carousels.view'),
            403
        );

        $query = Carousel::query()
            ->with('post');

        // filter/search Anda yang sudah ada tetap di sini

        $perPage = (int) $request->input('per_page', 10);

        if (! in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        $carousels = $query
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('carousels.index', compact(
            'carousels',
            'perPage'
        ));
    }

    public function create(): View
    {
        abort_unless(
            auth()->user()?->hasPermission('carousels.create'),
            403
        );

        $posts = $this->availablePosts();

        $nextSortOrder = (Carousel::max('sort_order') ?? 0) + 1;

        return view('carousels.create', compact(
            'posts',
            'nextSortOrder'
        ));
    }

    public function store(StoreCarouselRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['show_overlay'] = $request->boolean('show_overlay');

        $data['banner'] = $request
            ->file('banner')
            ->store('carousels', 'public');

        /*
         * Kalau caption bukan custom,
         * data custom tidak diperlukan.
         */
        if ($data['caption_type'] !== 'custom') {
            $data['custom_title'] = null;
            $data['custom_description'] = null;
        }

        /*
         * Kalau tombol disembunyikan,
         * button_text tidak diperlukan.
         */
        if (!$data['show_button']) {
            $data['button_text'] = 'Baca Selengkapnya';
        }

        Carousel::create($data);

        return redirect()
            ->route('carousels.index')
            ->with('success', 'Carousel berhasil ditambahkan.');
    }

    public function edit(Carousel $carousel): View
    {
        abort_unless(
            auth()->user()?->hasPermission('carousels.update'),
            403
        );

        $carousel->load('post');

        $posts = $this->availablePosts($carousel);

        return view('carousels.edit', compact(
            'carousel',
            'posts'
        ));
    }

    public function update(
        UpdateCarouselRequest $request,
        Carousel $carousel
    ): RedirectResponse {
        $data = $request->validated();

        $data['show_overlay'] = $request->boolean('show_overlay');

        /*
         * Simpan banner lama.
         */
        $oldBanner = $carousel->banner;

        /*
         * Upload banner baru jika admin memilih file baru.
         */
        if ($request->hasFile('banner')) {
            $data['banner'] = $request
                ->file('banner')
                ->store('carousels', 'public');
        } else {
            unset($data['banner']);
        }

        /*
         * Caption auto / none tidak menggunakan
         * custom title dan description.
         */
        if ($data['caption_type'] !== 'custom') {
            $data['custom_title'] = null;
            $data['custom_description'] = null;
        }

        /*
         * Jika tombol dimatikan, kita tidak perlu
         * menggunakan teks tombol sebelumnya.
         */
        if (!$data['show_button']) {
            $data['button_text'] = 'Baca Selengkapnya';
        }

        $carousel->update($data);

        /*
         * Hapus banner lama setelah update berhasil
         * dan hanya jika memang ada banner baru.
         */
        if (
            isset($data['banner'])
            && $oldBanner
            && Storage::disk('public')->exists($oldBanner)
        ) {
            Storage::disk('public')->delete($oldBanner);
        }

        return redirect()
            ->route('carousels.index')
            ->with('success', 'Carousel berhasil diperbarui.');
    }

    public function destroy(Carousel $carousel): RedirectResponse
    {
        abort_unless(
            auth()->user()?->hasPermission('carousels.delete'),
            403
        );

        $banner = $carousel->banner;

        $carousel->delete();

        if (
            $banner
            && Storage::disk('public')->exists($banner)
        ) {
            Storage::disk('public')->delete($banner);
        }

        return redirect()
            ->route('carousels.index')
            ->with('success', 'Carousel berhasil dihapus.');
    }

    /**
     * Post yang dapat dipilih sebagai Carousel.
     */
    private function availablePosts(?Carousel $carousel = null)
    {
        return Post::query()
            ->where('status', 'published')
            ->whereIn('type', [
                'news',
                'announcement',
                'regulation',
            ])
            ->where(function ($query) use ($carousel) {
                $query->whereDoesntHave('carousel');

                if ($carousel) {
                    $query->orWhere('id', $carousel->post_id);
                }
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();
    }
}