<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Reset Password - SIM BPBJ Mesuji
    </title>

</head>


<body
    style="
        margin: 0;
        padding: 0;
        background-color: #f3f4f6;
        font-family:
            Arial,
            Helvetica,
            sans-serif;
    "
>


    <table
        width="100%"
        cellpadding="0"
        cellspacing="0"
        border="0"
        style="
            background-color: #f3f4f6;
            padding: 40px 15px;
        "
    >

        <tr>

            <td align="center">


                {{-- Container --}}
                <table
                    width="100%"
                    cellpadding="0"
                    cellspacing="0"
                    border="0"
                    style="
                        max-width: 600px;
                        background-color: #ffffff;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow:
                            0 4px 15px
                            rgba(0, 0, 0, 0.08);
                    "
                >


                    {{-- HEADER --}}
                    <tr>

                        <td
                            align="center"
                            style="
                                padding:
                                    35px
                                    20px
                                    25px;
                            "
                            >

                       
                            <div
                                style="
                                    font-size: 22px;
                                    font-weight: 700;
                                    color: #1f2937;
                                    letter-spacing: 0.5px;
                                "
                            >
                                SIM BPBJ MESUJI
                            </div>


                            <div
                                style="
                                    margin-top: 6px;
                                    font-size: 13px;
                                    color: #6b7280;
                                "
                            >
                                Sistem Informasi Manajemen
                                <br>
                                Bagian Pengadaan Barang dan Jasa
                            </div>

                        </td>

                    </tr>


                    {{-- CONTENT --}}
                    <tr>

                        <td
                            style="
                                padding:
                                    15px
                                    45px
                                    40px;
                            "
                        >


                            <h2
                                style="
                                    margin:
                                        0
                                        0
                                        20px;
                                    color: #1f2937;
                                    font-size: 22px;
                                "
                            >
                                Permintaan Reset Password
                            </h2>


                            <p
                                style="
                                    color: #4b5563;
                                    font-size: 15px;
                                    line-height: 1.7;
                                "
                            >
                                Halo,
                            </p>


                            <p
                                style="
                                    color: #4b5563;
                                    font-size: 15px;
                                    line-height: 1.7;
                                "
                            >
                                Kami menerima permintaan untuk
                                mereset password akun Anda pada
                                <strong>
                                    SIM BPBJ Mesuji
                                </strong>.
                            </p>


                            <p
                                style="
                                    color: #4b5563;
                                    font-size: 15px;
                                    line-height: 1.7;
                                "
                            >
                                Silakan klik tombol di bawah ini
                                untuk membuat password baru.
                            </p>


                            {{-- BUTTON --}}
                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                            >

                                <tr>

                                    <td
                                        align="center"
                                        style="
                                            padding:
                                                20px
                                                0
                                                25px;
                                        "
                                    >

                                        <a
                                            href="{{ $url }}"
                                            style="
                                                display:
                                                    inline-block;
                                                padding:
                                                    13px
                                                    28px;
                                                background-color:
                                                    #1e3a8a;
                                                color:
                                                    #ffffff;
                                                text-decoration:
                                                    none;
                                                border-radius:
                                                    7px;
                                                font-size:
                                                    15px;
                                                font-weight:
                                                    bold;
                                            "
                                        >
                                            Reset Password
                                        </a>

                                    </td>

                                </tr>

                            </table>


                            {{-- WARNING --}}
                            <div
                                style="
                                    background-color: #fff7ed;
                                    border:
                                        1px solid #fed7aa;
                                    border-radius: 8px;
                                    padding: 15px;
                                    margin-top: 10px;
                                "
                            >

                                <p
                                    style="
                                        margin: 0;
                                        color: #9a3412;
                                        font-size: 14px;
                                        line-height: 1.6;
                                    "
                                >
                                    Link reset password ini akan
                                    berlaku selama
                                    <strong>
                                        {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }}
                                        menit.
                                    </strong>
                                </p>

                            </div>


                            <p
                                style="
                                    margin-top: 25px;
                                    color: #4b5563;
                                    font-size: 15px;
                                    line-height: 1.7;
                                "
                            >
                                Jika Anda tidak merasa melakukan
                                permintaan reset password,
                                Anda tidak perlu melakukan tindakan
                                apa pun.
                            </p>


                            <p
                                style="
                                    margin-top: 25px;
                                    color: #4b5563;
                                    font-size: 15px;
                                    line-height: 1.7;
                                "
                            >
                                Terima kasih,
                                <br>

                                <strong>
                                    SIM BPBJ Mesuji
                                </strong>
                            </p>


                            {{-- Divider --}}
                            <hr
                                style="
                                    border: none;
                                    border-top:
                                        1px solid #e5e7eb;
                                    margin:
                                        30px
                                        0
                                        20px;
                                "
                            >


                            {{-- Alternative URL --}}
                            <p
                                style="
                                    color: #6b7280;
                                    font-size: 12px;
                                    line-height: 1.6;
                                "
                            >
                                Jika tombol
                                <strong>Reset Password</strong>
                                tidak dapat diklik,
                                salin dan tempel tautan berikut
                                ke browser Anda:
                            </p>


                            <p
                                style="
                                    word-break: break-all;
                                    font-size: 12px;
                                    color: #1e3a8a;
                                "
                            >
                                {{ $url }}
                            </p>


                        </td>

                    </tr>


                    {{-- FOOTER --}}
                    <tr>

                        <td
                            align="center"
                            style="
                                background-color: #f9fafb;
                                padding: 20px;
                                border-top:
                                    1px solid #e5e7eb;
                            "
                        >

                            <p
                                style="
                                    margin: 0;
                                    font-size: 12px;
                                    color: #9ca3af;
                                "
                            >
                                © {{ date('Y') }}
                                Pemerintah Kabupaten Mesuji
                            </p>


                            <p
                                style="
                                    margin:
                                        6px
                                        0
                                        0;
                                    font-size: 11px;
                                    color: #9ca3af;
                                "
                            >
                                Bagian Pengadaan Barang dan Jasa
                            </p>

                        </td>

                    </tr>


                </table>


            </td>

        </tr>

    </table>


</body>

</html>