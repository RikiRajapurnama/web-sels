import './bootstrap';

function initMobileMenu() {
    const toggle = document.querySelector('[data-mobile-menu-toggle]');
    const menu = document.querySelector('[data-mobile-menu]');
    if (!toggle || !menu) return;

    toggle.addEventListener('click', () => {
        const hidden = menu.classList.toggle('hidden');
        toggle.setAttribute('aria-expanded', String(!hidden));
        const icon = toggle.querySelector('[data-icon-open], [data-icon-close]');
        if (icon) {
            const open = toggle.querySelector('[data-icon-open]');
            const close = toggle.querySelector('[data-icon-close]');
            if (open) open.classList.toggle('hidden');
            if (close) close.classList.toggle('hidden');
        }
    });
}

function initAdminSidebar() {
    const toggle = document.querySelector('[data-sidebar-toggle]');
    const overlay = document.querySelector('[data-sidebar-overlay]');
    const sidebar = document.querySelector('[data-sidebar]');
    if (!toggle || !sidebar) return;

    const open = () => {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        if (overlay) overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
    };
    const close = () => {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        if (overlay) overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
    };

    toggle.addEventListener('click', open);
    if (overlay) overlay.addEventListener('click', close);
}

function initDropdown() {
    document.querySelectorAll('[data-dropdown-button]').forEach((button) => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const target = document.querySelector(button.dataset.dropdownButton);
            if (!target) return;
            target.classList.toggle('hidden');
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('[data-dropdown-menu]').forEach((menu) => menu.classList.add('hidden'));
    });
}

function initToasts() {
    document.querySelectorAll('[data-toast]').forEach((toast) => {
        setTimeout(() => {
            toast.style.transition = 'opacity 0.4s ease';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 4000);
    });
}

function initCloseAlerts() {
    document.querySelectorAll('[data-close-alert]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const alert = btn.closest('[data-alert]');
            if (alert) alert.remove();
        });
    });
}

function initDeleteForms() {
    document.querySelectorAll('[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', (e) => {
            if (!confirm(form.dataset.confirmDelete || 'Yakin ingin menghapus data ini?')) {
                e.preventDefault();
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initAdminSidebar();
    initDropdown();
    initToasts();
    initCloseAlerts();
    initDeleteForms();
});
