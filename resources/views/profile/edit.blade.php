@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Profil Saya
            </h1>

            <p class="mt-1 text-sm text-gray-600">
                Kelola informasi profil dan keamanan akun Anda.
            </p>
        </div>


        {{-- Informasi Profil --}}
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <div class="p-6 sm:p-8">

                @include('profile.partials.update-profile-information-form')

            </div>
        </div>


        {{-- Ganti Password --}}
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <div class="p-6 sm:p-8">

                @include('profile.partials.update-password-form')

            </div>
        </div>


        {{-- Hapus Akun --}}
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <div class="p-6 sm:p-8">

                @include('profile.partials.delete-user-form')

            </div>
        </div>

    </div>

@endsection