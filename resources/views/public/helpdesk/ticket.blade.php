@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-6">

            <a
                href="{{ route('helpdesk.index') }}"
                class="text-sm font-medium text-blue-700 hover:underline"
            >
                ← Kembali ke Helpdesk
            </a>

            <h1 class="mt-4 text-2xl font-bold text-gray-900">
                Tiket Helpdesk
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                {{ $ticket->ticket_number }}
            </p>

        </div>


        {{-- Ticket information --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <div class="grid gap-5 sm:grid-cols-2">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Kategori
                    </p>

                    <p class="mt-1 font-medium text-gray-900">
                        {{ $ticket->category->name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Status
                    </p>

                    <p class="mt-1">
                        @if ($ticket->status === 'open')

                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                Terbuka
                            </span>

                        @elseif ($ticket->status === 'closed')

                            <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                Ditutup
                            </span>

                        @else

                            <span class="inline-flex rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">
                                {{ ucfirst($ticket->status) }}
                            </span>

                        @endif
                    </p>
                </div>


                <div class="sm:col-span-2">

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Subjek
                    </p>

                    <p class="mt-1 text-lg font-semibold text-gray-900">
                        {{ $ticket->subject }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Conversation --}}
        <div class="mt-6 rounded-xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-200 px-6 py-4">

                <h2 class="font-semibold text-gray-900">
                    Percakapan
                </h2>

            </div>


            <div class="space-y-5 p-6">

                @forelse ($ticket->messages as $message)

                    <div
                        class="{{ $message->sender_type === 'requester'
                            ? 'flex justify-end'
                            : 'flex justify-start' }}"
                    >

                        <div
                            class="max-w-2xl rounded-2xl px-4 py-3
                            {{ $message->sender_type === 'requester'
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-100 text-gray-900' }}"
                        >

                            <div class="mb-1 text-xs opacity-70">

                                @if ($message->sender_type === 'requester')
                                    Anda
                                @else
                                    Petugas Helpdesk
                                @endif

                            </div>


                            <div class="whitespace-pre-line text-sm leading-6">
                                {{ $message->message }}
                            </div>


                            <div class="mt-2 text-right text-[11px] opacity-60">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    </div>

                @empty

                    <p class="text-center text-sm text-gray-500">
                        Belum ada pesan.
                    </p>

                @endforelse

            </div>

        </div>

        @if ($ticket->status !== 'closed')

            <div class="mt-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

                <h2 class="font-semibold text-gray-900">
                    Kirim Pesan
                </h2>

                @if (session('success'))

                    <div class="mt-4 rounded-lg bg-green-50 p-4 text-sm text-green-700">
                        {{ session('success') }}
                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route(
                        'helpdesk.ticket.messages.store',
                        [
                            'ticketNumber' => $ticket->ticket_number,
                            ...(
                                request()->user()
                                    ? []
                                    : [
                                        'token' => request()->query('token'),
                                    ]
                            ),
                        ]
                    ) }}"
                    class="mt-4"
                >

                    @csrf

                    <textarea
                        name="message"
                        rows="4"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Tulis pesan Anda..."
                        required
                    >{{ old('message') }}</textarea>


                    @error('message')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror


                    <div class="mt-4 flex justify-end">

                        <button
                            type="submit"
                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800"
                        >
                            Kirim Pesan
                        </button>

                    </div>

                </form>

            </div>

        @endif

        {{-- Attachment --}}
        @php
            $attachments = $ticket->messages
                ->flatMap(fn ($message) => $message->attachments);
        @endphp


        @if ($attachments->isNotEmpty())

            <div class="mt-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

                <h2 class="font-semibold text-gray-900">
                    Lampiran
                </h2>

                <div class="mt-4 space-y-3">

                    @foreach ($attachments as $attachment)

                        <div class="flex items-center justify-between rounded-lg bg-gray-50 p-3">

                            <div class="min-w-0">

                                <p class="truncate text-sm font-medium text-gray-900">
                                    {{ $attachment->original_name }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ number_format($attachment->file_size / 1024, 1) }} KB
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    </div>

</div>

@endsection