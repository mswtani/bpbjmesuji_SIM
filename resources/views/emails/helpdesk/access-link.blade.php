<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Tautan Akses Tiket {{ $ticket->ticket_number }}
    </title>
</head>

<body>

    <p>
        Yth. {{ $ticket->requester_name }},
    </p>

    <p>
        Anda meminta pengiriman ulang tautan akses untuk tiket Helpdesk Anda.
    </p>

    <p>
        <strong>Nomor Tiket:</strong>
        {{ $ticket->ticket_number }}
    </p>

    <p>
        <strong>Subjek:</strong>
        {{ $ticket->subject }}
    </p>

    <p>
        Gunakan tombol berikut untuk membuka tiket dan melihat riwayat
        percakapan Anda dengan petugas Helpdesk:
    </p>

    <p>
        <a
            href="{{ $ticketUrl }}"
            style="
                display: inline-block;
                padding: 12px 20px;
                background-color: #0b2f64;
                color: #ffffff;
                text-decoration: none;
                border-radius: 6px;
                font-weight: 600;
            "
        >
            Lihat Tiket Helpdesk
        </a>
    </p>

    <p>
        Tautan ini bersifat pribadi. Jangan membagikannya kepada orang lain.
    </p>

    <p>
        Jika Anda tidak meminta pengiriman ulang tautan ini,
        Anda dapat mengabaikan email ini.
    </p>

    <p>
        Terima kasih.
    </p>

    <p>
        Helpdesk<br>
        {{ config('app.name') }}
    </p>

</body>

</html>