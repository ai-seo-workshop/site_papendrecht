/* Papendrecht.net — main.js */
(function () {
    'use strict';

    // ── Mobile menu toggle ───────────────────────────────────────────────────
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu  = document.getElementById('close-menu');
    const mainMenu   = document.getElementById('main-menu');

    function openMenu() {
        if (!mainMenu) return;
        mainMenu.classList.add('open');
        if (menuToggle) menuToggle.setAttribute('aria-expanded', 'true');
    }

    function closeMenuFn() {
        if (!mainMenu) return;
        mainMenu.classList.remove('open');
        if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            mainMenu.classList.contains('open') ? closeMenuFn() : openMenu();
        });
    }

    if (closeMenu) {
        closeMenu.addEventListener('click', function (e) {
            e.stopPropagation();
            closeMenuFn();
        });
    }

    // Close menu when clicking outside
    document.addEventListener('click', function (e) {
        if (mainMenu && mainMenu.classList.contains('open')) {
            if (!mainMenu.contains(e.target) && e.target !== menuToggle) {
                closeMenuFn();
            }
        }
    });

    // ── Sub-menu (dropdown) toggles ─────────────────────────────────────────
    const dropdownTriggers = document.querySelectorAll('#main-menu .toggle-button.with-children');

    dropdownTriggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            const targetId = trigger.getAttribute('data-toggle');
            const submenu  = document.getElementById(targetId);
            if (!submenu) return;

            const isOpen = submenu.classList.contains('open');

            // Close all open submenus first
            document.querySelectorAll('#main-menu ul.open').forEach(function (m) {
                m.classList.remove('open');
            });
            document.querySelectorAll('#main-menu .toggle-button.with-children.active').forEach(function (b) {
                b.classList.remove('active');
            });

            if (!isOpen) {
                submenu.classList.add('open');
                trigger.classList.add('active');
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function () {
        document.querySelectorAll('#main-menu ul.open').forEach(function (m) {
            m.classList.remove('open');
        });
        document.querySelectorAll('#main-menu .toggle-button.with-children.active').forEach(function (b) {
            b.classList.remove('active');
        });
    });

    // ── Search toggle ────────────────────────────────────────────────────────
    const searchToggle = document.getElementById('search-toggle');
    const searchForm   = document.getElementById('search-form');

    if (searchToggle && searchForm) {
        searchToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = searchForm.classList.contains('open');
            searchForm.classList.toggle('open', !isOpen);
            searchToggle.setAttribute('aria-expanded', String(!isOpen));
            if (!isOpen) {
                const inp = searchForm.querySelector('input[type="text"]');
                if (inp) inp.focus();
            }
        });

        document.addEventListener('click', function (e) {
            if (!searchForm.contains(e.target) && e.target !== searchToggle) {
                searchForm.classList.remove('open');
                searchToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ── Category page: navigate on select change ─────────────────────────────
    const catSelect = document.getElementById('news-category-select');
    if (catSelect) {
        catSelect.addEventListener('change', function () {
            const url = this.value;
            if (url) window.location.href = url;
        });
    }

    // ── FAQ accordion ────────────────────────────────────────────────────────
    const faqHeadings = document.querySelectorAll('.faq-item h3');

    faqHeadings.forEach(function (heading) {
        heading.addEventListener('click', function () {
            const answer = heading.nextElementSibling;
            if (!answer) return;
            const isOpen = answer.classList.contains('open');
            heading.classList.toggle('open', !isOpen);
            answer.classList.toggle('open', !isOpen);
        });
    });

    // ── Back to top (if element exists) ─────────────────────────────────────
    const backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            backToTop.style.display = window.scrollY > 400 ? 'flex' : 'none';
        });
        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ── Copy link button ─────────────────────────────────────────────────────
    document.querySelectorAll('button.copy').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const url = btn.getAttribute('data-value');
            if (!url) return;
            navigator.clipboard.writeText(url).then(function () {
                btn.querySelector('.original-icon') && (btn.querySelector('.original-icon').style.display = 'none');
                btn.querySelector('.copied-icon') && (btn.querySelector('.copied-icon').style.display = 'inline');
                setTimeout(function () {
                    btn.querySelector('.original-icon') && (btn.querySelector('.original-icon').style.display = '');
                    btn.querySelector('.copied-icon') && (btn.querySelector('.copied-icon').style.display = 'none');
                }, 2000);
            }).catch(function () {});
        });
    });

})();
