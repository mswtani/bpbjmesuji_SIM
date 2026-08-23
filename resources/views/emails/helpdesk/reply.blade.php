<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Balasan Helpdesk {{ $ticket->ticket_number }}
    </title>
</head>

<body>

    <p>
        Yth. {{ $ticket->requester_name }},
    </p>

    <p>
        Terdapat balasan baru dari petugas Helpdesk untuk tiket Anda.
    </p>

    <p>
        <strong>Nomor Tiket:</strong>
        {{ $ticket->ticket_number }}
    </p>

    <p>
        <strong>Subjek:</strong>
        {{ $ticket->subject }}
    </p>

    <hr>

    <p>
        <strong>Balasan Petugas:</strong>
    </p>

    <p style="white-space: pre-line;">{{ $reply->message }}</p>

    <hr>

    <p>
        Silakan simpan nomor tiket dan informasi akses tiket Anda.
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