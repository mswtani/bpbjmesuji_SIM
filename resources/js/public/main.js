document.addEventListener("DOMContentLoaded", () => {
    /*
    |--------------------------------------------------------------------------
    | USER DROPDOWN - DESKTOP
    |--------------------------------------------------------------------------
    */

    const userDropdown = document.querySelector(".public-user-dropdown");
    const userToggle = document.querySelector(".public-user-toggle");

    if (userDropdown && userToggle) {
        userToggle.addEventListener("click", (event) => {
            event.stopPropagation();

            const isOpen = userDropdown.classList.toggle("is-open");

            userToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");

            // Tutup dropdown navigasi lain
            document
                .querySelectorAll(".public-dropdown.is-open")
                .forEach((dropdown) => {
                    dropdown.classList.remove("is-open");

                    const button = dropdown.querySelector(
                        ".public-dropdown-toggle",
                    );

                    if (button) {
                        button.setAttribute("aria-expanded", "false");
                    }
                });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | DESKTOP DROPDOWN
    |--------------------------------------------------------------------------
    */

    const desktopDropdowns = document.querySelectorAll(".public-dropdown");

    desktopDropdowns.forEach((dropdown) => {
        const button = dropdown.querySelector(".public-dropdown-toggle");

        if (!button) {
            return;
        }

        button.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            const isOpen = dropdown.classList.contains("is-open");

            // Tutup dropdown lain
            desktopDropdowns.forEach((item) => {
                item.classList.remove("is-open");

                const itemButton = item.querySelector(
                    ".public-dropdown-toggle",
                );

                if (itemButton) {
                    itemButton.setAttribute("aria-expanded", "false");
                }
            });

            // Buka dropdown yang dipilih
            if (!isOpen) {
                dropdown.classList.add("is-open");

                button.setAttribute("aria-expanded", "true");
            }
        });
    });

    /*
|--------------------------------------------------------------------------
| MOBILE MENU
|--------------------------------------------------------------------------
*/

    const menuButton = document.getElementById("publicMenuBtn");
    const mobileMenu = document.getElementById("publicMobileMenu");
    const mobileClose = document.getElementById("publicMobileClose");
    const mobileBackdrop = document.getElementById("publicMobileBackdrop");

    function openMobileMenu() {
        if (!mobileMenu) {
            return;
        }

        mobileMenu.classList.add("is-open");

        if (mobileBackdrop) {
            mobileBackdrop.classList.add("is-open");
        }

        if (menuButton) {
            menuButton.setAttribute("aria-expanded", "true");
        }

        mobileMenu.setAttribute("aria-hidden", "false");

        document.body.classList.add("public-menu-open");
    }

    function closeMobileMenu() {
        if (!mobileMenu) {
            return;
        }

        mobileMenu.classList.remove("is-open");

        if (mobileBackdrop) {
            mobileBackdrop.classList.remove("is-open");
        }

        if (menuButton) {
            menuButton.setAttribute("aria-expanded", "false");
        }

        mobileMenu.setAttribute("aria-hidden", "true");

        document.body.classList.remove("public-menu-open");

        /*
         * Tutup semua dropdown mobile
         */
        document
            .querySelectorAll(".public-mobile-dropdown")
            .forEach((dropdown) => {
                dropdown.classList.remove("is-open");
            });

        document
            .querySelectorAll(".public-mobile-dropdown-toggle")
            .forEach((button) => {
                button.classList.remove("is-open");
                button.setAttribute("aria-expanded", "false");
            });

        /*
         * Tutup dropdown user
         */
        if (mobileUser) {
            mobileUser.classList.remove("is-open");
        }

        if (mobileUserToggle) {
            mobileUserToggle.setAttribute("aria-expanded", "false");
        }
    }

    /*
|--------------------------------------------------------------------------
| HAMBURGER
|--------------------------------------------------------------------------
*/

    if (menuButton) {
        menuButton.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            if (mobileMenu && mobileMenu.classList.contains("is-open")) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    /*
|--------------------------------------------------------------------------
| CLOSE BUTTON
|--------------------------------------------------------------------------
*/

    if (mobileClose) {
        mobileClose.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            closeMobileMenu();
        });
    }

    /*
|--------------------------------------------------------------------------
| BACKDROP
|--------------------------------------------------------------------------
*/

    if (mobileBackdrop) {
        mobileBackdrop.addEventListener("click", () => {
            closeMobileMenu();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | MOBILE DROPDOWN
    |--------------------------------------------------------------------------
    */

    const mobileUser = document.querySelector(".public-mobile-user");

    const mobileUserToggle = document.querySelector(
        ".public-mobile-user-toggle",
    );

    if (
        mobileUser &&
        mobileUserToggle &&
        mobileUserToggle.tagName === "BUTTON"
    ) {
        mobileUserToggle.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            const isOpen = mobileUser.classList.toggle("is-open");

            mobileUserToggle.setAttribute(
                "aria-expanded",
                isOpen ? "true" : "false",
            );
        });
    }

    const mobileDropdowns = document.querySelectorAll(
        ".public-mobile-dropdown",
    );

    mobileDropdowns.forEach((dropdown) => {
        const button = dropdown.querySelector(".public-mobile-dropdown-toggle");

        const menu = dropdown.querySelector(".public-mobile-dropdown-menu");

        if (!button || !menu) {
            return;
        }

        button.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            const isOpen = dropdown.classList.contains("is-open");

            // Tutup dropdown mobile lainnya
            mobileDropdowns.forEach((item) => {
                if (item !== dropdown) {
                    item.classList.remove("is-open");

                    const itemButton = item.querySelector(
                        ".public-mobile-dropdown-toggle",
                    );

                    if (itemButton) {
                        itemButton.classList.remove("is-open");

                        itemButton.setAttribute("aria-expanded", "false");
                    }
                }
            });

            if (isOpen) {
                dropdown.classList.remove("is-open");

                button.classList.remove("is-open");

                button.setAttribute("aria-expanded", "false");
            } else {
                dropdown.classList.add("is-open");

                button.classList.add("is-open");

                button.setAttribute("aria-expanded", "true");
            }
        });
    });

    /*
    |--------------------------------------------------------------------------
    | CLICK OUTSIDE DESKTOP DROPDOWN
    |--------------------------------------------------------------------------
    */

    document.addEventListener("click", () => {
        if (userDropdown) {
            userDropdown.classList.remove("is-open");

            if (userToggle) {
                userToggle.setAttribute("aria-expanded", "false");
            }
        }

        desktopDropdowns.forEach((dropdown) => {
            dropdown.classList.remove("is-open");

            const button = dropdown.querySelector(".public-dropdown-toggle");

            if (button) {
                button.setAttribute("aria-expanded", "false");
            }
        });
    });

    /*
    |--------------------------------------------------------------------------
    | ESCAPE KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeMobileMenu();

            if (userDropdown) {
                userDropdown.classList.remove("is-open");
            }

            desktopDropdowns.forEach((dropdown) => {
                dropdown.classList.remove("is-open");
            });
        }
    });

    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE RESET
    |--------------------------------------------------------------------------
    */

    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            closeMobileMenu();
        }
    });

    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            closeMobileMenu();
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    /*
     * =====================================================
     * TAB STRUKTUR ORGANISASI
     * =====================================================
     */

    const tabs = document.querySelectorAll(".public-profile-tab");
    const tabContents = document.querySelectorAll(
        ".public-profile-tab-content",
    );

    tabs.forEach(function (tab) {
        tab.addEventListener("click", function () {
            const targetId = tab.dataset.tab;

            tabs.forEach(function (item) {
                item.classList.remove("active");
            });

            tabContents.forEach(function (content) {
                content.classList.remove("active");
            });

            tab.classList.add("active");

            const target = document.getElementById(targetId);

            if (target) {
                target.classList.add("active");
            }
        });
    });

    /*
     * =====================================================
     * MODAL ORGANISASI
     * =====================================================
     */

    const modal = document.getElementById("public-profile-org-modal");

    const modalClose = document.getElementById("public-profile-modal-close");

    const modalAvatar = document.getElementById("public-profile-modal-avatar");

    const modalName = document.getElementById("public-profile-modal-name");

    const modalJabatan = document.getElementById(
        "public-profile-modal-jabatan",
    );

    const modalNip = document.getElementById("public-profile-modal-nip");

    const orgCards = document.querySelectorAll(".public-profile-org-card");

    function openModal(card) {
        if (!modal) {
            return;
        }

        const name = card.dataset.name || "";
        const jabatan = card.dataset.jabatan || "";
        const nip = card.dataset.nip || "";
        const foto = card.dataset.foto || "";

        modalName.textContent = name;
        modalJabatan.textContent = jabatan;
        modalNip.textContent = nip;

        if (foto) {
            modalAvatar.style.backgroundImage = `url("${foto}")`;
        } else {
            modalAvatar.style.backgroundImage = "";
        }

        modal.classList.add("active");
        modal.setAttribute("aria-hidden", "false");

        document.body.style.overflow = "hidden";
    }

    function closeModal() {
        if (!modal) {
            return;
        }

        modal.classList.remove("active");
        modal.setAttribute("aria-hidden", "true");

        document.body.style.overflow = "";
    }

    orgCards.forEach(function (card) {
        card.addEventListener("click", function () {
            openModal(card);
        });
    });

    if (modalClose) {
        modalClose.addEventListener("click", closeModal);
    }

    if (modal) {
        modal.addEventListener("click", function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });
});
