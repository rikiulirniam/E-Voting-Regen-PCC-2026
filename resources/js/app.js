import './bootstrap';

import Alpine from 'alpinejs'
window.Alpine= Alpine
Alpine.start()

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');
    const submitBtn = document.getElementById('btn_submit');

    // Menambahkan animasi tunggu & mencegah pengguna melakukan spam submit dari login page
    if (form) {
    form.addEventListener("submit", function () {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Loading...';
    });
} 
});