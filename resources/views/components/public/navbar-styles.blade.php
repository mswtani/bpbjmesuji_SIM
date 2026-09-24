<style>
        /* ---------------------------------------------------------
        TOP BAR
        --------------------------------------------------------- */

        .top-bar {
            background-color: #0b2f64;
            color: #fff;
            padding: 8px 0;
            font-size: 13px;
        }

        .public-topbar-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .public-header-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar a {
            color: inherit;
            text-decoration: none;
        }

        .top-bar a:hover {
            color: inherit;
            text-decoration: none;
        }


        /* ---------------------------------------------------------
        MAIN HEADER
        --------------------------------------------------------- */

        .main-header {
            background-color: #fff;
            padding: 20px 0;
            border-bottom: 3px solid #d4af37;
        }

        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo-area {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 15px;
        }

        .logo-area .ukpbj {
            display: none;
        }

        .logo {
            height: 65px;
            width: auto;
        }

        .logo-text h1 {
            font-size: 20px;
            color: #0b2f64;
        }

        .logo-text h2 {
            font-size: 14px;
            color: #777;
            font-weight: 400;
        }


        /* ---------------------------------------------------------
        SEARCH
        --------------------------------------------------------- */

        .search-box {
            display: flex;
        }

        .search-box input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            outline: none;
            width: 250px;
        }

        .search-box button {
            background-color: #0b2e64;
            color: white;
            border: none;
            padding: 0 15px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }


        /* ---------------------------------------------------------
        NAVBAR
        --------------------------------------------------------- */

        .public-navbar {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #0b2f64;
        }

       .public-navbar-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .public-navbar .mobile-logo {
            display: none;
        }

        .public-navbar .nav-links {
            list-style: none;
            display: flex;
        }

        .public-desktop-menu {
            display: flex;
            align-items: center;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .public-desktop-menu > li {
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .public-desktop-menu > li > a,
        .public-desktop-menu > li > .public-dropdown-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            padding: 15px 20px;
            box-sizing: border-box;
            color: #fff;
            background: transparent;
            border: 0;
            outline: none;
            font-family: inherit;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.2;
            text-decoration: none;
            cursor: pointer;
        }

        .public-desktop-menu > li > a:hover,
        .public-desktop-menu > li > a:focus,
        .public-desktop-menu > li > .public-dropdown-toggle:hover,
        .public-desktop-menu > li > .public-dropdown-toggle:focus {
            color: #d4af37;
            background: transparent;
            outline: none;
        }


        /* ---------------------------------------------------------
        DESKTOP DROPDOWN
        --------------------------------------------------------- */

        .public-dropdown {
            position: relative;
        }

        .public-dropdown-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 100%;
            padding: 0;
            border: 0;
            background: transparent;
            color: #fff;
            font: inherit;
            cursor: pointer;
        }

        .public-dropdown-toggle:hover {
            color: #fff;
        }

        .public-dropdown-toggle::after {
            display: none !important;
        }

        .public-dropdown-arrow {
            display: inline-block;
            width: 7px;
            height: 7px;
            margin-top: -3px;
            border-right: 1.5px solid currentColor;
            border-bottom: 1.5px solid currentColor;
            transform: rotate(45deg);
            transition: transform 0.2s ease;
        }

        .public-dropdown.is-open .public-dropdown-arrow {
            transform: rotate(225deg);
        }

        .public-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            min-width: 220px;
            padding: 0;
            margin: 0;
            background: #fff;
            border: 0;
            border-radius: 0 0 4px 4px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.18);
            list-style: none;
            z-index: 2500;
        }

        .public-dropdown.is-open .public-dropdown-menu {
            display: block;
        }

        .public-dropdown-menu a {
            display: block;
            width: 100%;
            padding: 12px 16px;
            color: #0b2f64;
            background: #fff;
            font-size: 15px;
            line-height: 1.4;
            text-decoration: none;
            box-sizing: border-box;
        }

        .public-dropdown-menu a:hover,
        .public-dropdown-menu a:focus {
            color: #fff;
            background: #0b2f64;
        }


        /* ---------------------------------------------------------
        USER ACCOUNT
        --------------------------------------------------------- */

        .public-user-dropdown {
            position: relative;
        }

        .public-user-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0;
            border: 0;
            background: transparent;
            color: #fff;
            cursor: pointer;
            font: inherit;
        }

        .public-user-toggle:hover {
            color: #fff;
        }

        .public-user-avatar {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fff;
            color: #0b2f64;
            border: 2px solid #d4af37;
            font-size: 13px;
        }

        .public-user-avatar img {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .public-user-name {
            white-space: nowrap;
        }

        .public-user-arrow {
            width: 6px;
            height: 6px;
            margin-top: -3px;
            border-right: 1.5px solid currentColor;
            border-bottom: 1.5px solid currentColor;
            transform: rotate(45deg);
            transition: transform 0.2s ease;
        }

        .public-user-dropdown.is-open .public-user-arrow {
            transform: rotate(225deg);
            margin-top: 3px;
        }

        .public-user-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            display: none;
            width: 190px;
            padding: 0;
            margin: 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            z-index: 3000;
        }

        .public-user-dropdown.is-open .public-user-menu {
            display: block;
        }

        .public-user-menu a,
        .public-user-menu button {
            display: block;
            width: 100%;
            margin: 0;
            padding: 12px 16px;
            box-sizing: border-box;
            border: 0;
            background: #fff;
            color: #333;
            text-align: left;
            text-decoration: none;
            font: inherit;
            cursor: pointer;
        }

        .public-user-menu a:hover,
        .public-user-menu button:hover {
            background: #0b2f64;
            color: #fff;
        }

        .public-user-menu form {
            margin: 0;
            padding: 0;
        }


        /* ---------------------------------------------------------
        MOBILE BUTTON
        --------------------------------------------------------- */

        .public-menu-btn {
            display: none;
            width: auto;
            height: auto;
            padding: 5px;
            border: 0;
            outline: 0;
            background: transparent;
            color: #fff;
            cursor: pointer;
            font-size: 24px;
        }

        .public-menu-btn:hover,
        .public-menu-btn:focus {
            background: transparent;
            border: 0;
            outline: 0;
            color: #fff;
        }


        /* ---------------------------------------------------------
        MOBILE BACKDROP
        --------------------------------------------------------- */

        .public-mobile-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            opacity: 0;
            visibility: hidden;
            z-index: 4000;
            transition:
                opacity 0.3s ease,
                visibility 0.3s ease;
        }

        .public-mobile-backdrop.is-open {
            opacity: 1;
            visibility: visible;
        }


        /* ---------------------------------------------------------
        MOBILE SIDE MENU
        --------------------------------------------------------- */

        .public-mobile-menu {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            max-width: 88vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 0;
            box-sizing: border-box;
            background: #1a4a8d;
            z-index: 5000;
            overflow-y: auto;
            overflow-x: hidden;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            box-shadow: -8px 0 25px rgba(0, 0, 0, 0.25);
        }

        .public-mobile-menu.is-open {
            transform: translateX(0);
        }


        /* ---------------------------------------------------------
        MOBILE CLOSE
        --------------------------------------------------------- */

        .public-mobile-close {
            position: absolute;
            top: 18px;
            right: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            margin: 0;
            padding: 0;
            border: 0 !important;
            outline: none !important;
            background: transparent !important;
            color: #fff;
            font-size: 25px;
            line-height: 1;
            cursor: pointer;
            transform: rotate(0deg);
            transition:
                transform 0.3s ease,
                color 0.2s ease;
            box-shadow: none !important;
            z-index: 5100;
        }

        .public-mobile-menu.is-open .public-mobile-close {
            transform: rotate(-90deg);
        }

        .public-mobile-close:hover {
            color: #d4af37;
            background: transparent !important;
        }

        .public-mobile-close:focus,
        .public-mobile-close:active {
            color: #fff;
            background: transparent !important;
            border: 0 !important;
            outline: none !important;
            box-shadow: none !important;
        }


        /* ---------------------------------------------------------
        MOBILE NAVIGATION
        --------------------------------------------------------- */

        .public-mobile-navigation {
            display: block;
            width: 100%;
            margin: 12px 0 0;
            padding: 0;
            box-sizing: border-box;
        }

        .public-mobile-navigation > a,
        .public-mobile-dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 50px;
            padding: 14px 18px 14px 28px;
            box-sizing: border-box;
            border: 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            background: transparent;
            color: #fff;
            font-family: inherit;
            font-size: 16px;
            font-weight: 400;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
        }

        .public-mobile-navigation > a:hover,
        .public-mobile-dropdown-toggle:hover {
            color: #d4af37;
            background: rgba(0, 0, 0, 0.08);
        }

        .public-mobile-navigation > a.active,
        .public-mobile-dropdown.active > .public-mobile-dropdown-toggle {
            color: #d4af37;
        }

        /* =========================================================
        MOBILE DROPDOWN
        ========================================================= */

        .public-mobile-dropdown-menu {
            display: none;
            margin: 0;
            padding: 0;
            background: rgba(0, 0, 0, 0.08);
            list-style: none;
        }

        .public-mobile-dropdown.is-open .public-mobile-dropdown-menu {
            display: block;
        }

        .public-mobile-dropdown-menu li {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .public-mobile-dropdown-menu a {
            display: block;
            width: 100%;
            padding: 13px 16px 13px 30px;
            color: #fff;
            background: transparent;
            font-size: 15px;
            line-height: 1.4;
            text-decoration: none;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            box-sizing: border-box;
        }

        .public-mobile-dropdown-menu a:hover {
            color: #fff;
            background: rgba(0, 0, 0, 0.12);
        }

        .public-mobile-dropdown-arrow {
            display: inline-block;
            width: 8px;
            height: 8px;
            flex-shrink: 0;
            border-right: 1.5px solid #fff;
            border-bottom: 1.5px solid #fff;
            transform: rotate(45deg);
            transition: transform 0.2s ease;
        }

        .public-mobile-dropdown.is-open .public-mobile-dropdown-arrow {
            transform: rotate(225deg);
        }

        /* =========================================================
        MOBILE USER ACCOUNT
        ========================================================= */

        .public-mobile-user {
            position: relative;
            width: 100%;
            margin-top: auto;
            padding: 0;
            background: #0b2f64;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            box-sizing: border-box;
        }

        .public-mobile-user-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 58px;
            padding: 13px 18px 13px 28px;
            box-sizing: border-box;
            border: 0;
            background: transparent;
            color: #fff;
            font-family: inherit;
            font-size: 16px;
            font-weight: 400;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
        }

        .public-mobile-user-toggle:hover,
        .public-mobile-user-toggle:focus {
            color: #d4af37;
            background: rgba(0, 0, 0, 0.08);
            outline: none;
        }

        .public-mobile-user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .public-mobile-user-info i {
            width: 22px;
            font-size: 17px;
            text-align: center;
        }

        .public-mobile-user-avatar {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border: 2px solid #d4af37;
            border-radius: 50%;
            object-fit: cover;
        }

        .public-mobile-user-arrow {
            display: inline-block;
            width: 7px;
            height: 7px;
            flex-shrink: 0;
            margin-top: 4px;
            border-right: 1.5px solid currentColor;
            border-bottom: 1.5px solid currentColor;
            transform: rotate(225deg);
            transition: transform 0.2s ease;
        }

        .public-mobile-user-menu {
            position: absolute;
            right: 0;
            bottom: 100%;
            left: 0;
            display: none;
            width: 100%;
            margin: 0;
            padding: 6px 0;
            box-sizing: border-box;
            background: #1a4a8d;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 -8px 18px rgba(0, 0, 0, 0.18);
            z-index: 5100;
        }

        .public-mobile-user.is-open .public-mobile-user-menu {
            display: block;
        }

        .public-mobile-user-menu a,
        .public-mobile-user-menu button {
            display: flex !important;
            align-items: center;
            justify-content: flex-start !important;
            gap: 10px;
            width: 100%;
            min-height: 48px;
            margin: 0;
            padding: 12px 18px 12px 28px;
            box-sizing: border-box;
            border: 0;
            background: transparent;
            color: #fff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 400;
            line-height: 1.4;
            text-align: left !important;
            text-decoration: none;
            cursor: pointer;
        }

        .public-mobile-user-menu a i,
        .public-mobile-user-menu button i {
            width: 20px;
            flex: 0 0 20px;
            font-size: 16px;
            text-align: center;
        }

        .public-mobile-user-menu a span,
        .public-mobile-user-menu button span {
            display: inline-block;
            margin: 0;
        }

        .public-mobile-user-menu a:hover,
        .public-mobile-user-menu button:hover {
            color: #d4af37;
            background: rgba(0, 0, 0, 0.08);
        }

        .public-mobile-user-menu form {
            margin: 0;
            padding: 0;
        }

        .public-mobile-user.is-open .public-mobile-user-arrow {
            transform: rotate(45deg);
            margin-top: -3px;
        }

        /* =========================================================
        MOBILE MENU FINAL LAYOUT
        ========================================================= */

        #publicMobileMenu {
            display: flex;
            flex-direction: column;
        }

        #publicMobileMenu .public-mobile-navigation {
            flex: 0 0 auto;
        }

        #publicMobileMenu .public-mobile-user {
            margin-top: auto;
        }


        @media (max-width: 768px) {

            /* =====================================================
            MOBILE NAVBAR
            Urutan:
            1. Navbar biru: logo Mesuji + hamburger
            2. Branding: logo UKPBJ + nama instansi
            3. Search
            ===================================================== */

            body {
                display: flex;
                flex-direction: column;
            }

            /* =====================================================
            NAVBAR BIRU
            ===================================================== */

            .public-navbar {
                order: -2;
            }

            .public-navbar-container {
                width: 100%;
                max-width: none;
                min-height: 56px;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding-left: 15px;
                padding-right: 15px;
            }

            .public-desktop-menu {
                display: none !important;
            }

            /* Logo Mesuji berada di navbar biru */
            .public-navbar .mobile-logo {
                display: block;
                width: 42px;
                height: auto;
            }

            /* Hamburger */
            .public-menu-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            /* =====================================================
            BRANDING
            ===================================================== */

            .main-header {
                order: -1;
                padding: 14px 0;
            }

            .main-header .header-flex {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 12px;
                padding-left: 15px;
                padding-right: 15px;
            }

            .main-header .logo-area {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                width: 100%;
                gap: 6px;
            }

            /* Logo Mesuji tidak ditampilkan di branding */
            .main-header .logo.mesuji {
                display: none;
            }

            /* Logo UKPBJ menjadi logo branding mobile */
            .main-header .logo.ukpbj {
                display: block;
                width: 45px;
                height: auto;
            }

            .main-header .logo-text {
                width: 100%;
                text-align: center;
            }

            .main-header .logo-text h1 {
                margin: 0;
                font-size: 16px;
                line-height: 1.3;
            }

            .main-header .logo-text h2 {
                margin: 3px 0 0;
                font-size: 10px;
                line-height: 1.3;
                font-weight: 400;
            }

            /* =====================================================
            SEARCH
            ===================================================== */

            .search-box {
                display: flex;
                width: 100%;
                max-width: 320px;
            }

            .search-box input {
                width: 100%;
            }

            /* =====================================================
            TOP BAR
            ===================================================== */

            .top-bar {
                display: none;
            }
            

            /* User desktop tidak ditampilkan.
            User mobile ada di slide menu. */

            .public-user-name {
                display: none;
            }

            .public-user-toggle {
                gap: 0;
            }

            .public-user-avatar {
                width: 29px;
                height: 29px;
            }
        }

        /* =========================================================
        RESPONSIVE - 768px
        ========================================================= */
        @media (max-width: 767.98px) {

            #publicMobileMenu {
                padding-top: 78px;
            }

            #publicMobileMenu .public-mobile-navigation {
                width: 100%;
                margin: 0;
                padding: 0 0 0 26px;
            }

            #publicMobileMenu .public-mobile-navigation > a,
            #publicMobileMenu .public-mobile-dropdown-toggle {
                padding-left: 0;
                padding-right: 16px;
            }

            #publicMobileMenu .public-mobile-dropdown-menu {
                padding-left: 14px;
            }

            #publicMobileMenu .public-mobile-dropdown-menu a {
                padding-left: 14px;
            }
        }
        

        /* =========================================================
        RESPONSIVE - 480px
        ========================================================= */

        @media (max-width: 480px) {

            .main-header {
                padding: 12px 8px;
            }

            .main-header .header-flex {
                padding-left: 0;
                padding-right: 0;
            }

            .main-header .logo.ukpbj {
                width: 42px;
            }

            .main-header .logo-text h1 {
                font-size: 14px;
            }

            .main-header .logo-text h2 {
                font-size: 9px;
            }

            .search-box {
                max-width: 320px;
            }

            .public-navbar-container {
                min-height: 54px;
                padding-left: 12px;
                padding-right: 12px;
            }

            .public-navbar .mobile-logo {
                width: 38px;
            }

            .public-menu-btn {
                padding: 4px;
                font-size: 22px;
            }

            .public-mobile-menu {
                width: 290px;
                max-width: 88vw;
            }

            .public-user-avatar {
                width: 27px;
                height: 27px;
            }
        }


        /* =========================================================
        RESPONSIVE - 360px
        ========================================================= */

        @media (max-width: 360px) {

            .container {
                width: 95%;
            }

            .logo {
                height: 50px;
            }

            .logo-text h1 {
                font-size: 15px;
                line-height: 1.3;
            }

            .logo-text h2 {
                font-size: 11px;
            }
        }


        /* =========================================================
        RESPONSIVE - 320px
        ========================================================= */

        @media (max-width: 319px) {

            .public-navbar-container {
                min-height: 52px;
                padding-left: 10px;
                padding-right: 10px;
            }

            .public-navbar .mobile-logo {
                height: 29px;
            }

            .public-menu-btn {
                padding: 3px;
                font-size: 21px;
            }

            .public-mobile-menu {
                width: 275px;
                max-width: 88vw;
                padding: 65px 18px 25px;
            }

            .public-mobile-close {
                top: 17px;
                right: 17px;
                padding: 3px;
                font-size: 23px;
            }

            .public-mobile-navigation > a,
            .public-mobile-dropdown-toggle {
                min-height: 46px;
                font-size: 15px;
            }
        }
    </style>
