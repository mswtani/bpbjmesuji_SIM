import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("admin-sidebar");
    const main = document.getElementById("admin-main");
    const toggle = document.getElementById("admin-sidebar-toggle");
    const closeButton = document.getElementById("admin-sidebar-close");
    const overlay = document.getElementById("admin-sidebar-overlay");

    const sidebarLabels = document.querySelectorAll(".admin-sidebar-label");
    const sidebarBrand = document.querySelector(".admin-sidebar-brand");
    const topbarBrand = document.getElementById("admin-topbar-brand");

    const userButton = document.getElementById("admin-user-menu-button");
    const userMenu = document.getElementById("admin-user-menu");

    if (!sidebar || !main || !toggle) {
        console.warn("Admin sidebar elements tidak ditemukan.");
        return;
    }

    let collapsed = localStorage.getItem("admin-sidebar-collapsed") === "true";

    /*
    |--------------------------------------------------------------------------
    | Desktop Sidebar
    |--------------------------------------------------------------------------
    */

    function applyDesktopState() {
        if (window.innerWidth < 1024) {
            return;
        }

        sidebar.classList.remove("-translate-x-full");
        sidebar.classList.add("translate-x-0");

        if (collapsed) {
            // Sidebar kecil
            sidebar.style.width = "72px";
            main.style.marginLeft = "72px";

            sidebarLabels.forEach((label) => {
                label.classList.add("hidden");
            });

            if (sidebarBrand) {
                sidebarBrand.classList.add("hidden");
            }

            if (topbarBrand) {
                topbarBrand.classList.remove("hidden");
                topbarBrand.classList.add("flex");
            }

            toggle.setAttribute("aria-expanded", "false");
        } else {
            // Sidebar normal
            sidebar.style.width = "256px";
            main.style.marginLeft = "256px";

            sidebarLabels.forEach((label) => {
                label.classList.remove("hidden");
            });

            if (sidebarBrand) {
                sidebarBrand.classList.remove("hidden");
            }

            if (topbarBrand) {
                topbarBrand.classList.add("hidden");
                topbarBrand.classList.remove("flex");
            }

            toggle.setAttribute("aria-expanded", "true");
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Global Confirmation Modal
    |--------------------------------------------------------------------------
    */

    const confirmModal = document.getElementById("admin-confirm-modal");
    const confirmOverlay = document.getElementById("admin-confirm-overlay");
    const confirmClose = document.getElementById("admin-confirm-close");
    const confirmCancel = document.getElementById("admin-confirm-cancel");
    const confirmMessage = document.getElementById("admin-confirm-message");
    const confirmButton = document.getElementById("admin-confirm-submit");
    const confirmIcon = document.getElementById("admin-confirm-icon");
    const confirmIcons = document.querySelectorAll(
        "#admin-confirm-icon [data-confirm-icon]",
    );

    let confirmForm = null;

    function openConfirmModal(form, message) {
        if (!confirmModal || !confirmMessage) {
            return;
        }

        confirmForm = form;

        confirmMessage.textContent = message;

        /*
    |--------------------------------------------------------------------------
    | Action Type
    |--------------------------------------------------------------------------
    */

        const action = form.getAttribute("data-confirm-action") || "default";

        const buttonText =
            form.getAttribute("data-confirm-button") || "Konfirmasi";

        /*
    |--------------------------------------------------------------------------
    | Reset Icon
    |--------------------------------------------------------------------------
    */

        confirmIcons.forEach((icon) => {
            icon.classList.add("hidden");
        });

        /*
|--------------------------------------------------------------------------
| Action Style
|--------------------------------------------------------------------------
*/

        // Reset style icon
        confirmIcon.className =
            "flex h-16 w-16 items-center justify-center rounded-2xl";

        // Reset style button
        confirmButton.className =
            "inline-flex min-w-[120px] items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold shadow-sm transition focus:outline-none focus:ring-2";

        // Pastikan button tidak disabled
        confirmButton.disabled = false;

        // Default warna
        let iconBg = "#eff6ff";
        let iconColor = "#2563eb";
        let buttonBg = "#2563eb";
        let buttonHover = "#1d4ed8";
        let focusColor = "rgba(37, 99, 235, 0.30)";

        if (action === "publish") {
            iconBg = "#ecfdf5";
            iconColor = "#059669";
            buttonBg = "#059669";
            buttonHover = "#047857";
            focusColor = "rgba(5, 150, 105, 0.30)";
        } else if (action === "archive") {
            iconBg = "#fff7ed";
            iconColor = "#ea580c";
            buttonBg = "#ea580c";
            buttonHover = "#c2410c";
            focusColor = "rgba(234, 88, 12, 0.30)";
        } else if (action === "restore") {
            iconBg = "#eff6ff";
            iconColor = "#2563eb";
            buttonBg = "#2563eb";
            buttonHover = "#1d4ed8";
            focusColor = "rgba(37, 99, 235, 0.30)";
        } else if (action === "delete") {
            iconBg = "#fef2f2";
            iconColor = "#dc2626";
            buttonBg = "#dc2626";
            buttonHover = "#b91c1c";
            focusColor = "rgba(220, 38, 38, 0.30)";
        } else if (action === "deactivate") {
            iconBg = "#fef2f2";
            iconColor = "#dc2626";
            buttonBg = "#dc2626";
            buttonHover = "#b91c1c";
            focusColor = "rgba(220, 38, 38, 0.30)";
        } else if (action === "reset-password") {
            iconBg = "#fff7ed";
            iconColor = "#ea580c";
            buttonBg = "#ea580c";
            buttonHover = "#c2410c";
            focusColor = "rgba(234, 88, 12, 0.30)";
        } else if (action === "activate") {
            iconBg = "#ecfdf5";
            iconColor = "#059669";
            buttonBg = "#059669";
            buttonHover = "#047857";
            focusColor = "rgba(5, 150, 105, 0.30)";
        } else if (action === "update") {
            iconBg = "#eff6ff";
            iconColor = "#2563eb";
            buttonBg = "#2563eb";
            buttonHover = "#1d4ed8";
            focusColor = "rgba(37, 99, 235, 0.30)";
        }

        // Terapkan warna icon
        confirmIcon.style.backgroundColor = iconBg;
        confirmIcon.style.color = iconColor;

        // Terapkan warna button secara langsung
        // supaya tidak tertimpa style lain dari Tailwind/CSS
        confirmButton.style.backgroundColor = buttonBg;
        confirmButton.style.color = "#ffffff";
        confirmButton.style.borderColor = buttonBg;
        confirmButton.style.boxShadow = "none";

        // Hover button
        confirmButton.onmouseenter = () => {
            confirmButton.style.backgroundColor = buttonHover;
        };

        confirmButton.onmouseleave = () => {
            confirmButton.style.backgroundColor = buttonBg;
        };

        confirmButton.onfocus = () => {
            confirmButton.style.boxShadow = `0 0 0 3px ${focusColor}`;
        };

        confirmButton.onblur = () => {
            confirmButton.style.boxShadow = "none";
        };

        /*
    |--------------------------------------------------------------------------
    | Show Selected Icon
    |--------------------------------------------------------------------------
    */

        const selectedIcon = confirmIcon?.querySelector(
            `[data-confirm-icon="${action}"]`,
        );

        if (selectedIcon) {
            selectedIcon.classList.remove("hidden");
        }

        /*
    |--------------------------------------------------------------------------
    | Button Text
    |--------------------------------------------------------------------------
    */

        confirmButton.textContent = buttonText;
        confirmButton.disabled = false;

        /*
    |--------------------------------------------------------------------------
    | Open
    |--------------------------------------------------------------------------
    */

        confirmModal.classList.remove("hidden");

        confirmModal.setAttribute("aria-hidden", "false");

        document.body.classList.add("overflow-hidden");

        requestAnimationFrame(() => {
            confirmButton?.focus();
        });
    }

    function closeConfirmModal() {
        if (!confirmModal) {
            return;
        }

        confirmModal.classList.add("hidden");
        confirmModal.setAttribute("aria-hidden", "true");

        document.body.classList.remove("overflow-hidden");

        confirmForm = null;
    }

    function submitConfirmForm() {
        if (!confirmForm) {
            closeConfirmModal();
            return;
        }

        const form = confirmForm;

        closeConfirmModal();

        form.submit();
    }

    /*
    |--------------------------------------------------------------------------
    | Confirmation Modal Events
    |--------------------------------------------------------------------------
    */

    if (confirmModal) {
        confirmClose?.addEventListener("click", () => {
            closeConfirmModal();
        });

        confirmCancel?.addEventListener("click", () => {
            closeConfirmModal();
        });

        confirmOverlay?.addEventListener("click", () => {
            closeConfirmModal();
        });

        confirmButton?.addEventListener("click", () => {
            submitConfirmForm();
        });

        document.addEventListener("keydown", (event) => {
            if (
                event.key === "Escape" &&
                !confirmModal.classList.contains("hidden")
            ) {
                closeConfirmModal();
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Confirmation Forms
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll("form[data-confirm]").forEach((form) => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();

            const message =
                form.getAttribute("data-confirm") ||
                "Apakah Anda yakin ingin melanjutkan tindakan ini?";

            openConfirmModal(form, message);
        });
    });

    /*
|--------------------------------------------------------------------------
| Post Edit - Reset Form
|--------------------------------------------------------------------------
*/

    const postEditForm = document.getElementById("post-edit-form");
    const postEditCancel = document.getElementById("post-edit-cancel");

    if (postEditForm && postEditCancel) {
        const contentEditors = postEditForm.querySelectorAll(
            '[contenteditable="true"]',
        );

        const initialEditorContents = new Map();

        contentEditors.forEach((editor) => {
            initialEditorContents.set(editor.id, editor.innerHTML);
        });

        postEditCancel.addEventListener("click", () => {
            /*
        |--------------------------------------------------------------------------
        | Reset native form
        |--------------------------------------------------------------------------
        */

            postEditForm.reset();

            /*
        |--------------------------------------------------------------------------
        | Restore contenteditable editor
        |--------------------------------------------------------------------------
        */

            contentEditors.forEach((editor) => {
                if (initialEditorContents.has(editor.id)) {
                    editor.innerHTML = initialEditorContents.get(editor.id);
                }
            });

            /*
        |--------------------------------------------------------------------------
        | Sinkronisasi textarea hidden
        |--------------------------------------------------------------------------
        */

            contentEditors.forEach((editor) => {
                const textareaId =
                    editor.id === "content-editor" ? "content" : null;

                if (!textareaId) {
                    return;
                }

                const textarea = document.getElementById(textareaId);

                if (textarea) {
                    textarea.value = initialEditorContents.get(editor.id) || "";
                }
            });

            /*
        |--------------------------------------------------------------------------
        | Jalankan kembali event field dinamis
        |--------------------------------------------------------------------------
        */

            const typeSelect = document.getElementById("type");
            const legalStatusSelect = document.getElementById("legal_status");

            const regulationTypeSelect =
                document.getElementById("regulation_type_id");

            typeSelect?.dispatchEvent(new Event("change", { bubbles: true }));

            legalStatusSelect?.dispatchEvent(
                new Event("change", { bubbles: true }),
            );

            regulationTypeSelect?.dispatchEvent(
                new Event("change", { bubbles: true }),
            );
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Mobile
    |--------------------------------------------------------------------------
    */

    function openMobileSidebar() {
        sidebar.style.width = "256px";

        sidebar.classList.remove("-translate-x-full");
        sidebar.classList.add("translate-x-0");

        overlay.classList.remove("hidden");

        sidebarLabels.forEach((label) => {
            label.classList.remove("hidden");
        });

        if (sidebarBrand) {
            sidebarBrand.classList.remove("hidden");
        }

        if (topbarBrand) {
            topbarBrand.classList.add("hidden");
            topbarBrand.classList.remove("flex");
        }
    }

    function closeMobileSidebar() {
        sidebar.classList.add("-translate-x-full");
        sidebar.classList.remove("translate-x-0");

        overlay.classList.add("hidden");
    }

    /*
    |--------------------------------------------------------------------------
    | Hamburger
    |--------------------------------------------------------------------------
    */

    toggle.addEventListener("click", () => {
        if (window.innerWidth < 1024) {
            const isOpen = sidebar.classList.contains("translate-x-0");

            if (isOpen) {
                closeMobileSidebar();
            } else {
                openMobileSidebar();
            }

            return;
        }

        // Desktop
        collapsed = !collapsed;

        localStorage.setItem(
            "admin-sidebar-collapsed",
            collapsed ? "true" : "false",
        );

        applyDesktopState();
    });

    /*
    |--------------------------------------------------------------------------
    | Close Mobile Sidebar
    |--------------------------------------------------------------------------
    */

    if (closeButton) {
        closeButton.addEventListener("click", () => {
            if (window.innerWidth < 1024) {
                closeMobileSidebar();
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Overlay
    |--------------------------------------------------------------------------
    */

    if (overlay) {
        overlay.addEventListener("click", () => {
            closeMobileSidebar();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | User Dropdown
    |--------------------------------------------------------------------------
    */

    if (userButton && userMenu) {
        userButton.addEventListener("click", (event) => {
            event.stopPropagation();

            userMenu.classList.toggle("hidden");

            userButton.setAttribute(
                "aria-expanded",
                userMenu.classList.contains("hidden") ? "false" : "true",
            );
        });

        document.addEventListener("click", () => {
            userMenu.classList.add("hidden");

            userButton.setAttribute("aria-expanded", "false");
        });

        userMenu.addEventListener("click", (event) => {
            event.stopPropagation();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Resize
    |--------------------------------------------------------------------------
    */

    window.addEventListener("resize", () => {
        if (window.innerWidth >= 1024) {
            overlay.classList.add("hidden");

            applyDesktopState();
        } else {
            // Mobile
            main.style.marginLeft = "0";
            sidebar.style.width = "256px";

            closeMobileSidebar();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Initial State
    |--------------------------------------------------------------------------
    */

    if (window.innerWidth >= 1024) {
        applyDesktopState();
    } else {
        main.style.marginLeft = "0";

        closeMobileSidebar();
    }

    /*
|--------------------------------------------------------------------------
| User Update Success Modal
|--------------------------------------------------------------------------
*/

    const userUpdateSuccessModal = document.getElementById(
        "user-update-success-modal",
    );

    const userUpdateSuccessClose = document.getElementById(
        "user-update-success-close",
    );

    if (userUpdateSuccessModal) {
        userUpdateSuccessClose?.addEventListener("click", () => {
            userUpdateSuccessModal.classList.add("hidden");
        });
    }

    /*
|--------------------------------------------------------------------------
| User Success Modal
|--------------------------------------------------------------------------
*/

    const userSuccessModal = document.getElementById("user-success-modal");

    const userSuccessClose = document.getElementById("user-success-close");

    const userSuccessIcon = document.getElementById("user-success-icon");

    const userSuccessIcons = document.querySelectorAll(
        "#user-success-icon [data-success-icon]",
    );

    if (userSuccessModal) {
        const successAction = userSuccessModal.getAttribute(
            "data-success-action",
        );

        userSuccessIcons.forEach((icon) => {
            icon.classList.add("hidden");
        });

        const selectedIcon = userSuccessModal.querySelector(
            `[data-success-icon="${successAction}"]`,
        );

        if (selectedIcon) {
            selectedIcon.classList.remove("hidden");
        }

        /*
    |--------------------------------------------------------------------------
    | Warna Icon Success
    |--------------------------------------------------------------------------
    */

        if (successAction === "activate") {
            userSuccessIcon.style.backgroundColor = "#ecfdf5";
            userSuccessIcon.style.color = "#059669";
        } else if (successAction === "deactivate") {
            userSuccessIcon.style.backgroundColor = "#fef2f2";
            userSuccessIcon.style.color = "#dc2626";
        } else if (successAction === "reset-password") {
            userSuccessIcon.style.backgroundColor = "#fff7ed";
            userSuccessIcon.style.color = "#ea580c";
        }

        userSuccessClose?.addEventListener("click", () => {
            userSuccessModal.classList.add("hidden");
        });
    }

    /*
|--------------------------------------------------------------------------
| Copy Temporary Password
|--------------------------------------------------------------------------
*/

    const copyPasswordButton = document.getElementById(
        "copy-temporary-password",
    );

    const temporaryPassword = document.getElementById("temporary-password");

    const copyPasswordIcon = document.getElementById("copy-password-icon");

    if (copyPasswordButton && temporaryPassword && copyPasswordIcon) {
        copyPasswordButton.addEventListener("click", () => {
            const password = temporaryPassword.textContent.trim();

            if (!password) {
                return;
            }

            /*
        |--------------------------------------------------------------------------
        | Buat textarea sementara
        |--------------------------------------------------------------------------
        */

            const textarea = document.createElement("textarea");

            textarea.value = password;

            textarea.setAttribute("readonly", "");

            textarea.style.position = "fixed";
            textarea.style.left = "-9999px";
            textarea.style.top = "0";
            textarea.style.width = "1px";
            textarea.style.height = "1px";
            textarea.style.opacity = "0";

            document.body.appendChild(textarea);

            /*
        |--------------------------------------------------------------------------
        | Pilih password
        |--------------------------------------------------------------------------
        */

            textarea.focus();
            textarea.select();
            textarea.setSelectionRange(0, textarea.value.length);

            /*
        |--------------------------------------------------------------------------
        | Copy
        |--------------------------------------------------------------------------
        */

            let copied = false;

            try {
                copied = document.execCommand("copy");
            } catch (error) {
                console.error("Gagal menyalin password:", error);
            }

            textarea.remove();

            /*
        |--------------------------------------------------------------------------
        | Berhasil
        |--------------------------------------------------------------------------
        */

            if (!copied) {
                console.warn("Password tidak berhasil disalin.");

                return;
            }

            /*
        |--------------------------------------------------------------------------
        | Ubah icon menjadi check
        |--------------------------------------------------------------------------
        */

            copyPasswordIcon.innerHTML = `
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m5 12 4 4L19 7"
            />
        `;

            /*
        |--------------------------------------------------------------------------
        | Ubah warna tombol
        |--------------------------------------------------------------------------
        */

            copyPasswordButton.classList.remove("text-orange-600");

            copyPasswordButton.classList.add(
                "bg-emerald-50",
                "text-emerald-600",
            );

            copyPasswordButton.setAttribute("title", "Password tersalin");

            copyPasswordButton.setAttribute(
                "aria-label",
                "Password berhasil disalin",
            );

            /*
        |--------------------------------------------------------------------------
        | Notifikasi kecil
        |--------------------------------------------------------------------------
        */

            const wrapper = copyPasswordButton.parentElement;

            const oldMessage = document.getElementById("copy-password-success");

            oldMessage?.remove();

            const message = document.createElement("span");

            message.id = "copy-password-success";

            message.className = `
            absolute
            right-0
            top-full
            z-30
            mt-2
            whitespace-nowrap
            rounded-md
            bg-gray-900
            px-3
            py-1.5
            text-xs
            font-medium
            text-white
            shadow-lg
        `;

            message.textContent = "✓ Password tersalin";

            wrapper.classList.add("relative");

            wrapper.appendChild(message);

            /*
        |--------------------------------------------------------------------------
        | Kembalikan tampilan setelah 1,8 detik
        |--------------------------------------------------------------------------
        */

            setTimeout(() => {
                copyPasswordIcon.innerHTML = `
                <rect
                    x="9"
                    y="9"
                    width="10"
                    height="10"
                    rx="2"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 9V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"
                />
            `;

                copyPasswordButton.classList.remove(
                    "bg-emerald-50",
                    "text-emerald-600",
                );

                copyPasswordButton.classList.add("text-orange-600");

                copyPasswordButton.setAttribute("title", "Salin password");

                copyPasswordButton.setAttribute("aria-label", "Salin password");

                message.remove();
            }, 1800);
        });
    }
});
