import './bootstrap';
import '../css/app.css'

import Alpine from 'alpinejs'
window.Alpine= Alpine
Alpine.start()

// fitur pencegahan spam
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