@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div
        class="
            flex
            flex-col
            gap-4

            sm:flex-row
            sm:items-center
            sm:justify-between
        "
    >

        {{-- Header kiri --}}
        <div class="flex min-w-0 items-start gap-4">

            {{-- Icon --}}
            <div
                class="
                    flex h-12 w-12 shrink-0
                    items-center justify-center
                    rounded-2xl
                    bg-amber-50
                    text-amber-600
                "
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                    />

                    <circle
                        cx="9"
                        cy="7"
                        r="4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 8v6M16 11h6"
                    />
                </svg>
            </div>


            {{-- Title --}}
            <div class="min-w-0">

                <div class="flex flex-wrap items-center gap-2">

                    <h1
                        class="
                            text-2xl
                            font-bold
                            tracking-tight
                            text-gray-900

                            sm:text-3xl
                        "
                    >
                        Detail User
                    </h1>

                </div>

                <p class="mt-1.5 text-sm text-gray-500">
                    Informasi lengkap pengguna.
                </p>

            </div>

        </div>


        {{-- =================================================
            ACTION BUTTONS
            Mobile/Table View: Icon + Teks
            Desktop View (md+): Icon Saja
        ================================================== --}}

        <div class="flex shrink-0 items-center justify-center sm:justify-end gap-2 w-full sm:w-auto">

            {{-- EDIT --}}
            @if (auth()->user()->hasPermission('users.update'))

                <a
                    href="{{ route('users.edit', $user) }}"
                    title="Edit user"
                    aria-label="Edit user"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        rounded-lg
                        px-3 py-2
                        md:p-2.5
                        text-sm
                        font-medium
                        text-white
                        bg-amber-500
                        transition
                        hover:bg-amber-600
                        focus:outline-none
                        focus:ring-2
                        focus:ring-amber-500/30
                    "
                >

                    <svg
                        class="h-4 w-4 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 20h9"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z"
                        />
                    </svg>

                    <span class="md:hidden">
                        Edit
                    </span>

                </a>

            @endif


            {{-- DEACTIVATE --}}
            @if ($user->is_active && auth()->user()->hasPermission('users.deactivate'))
                <form
                    method="POST"
                    action="{{ route('users.deactivate', $user) }}"
                    class="inline"
                    data-confirm="Apakah Anda yakin akan menonaktifkan user ini?"
                    data-confirm-action="deactivate"
                    data-confirm-button="Nonaktifkan"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        title="Nonaktifkan user"
                        aria-label="Nonaktifkan user"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            px-3 py-2
                            md:p-2.5
                            text-sm
                            font-medium
                            text-white
                            bg-red-500
                            transition
                            hover:bg-red-600
                            focus:outline-none
                            focus:ring-2
                            focus:ring-red-500/30
                        "
                    >
                        <svg
                            class="h-4 w-4 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 6l12 12"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M18 6 6 18"
                            />
                        </svg>

                        <span class="md:hidden">
                            Nonaktifkan
                        </span>
                    </button>
                </form>
            @endif


            {{-- ACTIVATE --}}
            @if (! $user->is_active && auth()->user()->hasPermission('users.activate'))
                <form
                    method="POST"
                    action="{{ route('users.activate', $user) }}"
                    class="inline"
                    data-confirm="Aktifkan user ini?"
                    data-confirm-action="activate"
                    data-confirm-button="Aktifkan"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        title="Aktifkan user"
                        aria-label="Aktifkan user"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            px-3 py-2
                            md:p-2.5
                            text-sm
                            font-medium
                            text-white
                            bg-emerald-600
                            transition
                            hover:bg-emerald-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-emerald-500/30
                        "
                    >
                        <svg
                            class="h-4 w-4 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3a9 9 0 1 0 9 9"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m9 12 2 2 5-5"
                            />
                        </svg>

                        <span class="md:hidden">
                            Aktifkan
                        </span>
                    </button>
                </form>
            @endif

        </div>

    </div>


    {{-- =====================================================
        USER PROFILE CARD
    ====================================================== --}}

    <x-admin.card :padding="false">

        {{-- Profile Header --}}
        <div
            class="
                flex flex-col gap-4
                border-b border-gray-100
                px-5 py-5
                sm:flex-row sm:items-center sm:px-6
            "
        >

            {{-- Avatar --}}
            <div
                class="
                    flex h-14 w-14 shrink-0
                    items-center justify-center
                    overflow-hidden
                    rounded-2xl
                    bg-amber-50
                    text-amber-600
                "
            >

                @if ($user->avatar)

                    <img
                        src="{{ asset('storage/' . $user->avatar) }}"
                        alt="Foto {{ $user->name }}"
                        class="h-full w-full object-cover"
                    >

                @else

                    <svg
                        class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 8v6M16 11h6"
                        />
                    </svg>

                @endif

            </div>


            {{-- Name --}}
            <div class="min-w-0">

                <h2 class="truncate text-lg font-bold text-gray-900 sm:text-xl">
                    {{ $user->name }}
                </h2>

                <p class="mt-0.5 truncate text-sm text-gray-500">
                    {{ $user->email }}
                </p>

            </div>


            {{-- Status --}}
            <div class="sm:ml-auto">

                @if ($user->is_active)

                    <span
                        class="
                            inline-flex items-center gap-1.5
                            rounded-full
                            bg-green-100
                            px-2.5 py-1
                            text-xs font-semibold
                            text-green-800
                        "
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                        Aktif
                    </span>

                @else

                    <span
                        class="
                            inline-flex items-center gap-1.5
                            rounded-full
                            bg-red-100
                            px-2.5 py-1
                            text-xs font-semibold
                            text-red-800
                        "
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                        Tidak Aktif
                    </span>

                @endif

            </div>

        </div>


        {{-- =================================================
            INFORMATION
        ================================================== --}}

        <div class="px-5 py-2 sm:px-6">

            <dl class="divide-y divide-gray-100">

                {{-- NIP --}}
                <div
                    class="
                        grid grid-cols-1 gap-1
                        py-4
                        sm:grid-cols-3 sm:gap-6
                    "
                >

                    <dt class="text-sm font-medium text-gray-500">
                        NIP
                    </dt>

                    <dd
                        class="
                            break-words
                            text-sm font-medium
                            text-gray-900
                            sm:col-span-2
                        "
                    >
                        {{ $user->nip ?: '-' }}
                    </dd>

                </div>


                {{-- Nama --}}
                <div
                    class="
                        grid grid-cols-1 gap-1
                        py-4
                        sm:grid-cols-3 sm:gap-6
                    "
                >

                    <dt class="text-sm font-medium text-gray-500">
                        Nama Lengkap
                    </dt>

                    <dd
                        class="
                            break-words
                            text-sm font-medium
                            text-gray-900
                            sm:col-span-2
                        "
                    >
                        {{ $user->name }}
                    </dd>

                </div>


                {{-- Email --}}
                <div
                    class="
                        grid grid-cols-1 gap-1
                        py-4
                        sm:grid-cols-3 sm:gap-6
                    "
                >

                    <dt class="text-sm font-medium text-gray-500">
                        Email
                    </dt>

                    <dd
                        class="
                            break-words
                            text-sm
                            text-gray-700
                            sm:col-span-2
                        "
                    >
                        {{ $user->email }}
                    </dd>

                </div>

                
                {{-- Role --}}
                <div
                    class="
                        grid grid-cols-1 gap-1
                        py-4
                        sm:grid-cols-3 sm:gap-6
                    "
                >

                    <dt class="text-sm font-medium text-gray-500">
                        Role
                    </dt>

                    <dd class="sm:col-span-2">

                        @if ($user->role)

                            <span
                                class="
                                    inline-flex
                                    rounded-full
                                    bg-indigo-100
                                    px-2.5 py-1
                                    text-xs font-semibold
                                    text-indigo-700
                                "
                            >
                                {{ $user->role->name }}
                            </span>

                        @else

                            <span class="text-sm text-gray-500">
                                -
                            </span>

                        @endif

                    </dd>

                </div>


                {{-- Jabatan --}}
                <div
                    class="
                        grid grid-cols-1 gap-1
                        py-4
                        sm:grid-cols-3 sm:gap-6
                    "
                >

                    <dt class="text-sm font-medium text-gray-500">
                        Jabatan dalam PBJ
                    </dt>

                    <dd
                        class="
                            break-words
                            text-sm
                            text-gray-700
                            sm:col-span-2
                        "
                    >
                        {{ $user->position?->name ?? '-' }}
                    </dd>

                </div>


                {{-- Status --}}
                <div
                    class="
                        grid grid-cols-1 gap-1
                        py-4
                        sm:grid-cols-3 sm:gap-6
                    "
                >

                    <dt class="text-sm font-medium text-gray-500">
                        Status
                    </dt>

                    <dd class="sm:col-span-2">

                        @if ($user->is_active)

                            <span
                                class="
                                    inline-flex items-center gap-1.5
                                    rounded-full
                                    bg-green-100
                                    px-2.5 py-1
                                    text-xs font-semibold
                                    text-green-800
                                "
                            >
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                Aktif
                            </span>

                        @else

                            <span
                                class="
                                    inline-flex items-center gap-1.5
                                    rounded-full
                                    bg-red-100
                                    px-2.5 py-1
                                    text-xs font-semibold
                                    text-red-800
                                "
                            >
                                <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                Tidak Aktif
                            </span>

                        @endif

                    </dd>

                </div>

            </dl>

        </div>

    </x-admin.card>


    {{-- =====================================================
        BACK
    ====================================================== --}}

    <div>

        <a
            href="{{ route('users.index') }}"
            class="
                inline-flex
                w-full
                items-center
                justify-center
                gap-2
                rounded-lg
                border border-gray-200
                bg-red-500
                px-4 py-2.5
                text-sm font-medium
                text-white
                shadow-sm
                transition
                hover:border-gray-300
                hover:bg-red-600
                focus:outline-none
                focus:ring-2
                focus:ring-gray-500/20

                sm:w-auto
            "
        >

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19 12H5"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m12 19-7-7 7-7"
                />
            </svg>

            <span>
                Kembali ke daftar user
            </span>

        </a>

    </div>

</div>

{{-- Modal Konfirmasi --}}
<div
    id="user-confirm-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4"
    aria-hidden="true"
>
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>

    <div
        class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-xl transition-all"
        role="dialog"
        aria-modal="true"
        aria-labelledby="user-confirm-title"
    >
        <div id="modal-icon-bg" class="mx-auto flex h-12 w-12 items-center justify-center rounded-full mb-4">
            <svg id="deactivate-icon" class="h-6 w-6 text-red-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <svg id="activate-icon" class="h-6 w-6 text-emerald-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <div class="text-center">
            <h2 id="user-confirm-title" class="text-lg font-semibold text-slate-900"></h2>
            <p id="user-confirm-message" class="mt-2 text-sm text-slate-600"></p>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button
                type="button"
                data-user-confirm-cancel
                class="w-full sm:w-auto rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition"
            >
                Batal
            </button>

            <button
                type="button"
                id="user-confirm-submit"
                data-user-confirm-submit
                class="w-full sm:w-auto rounded-lg px-4 py-2 text-sm font-medium text-white transition"
            ></button>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const confirmModal = document.getElementById('user-confirm-modal');
    const confirmTitle = document.getElementById('user-confirm-title');
    const confirmMessage = document.getElementById('user-confirm-message');
    const cancelButton = confirmModal?.querySelector('[data-user-confirm-cancel]');
    const submitButton = document.getElementById('user-confirm-submit');
    
    const iconBg = document.getElementById('modal-icon-bg');
    const deactivateIcon = document.getElementById('deactivate-icon');
    const activateIcon = document.getElementById('activate-icon');

    const successModal = document.getElementById('user-success-modal');
    const successCloseButton = successModal?.querySelector('[data-user-success-close]');

    let pendingForm = null;
    let previousFocus = null;

    function openModal(modal) {
        previousFocus = document.activeElement;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal(modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.setAttribute('aria-hidden', 'true');
        previousFocus?.focus();
    }

    function closeConfirmModal() {
        pendingForm = null;
        closeModal(confirmModal);
    }

    document.addEventListener('submit', (event) => {
        const form = event.target.closest('form[data-user-action-form], form[data-confirm]');

        if (!form || form.dataset.confirmed === '1') {
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();

        pendingForm = form;
        
        const actionType = form.dataset.confirmAction || (form.action.includes('deactivate') ? 'deactivate' : 'activate');

        if (actionType === 'deactivate') {
            iconBg.className = 'mx-auto flex h-12 w-12 items-center justify-center rounded-full mb-4 bg-red-100';
            deactivateIcon.classList.remove('hidden');
            activateIcon.classList.add('hidden');
            
            submitButton.className = 'w-full sm:w-auto rounded-lg px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-red-500/30 transition';
        } else {
            iconBg.className = 'mx-auto flex h-12 w-12 items-center justify-center rounded-full mb-4 bg-emerald-100';
            activateIcon.classList.remove('hidden');
            deactivateIcon.classList.add('hidden');
            
            submitButton.className = 'w-full sm:w-auto rounded-lg px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-2 focus:ring-emerald-500/30 transition';
        }

        confirmTitle.textContent = form.dataset.confirmTitle || (actionType === 'deactivate' ? 'Nonaktifkan User' : 'Aktifkan User');
        confirmMessage.textContent = form.dataset.confirmMessage || form.dataset.confirm || 'Apakah Anda yakin ingin melanjutkan tindakan ini?';
        submitButton.textContent = form.dataset.confirmButton || (actionType === 'deactivate' ? 'Nonaktifkan' : 'Aktifkan');

        openModal(confirmModal);
        submitButton.focus();
    }, true);

    cancelButton?.addEventListener('click', closeConfirmModal);

    submitButton?.addEventListener('click', () => {
        if (!pendingForm) return;

        pendingForm.dataset.confirmed = '1';
        submitButton.disabled = true;
        submitButton.textContent = 'Memproses...';

        HTMLFormElement.prototype.submit.call(pendingForm);
    });

    successCloseButton?.addEventListener('click', () => {
        closeModal(successModal);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;

        if (confirmModal && !confirmModal.classList.contains('hidden')) {
            closeConfirmModal();
        }

        if (successModal && !successModal.classList.contains('hidden')) {
            closeModal(successModal);
        }
    });
});
</script>
@endpush