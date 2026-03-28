import './bootstrap';
import '../css/app.css'

import Alpine from 'alpinejs'
window.Alpine= Alpine
Alpine.start()

// fitur pencegahan spam
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

// logic untuk proses animasi masuk website
document.addEventListener("DOMContentLoaded", () => {
    const introScreen = document.getElementById("intro-screen");
    const introLogo = document.getElementById("intro-logo");
    const sudahIntro = localStorage.getItem("introSeen");

    if (!sudahIntro) {
        document.body.classList.add('no-scroll');
        setTimeout(() => {
            introLogo.classList.add('in-logo');
            if (introLoad) introLoad.style.width = '100%';
        }, 300);

        setTimeout(() => {
            introLogo.classList.remove('in-logo');
            introLogo.classList.add('out-logo');

            introScreen.style.opacity = '0';

            setTimeout(() => {
                introScreen.style.display = 'none';
                document.body.classList.remove('no-scroll');
            }, 800);
            localStorage.setItem('introSeen', 'true');
        }, 2300);
    } else {
            introScreen.style.display = 'none';
    }
});