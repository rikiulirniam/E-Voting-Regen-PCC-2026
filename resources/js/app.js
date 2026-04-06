import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');

    if (!form) return;

    const submitBtn = document.getElementById('btn_submit');

    if (!submitBtn) return;

    form.addEventListener("submit", function () {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Loading...';
    });
});