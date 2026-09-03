<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Jabatan yang dapat dipilih saat pendaftaran ASN
        |--------------------------------------------------------------------------
        |
        | Jabatan tertentu tidak dapat dipilih melalui signup mandiri.
        |
        */

        $positions = Position::query()
            ->whereNotIn('code', [
                'PENYEDIA',
                'NON_PENYEDIA',

                'BUPATI',
                'WAKIL_BUPATI',
                'SEKDA',
            ])
            ->orderBy('name')
            ->get();

        return view(
            'auth.register',
            compact('positions')
        );
    }


    /**
     * Handle a registration request.
     *
     * @throws ValidationException
     */
    public function store(
        Request $request
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'user_type' => [
                'required',
                Rule::in([
                    'public',
                    'asn',
                ]),
            ],


            /*
            |--------------------------------------------------------------------------
            | Nama
            |--------------------------------------------------------------------------
            */

            'name' => [
                'required',
                'string',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------------------
            | Email
            |--------------------------------------------------------------------------
            */

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(
                    User::class
                ),
            ],


            /*
            |--------------------------------------------------------------------------
            | Password
            |--------------------------------------------------------------------------
            */

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],


            /*
            |--------------------------------------------------------------------------
            | NIP
            |--------------------------------------------------------------------------
            |
            | Wajib untuk ASN.
            | Tidak wajib untuk Public.
            |
            */

            'nip' => [
                'nullable',
                'string',
                'max:30',

                Rule::requiredIf(
                    $request->user_type === 'asn'
                ),

                Rule::unique(
                    'users',
                    'nip'
                ),
            ],


            /*
            |--------------------------------------------------------------------------
            | Jabatan
            |--------------------------------------------------------------------------
            |
            | Wajib untuk ASN.
            |
            */

            'position_id' => [
                'nullable',
                'integer',

                Rule::requiredIf(
                    $request->user_type === 'asn'
                ),

                'exists:positions,id',
            ],


            /*
            |--------------------------------------------------------------------------
            | Dokumen Pengangkatan
            |--------------------------------------------------------------------------
            |
            | Wajib untuk ASN.
            | Maksimal 5 MB.
            |
            */

            'appointment_document' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',

                Rule::requiredIf(
                    $request->user_type === 'asn'
                ),
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Tentukan tipe user
        |--------------------------------------------------------------------------
        */

        $isAsn = $validated['user_type'] === 'asn';


        /*
        |--------------------------------------------------------------------------
        | Role default
        |--------------------------------------------------------------------------
        |
        | User yang mendaftar mandiri mendapatkan role PUBLIC_USER.
        |
        | Untuk ASN, role ini hanya sementara sampai
        | administrator melakukan approval dan menentukan
        | role yang sesuai.
        |
        */

        $publicRole = Role::query()
            ->where(
                'code',
                'PUBLIC_USER'
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Upload dokumen pengangkatan ASN
        |--------------------------------------------------------------------------
        */

        $appointmentDocument = null;

        if (
            $isAsn
            && $request->hasFile(
                'appointment_document'
            )
        ) {
            $appointmentDocument = $request
                ->file(
                    'appointment_document'
                )
                ->store(
                    'appointment-documents',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'role_id' => $publicRole->id,

            'user_type' => $validated['user_type'],

            'nip' => $isAsn
                ? $validated['nip']
                : null,

            'name' => $validated['name'],

            'position_id' => $isAsn
                ? $validated['position_id']
                : null,

            'email' => $validated['email'],

            'password' => Hash::make(
                $validated['password']
            ),

            'appointment_document' =>
                $appointmentDocument,

            'must_change_password' => false,

            'is_active' => true,

            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            |
            | ASN menunggu approval.
            | Public langsung approved.
            |
            */

            'approval_status' => $isAsn
                ? 'pending'
                : 'approved',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verifikasi Email
        |--------------------------------------------------------------------------
        |
        | HANYA PUBLIC USER yang wajib melakukan
        | verifikasi email.
        |
        | ASN tidak dikirim ke proses verifikasi email.
        |
        */

        if ($user->isPublic()) {

            event(
                new Registered($user)
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ASN
        |--------------------------------------------------------------------------
        |
        | ASN harus menunggu persetujuan administrator.
        |
        */

        if ($isAsn) {

            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Pendaftaran berhasil. Akun ASN Anda sedang menunggu persetujuan administrator.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Public User
        |--------------------------------------------------------------------------
        |
        | Public langsung login.
        | Setelah itu diarahkan ke halaman utama.
        |
        */

        Auth::login($user);

        return redirect()
            ->route('home');
    }
}