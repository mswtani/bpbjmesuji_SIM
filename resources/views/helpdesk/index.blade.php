@extends('layouts.admin')

@section('title', 'Helpdesk')

@section('content')

<x-admin.page
    title="Helpdesk"
    description="Daftar tiket dan permintaan masyarakat."
>
    {{-- Search & Filter --}}
    <div class="mb-6 rounded-xl border border-gray-200 bg-white p-4 shadow-sm">

        <form
            method="GET"
            action="{{ route('helpdesk.admin.index') }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-6"
        >

            {{-- Search --}}
            <div class="lg:col-span-2">
                <label
                    for="search"
                    class="mb-1.5 block text-sm font-medium text-gray-700"
                >
                    Pencarian
                </label>

                <input
                    type="search"
                    id="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="No. tiket, pemohon, email, atau subjek..."
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>


            {{-- Kategori --}}
            <div>
                <label
                    for="category"
                    class="mb-1.5 block text-sm font-medium text-gray-700"
                >
                    Kategori
                </label>

                <select
                    id="category"
                    name="category"
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 pr-8 text-sm text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">Semua Kategori</option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected($categoryId === $category->id)
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>
            </div>


            {{-- Status --}}
            <div>
                <label
                    for="status"
                    class="mb-1.5 block text-sm font-medium text-gray-700"
                >
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 pr-8 text-sm text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">Semua Status</option>

                    <option value="baru" @selected($status === 'baru')>
                        Baru
                    </option>

                    <option value="diproses" @selected($status === 'diproses')>
                        Diproses
                    </option>

                    <option value="menunggu_pemohon" @selected($status === 'menunggu_pemohon')>
                        Menunggu Pemohon
                    </option>

                    <option value="selesai" @selected($status === 'selesai')>
                        Selesai
                    </option>

                    <option value="ditutup" @selected($status === 'ditutup')>
                        Ditutup
                    </option>
                </select>
            </div>


            {{-- Prioritas --}}
            <div>
                <label
                    for="priority"
                    class="mb-1.5 block text-sm font-medium text-gray-700"
                >
                    Prioritas
                </label>

                <select
                    id="priority"
                    name="priority"
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 pr-8 text-sm text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">Semua Prioritas</option>

                    <option value="normal" @selected($priority === 'normal')>
                        Normal
                    </option>

                    <option value="tinggi" @selected($priority === 'tinggi')>
                        Tinggi
                    </option>

                    <option value="mendesak" @selected($priority === 'mendesak')>
                        Mendesak
                    </option>
                </select>
            </div>


            {{-- Tombol --}}
            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="inline-flex flex-1 items-center justify-center rounded-md bg-blue-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-800"
                >
                    Cari
                </button>

                @if (
                    $search !== '' ||
                    $categoryId !== null ||
                    $status !== null ||
                    $priority !== null
                )

                    <a
                        href="{{ route('helpdesk.admin.index') }}"
                        class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        Reset
                    </a>

                @endif

            </div>

        </form>

        <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-4">

            <div class="text-sm text-gray-500">
                @if ($tickets->total() > 0)
                    Menampilkan
                    <span class="font-medium text-gray-700">
                        {{ $tickets->firstItem() }}
                    </span>
                    –
                    <span class="font-medium text-gray-700">
                        {{ $tickets->lastItem() }}
                    </span>
                    dari
                    <span class="font-medium text-gray-700">
                        {{ $tickets->total() }}
                    </span>
                    tiket
                @else
                    Tidak ada tiket yang ditemukan.
                @endif
            </div>


            <form method="GET" action="{{ route('helpdesk.admin.index') }}" class="flex items-center gap-2">

                <label for="per_page" class="text-sm text-gray-600">
                    Tampilkan
                </label>

                <select
                    id="per_page"
                    name="per_page"
                    onchange="this.form.submit()"
                    class="rounded-md border border-gray-300 bg-white px-3 py-2 pr-8 text-sm text-gray-700 focus:border-blue-500 focus:ring-blue-500"
                >
                    @foreach ([10, 25, 50, 100] as $option)

                        <option
                            value="{{ $option }}"
                            @selected($perPage === $option)
                        >
                            {{ $option }}
                        </option>

                    @endforeach
                </select>

                <span class="text-sm text-gray-600">
                    data
                </span>

                @if ($search !== '')
                    <input type="hidden" name="search" value="{{ $search }}">
                @endif

                @if ($categoryId !== null)
                    <input type="hidden" name="category" value="{{ $categoryId }}">
                @endif

                @if ($status !== null)
                    <input type="hidden" name="status" value="{{ $status }}">
                @endif

                @if ($priority !== null)
                    <input type="hidden" name="priority" value="{{ $priority }}">
                @endif

            </form>

        </div>

    </div>
    

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm text-gray-600">

                <thead class="bg-gray-50 text-xs uppercase text-gray-700">

                    <tr>
                        <th class="w-16 px-6 py-4 text-center">
                            No.
                        </th>
                        
                        <th class="px-6 py-4">
                            Tiket
                        </th>

                        <th class="px-6 py-4">
                            Pemohon
                        </th>

                        <th class="px-6 py-4">
                            Kategori
                        </th>

                        <th class="px-6 py-4">
                            Subjek
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4">
                            Prioritas
                        </th>

                        <th class="px-6 py-4">
                            Pesan Terakhir
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse ($tickets as $ticket)

                        <tr class="hover:bg-gray-50">
                            {{-- Nomor --}}
                            <td class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">
                                {{ $tickets->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4 font-medium">

                                <a
                                    href="{{ route('helpdesk.admin.show', $ticket->ticket_number) }}"
                                    class="text-blue-700 hover:underline"
                                >
                                    {{ $ticket->ticket_number }}
                                </a>

                            </td>

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $ticket->requester_name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $ticket->requester_email }}
                                </div>

                            </td>

                            <td class="px-6 py-4">
                                {{ $ticket->category?->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $ticket->subject }}
                            </td>

                            <td class="px-6 py-4">

                                @if ($ticket->status === 'baru')

                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                                        Baru
                                    </span>

                                @elseif ($ticket->status === 'diproses')

                                    <span class="rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700">
                                        Diproses
                                    </span>

                                @elseif ($ticket->status === 'menunggu_pemohon')

                                    <span class="rounded-full bg-orange-100 px-2.5 py-1 text-xs font-medium text-orange-700">
                                        Menunggu Pemohon
                                    </span>

                                @elseif ($ticket->status === 'selesai')

                                    <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-medium text-blue-700">
                                        Selesai
                                    </span>

                                @elseif ($ticket->status === 'ditutup')

                                    <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700">
                                        Ditutup
                                    </span>

                                @else

                                    <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700">
                                        {{ $ticket->status }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                @if ($ticket->priority === 'normal')

                                    <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700">
                                        Normal
                                    </span>

                                @elseif ($ticket->priority === 'tinggi')

                                    <span class="rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700">
                                        Tinggi
                                    </span>

                                @elseif ($ticket->priority === 'mendesak')

                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700">
                                        Mendesak
                                    </span>

                                @else

                                    <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700">
                                        {{ $ticket->priority }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">

                                @if ($ticket->last_message_at)
                                    {{ $ticket->last_message_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-6 py-12 text-center text-gray-500"
                            >
                                Belum ada tiket Helpdesk.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <x-admin.pagination
            :paginator="$tickets"
            label="data"
        />

    </div>

</x-admin.page>

@endsection