@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">
            Persetujuan Akun ASN
        </h1>

        <p class="mt-1 text-sm text-gray-600">
            Daftar akun ASN yang menunggu persetujuan administrator.
        </p>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div
            class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800"
        >
            {{ session('success') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div
            class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800"
        >
            {{ session('error') }}
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div
            class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4"
        >
            <ul class="list-disc pl-5 text-sm text-red-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Nama
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            NIP
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Jabatan
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Dokumen
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Tanggal Daftar
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200">

                    @forelse($users as $user)

                        <tr class="hover:bg-gray-50">

                            {{-- Nama --}}
                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $user->name }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $user->email }}
                                </div>

                            </td>


                            {{-- NIP --}}
                            <td class="px-6 py-4 text-gray-700">
                                {{ $user->nip }}
                            </td>


                            {{-- Jabatan --}}
                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $user->position?->name ?? '-' }}
                                </div>

                                @if($user->role)
                                    <div class="text-xs text-gray-500">
                                        Role: {{ $user->role->name }}
                                    </div>
                                @endif

                            </td>


                            {{-- Dokumen --}}
                            <td class="px-6 py-4">

                                @if($user->appointment_document)

                                    <a
                                        href="{{ asset('storage/'.$user->appointment_document) }}"
                                        target="_blank"
                                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800"
                                    >
                                        Lihat Dokumen
                                    </a>

                                @else

                                    <span class="text-sm text-red-500">
                                        Tidak ada dokumen
                                    </span>

                                @endif

                            </td>


                            {{-- Tanggal --}}
                            <td class="px-6 py-4 text-gray-600">

                                {{ $user->created_at?->format('d M Y H:i') }}

                            </td>


                            {{-- Aksi --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    {{-- Approve --}}
                                    @if(auth()->user()->hasPermission('users.approve'))

                                        <form
                                            action="{{ route('users.approve', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menyetujui akun ini?')"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="rounded-lg bg-green-600 px-3 py-2 text-xs font-medium text-white hover:bg-green-700"
                                            >
                                                Setujui
                                            </button>

                                        </form>

                                    @endif


                                    {{-- Reject --}}
                                    @if(auth()->user()->hasPermission('users.reject'))

                                        <button
                                            type="button"
                                            onclick="showRejectModal(
                                                '{{ $user->id }}',
                                                '{{ addslashes($user->name) }}'
                                            )"
                                            class="rounded-lg bg-red-600 px-3 py-2 text-xs font-medium text-white hover:bg-red-700"
                                        >
                                            Tolak
                                        </button>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-12 text-center text-gray-500"
                            >
                                Tidak ada akun ASN yang menunggu persetujuan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($users->hasPages())

            <div class="border-t border-gray-200 px-6 py-4">

                {{ $users->links() }}

            </div>

        @endif

    </div>

</div>


{{-- Reject Modal --}}
<div
    id="rejectModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
>

    <div class="w-full max-w-lg rounded-lg bg-white shadow-xl">

        <div class="border-b border-gray-200 px-6 py-4">

            <h2 class="text-lg font-semibold text-gray-900">
                Tolak Akun ASN
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Berikan alasan penolakan akun
                <span
                    id="rejectUserName"
                    class="font-medium text-gray-700"
                ></span>.
            </p>

        </div>


        <form
            id="rejectForm"
            method="POST"
        >

            @csrf
            @method('PATCH')


            <div class="px-6 py-5">

                <label
                    for="rejection_reason"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >
                    Alasan Penolakan
                </label>


                <textarea
                    id="rejection_reason"
                    name="rejection_reason"
                    rows="5"
                    required
                    maxlength="1000"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500"
                    placeholder="Tuliskan alasan penolakan..."
                ></textarea>

            </div>


            <div
                class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4"
            >

                <button
                    type="button"
                    onclick="hideRejectModal()"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Batal
                </button>


                <button
                    type="submit"
                    class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700"
                >
                    Tolak Akun
                </button>

            </div>

        </form>

    </div>

</div>


<script>
    function showRejectModal(userId, userName) {

        const modal = document.getElementById('rejectModal');

        const form = document.getElementById('rejectForm');

        const reason = document.getElementById('rejection_reason');

        document.getElementById('rejectUserName').textContent = userName;

        reason.value = '';

        let actionUrl = "{{ route('users.reject', ':user') }}";

        actionUrl = actionUrl.replace(':user', userId);

        form.action = actionUrl;

        modal.classList.remove('hidden');

        modal.classList.add('flex');
    }

    function hideRejectModal() {

        const modal = document.getElementById('rejectModal');

        modal.classList.add('hidden');

        modal.classList.remove('flex');
    }
</script>

@endsection