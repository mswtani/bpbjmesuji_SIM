<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicProfileController extends Controller
{
    /**
     * Halaman profil BPBJ Kabupaten Mesuji.
     */
    public function index(): View
    {
        return view('public.profile.index');
    }
}