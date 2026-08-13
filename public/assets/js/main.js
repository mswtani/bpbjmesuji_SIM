document.addEventListener("DOMContentLoaded", function () {
    const openNavBtn = document.getElementById("openNavBtn");
    const closeNavBtn = document.getElementById("closeNavBtn");
    const sidenav = document.getElementById("mySidenav");
    const overlay = document.getElementById("overlay");

    function openNav() {
        sidenav.style.width = "250px";
        overlay.style.display = "block";
        openNavBtn.classList.add("rotate"); // Tambahkan kelas untuk rotasi saat buka
        closeNavBtn.classList.remove("rotate-out"); // Reset rotasi tombol X saat menu dibuka
        document.body.classList.add("sidenav-open"); // Kunci scroll body
    }

    function closeNav() {
        closeNavBtn.classList.add("rotate-out"); // Tambahkan kelas rotasi saat tutup
        openNavBtn.classList.remove("rotate"); // Hapus kelas rotasi saat tutup
        document.body.classList.remove("sidenav-open"); // Buka kembali scroll body

        setTimeout(function () {
            sidenav.style.width = "0";
            overlay.style.display = "none";
        }, 250); // Beri jeda 250ms agar animasi rotasi terlihat
    }

    if (openNavBtn) {
        openNavBtn.addEventListener("click", openNav);
    }
    if (closeNavBtn) {
        closeNavBtn.addEventListener("click", closeNav);
    }
    // Tambahkan event listener untuk menutup sidenav saat overlay diklik
    if (overlay) {
        overlay.addEventListener("click", closeNav);
    }

    // Salin item navigasi ke dalam sidenav
    const mainNav = document.querySelector(".navbar .nav-links");
    const topBarUser = document.querySelector(".top-bar .user-session");
    const sideNav = document.querySelector(".sidenav .nav-links");
    const sideNavContainer = document.getElementById("mySidenav");

    if (mainNav && sideNav) {
        sideNav.innerHTML = mainNav.innerHTML;
        if (topBarUser && sideNavContainer) {
            // Buat container baru untuk user session di bagian bawah sidenav
            const sideNavFooter = document.createElement("div");
            sideNavFooter.classList.add("sidenav-footer");

            // Salin user session ke dalam footer tersebut
            sideNavFooter.appendChild(topBarUser.cloneNode(true));
            sideNavContainer.appendChild(sideNavFooter);
        }

        // Tambahkan fungsionalitas klik untuk dropdown di sidenav setelah disalin
        const sideNavDropdowns = sideNav.querySelectorAll(".dropdown-toggle");
        sideNavDropdowns.forEach(function (dropdown) {
            dropdown.addEventListener("click", function (event) {
                event.preventDefault(); // Mencegah link default
                const isCurrentlyActive = this.classList.contains("active");

                // Tutup semua dropdown yang terbuka
                sideNavDropdowns.forEach(function (otherDropdown) {
                    otherDropdown.classList.remove("active");
                    const otherMenu =
                        otherDropdown.parentElement.querySelector(
                            ".dropdown-menu",
                        );
                    if (otherMenu) {
                        otherMenu.classList.remove("show");
                    }
                });

                // Jika dropdown yang diklik tidak sedang aktif, buka
                if (!isCurrentlyActive) {
                    this.classList.add("active");
                    const menuToOpen =
                        this.parentElement.querySelector(".dropdown-menu");
                    if (menuToOpen) {
                        menuToOpen.classList.add("show");
                    }
                }
            });
            // Hapus atribut data-bs-toggle agar tidak konflik dengan Bootstrap di desktop
            // dropdown.removeAttribute("data-bs-toggle");
        });

        // Fungsionalitas untuk dropdown user di sidenav
        const sideNavUserContainer = sideNavContainer.querySelector(
            ".sidenav-footer .user-session",
        );
        if (sideNavUserContainer) {
            const sideNavUserToggle =
                sideNavUserContainer.querySelector(".dropdown-toggle");
            // Inisialisasi dropdown Bootstrap
            new bootstrap.Dropdown(sideNavUserToggle);

            // Tambahkan/hapus kelas .active saat dropdown dibuka/ditutup
            sideNavUserContainer.addEventListener(
                "show.bs.dropdown",
                function () {
                    sideNavUserToggle.classList.add("active");
                },
            );
            sideNavUserContainer.addEventListener(
                "hide.bs.dropdown",
                function () {
                    sideNavUserToggle.classList.remove("active");
                },
            );
        }

        // Hapus atribut data-bs-toggle dari nav-links (BUKAN user-session) di dalam sidenav
        // untuk mencegah konflik dengan logika dropdown kustom.
        const sideNavNavLinksDropdowns = document.querySelectorAll(
            "#mySidenav > .nav-links .dropdown-toggle",
        );
        sideNavNavLinksDropdowns.forEach(function (dropdown) {
            dropdown.removeAttribute("data-bs-toggle");
        });
    }
});
