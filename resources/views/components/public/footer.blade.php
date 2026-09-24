<style>
    /* =========================================================
       PUBLIC FOOTER
    ========================================================= */

    footer {
        background-color: #0b2f64;
        color: white;
        padding: 40px 0 20px 0;
        margin-top: 50px;
    }

    .public-footer-container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
    }

    .footer-grid h4 {
        margin-bottom: 15px;
        border-bottom: 2px solid #d4af37;
        padding-bottom: 5px;
        display: inline-block;
    }

    .footer-links {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-links li {
        margin: 0;
        padding: 0;
    }

    .footer-links li a {
        color: #cbd5e1;
        text-decoration: none;
        display: block;
        margin-bottom: 8px;
    }

    .footer-links li a:hover {
        color: white;
    }

    .social-links {
        list-style: none;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        margin: 0;
        padding: 0;
    }

    .social-links li {
        margin: 0;
        padding: 0;
    }

    .social-links li a {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 38px;
        height: 38px;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-links li a:hover {
        background-color: #d4af37;
        color: #0b2f64;
        transform: translateY(-3px);
    }

    .footer-email {
        margin-top: 15px;
    }

    .footer-bottom {
        text-align: center;
        border-top: 1px solid #1e293b;
        padding-top: 20px;
        font-size: 14px;
        color: #94a3b8;
    }


    /* =========================================================
       PUBLIC FOOTER RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .public-footer-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-grid {
            text-align: center;
            justify-items: center;
            padding-bottom: 24px;
        }

        .footer-grid > div {
            text-align: center;
        }

        .footer-grid h4 {
            display: inline-block;
        }

        .footer-links {
            text-align: center;
        }

        .footer-links li a {
            text-align: center;
        }

        .social-links {
            justify-content: center;
        }

        .footer-email {
            text-align: center;
        }

        .footer-bottom {
            text-align: center;
        }

        footer {
            font-size: 13px;
        }

        footer h4 {
            font-size: 15px;
        }

        footer p,
        footer li,
        footer a,
        footer span {
            font-size: 13px;
        }

        footer .footer-bottom {
            font-size: 12px;
        }
    }


    @media (max-width: 480px) {

        footer {
            font-size: 12px;
        }

        footer h4 {
            font-size: 14px;
        }

        footer p,
        footer li,
        footer a,
        footer span {
            font-size: 12px;
        }

        footer .footer-bottom {
            font-size: 11px;
        }
    }
</style>


<footer>

    <div class="public-footer-container footer-grid">

        {{-- =====================================================
            HUBUNGI KAMI
        ======================================================--}}
        <div>

            <h4>
                Hubungi Kami
            </h4>

            <p>
                Bagian Pengadaan Barang dan Jasa
                Sekretariat Daerah Kabupaten Mesuji
            </p>

            <p>
                Email: bpbj@mesujikab.go.id
            </p>

        </div>


        {{-- =====================================================
            LINK TERKAIT
        ======================================================--}}
        <div>

            <h4>
                Link Terkait
            </h4>

            <ul class="footer-links">

                <li>
                    <a
                        href="https://spse.inaproc.id/mesujikab"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        LPSE Kabupaten Mesuji
                    </a>
                </li>

                <li>
                    <a
                        href="https://lkpp.go.id"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        LKPP RI
                    </a>
                </li>

                <li>
                    <a
                        href="https://sirup.inaproc.id/sirup/home/rekapitulasiindex"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        SiRUP LKPP
                    </a>
                </li>

                <li>
                    <a
                        href="https://jdih.lkpp.go.id"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        JDIH LKPP
                    </a>
                </li>

            </ul>

        </div>


        {{-- =====================================================
            MEDIA SOSIAL & KONTAK
        ======================================================--}}
        <div>

            <h4>
                Media Sosial & Kontak
            </h4>

            <ul class="social-links">

                <li>
                    <a
                        href="#"
                        target="_blank"
                        title="Facebook"
                    >
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        target="_blank"
                        title="Twitter"
                    >
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>

                <li>
                    <a
                        href="https://www.instagram.com/bpbjmesuji?igsi=cjB3Y3I5dThjaGc4"
                        target="_blank"
                        title="Instagram"
                    >
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>

            </ul>

        </div>

    </div>


    {{-- =========================================================
        FOOTER BOTTOM
    ==========================================================--}}
    <div class="footer-bottom">

        <p>
            &copy; {{ date('Y') }}
            Pemerintah Kabupaten Mesuji.
            All Rights Reserved.
        </p>

    </div>

</footer>