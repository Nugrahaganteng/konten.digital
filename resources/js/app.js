import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Logic Tabs Layanan (Dengan Auto Play)
    const tabs = document.querySelectorAll('.stab');
    const panels = document.querySelectorAll('[id^="spanel-"]');
    let currentTab = 0;
    let tabTimer;

    function switchTab(index) {
        if (!tabs.length) return;
        
        // Sembunyikan panel saat ini
        panels[currentTab].classList.replace('grid', 'hidden');
        tabs[currentTab].classList.remove('bg-black', 'text-yellow-400');
        tabs[currentTab].classList.add('bg-white', 'text-black');

        // Update Index
        currentTab = (index + tabs.length) % tabs.length;

        // Munculkan panel baru
        panels[currentTab].classList.replace('hidden', 'grid');
        tabs[currentTab].classList.remove('bg-white', 'text-black');
        tabs[currentTab].classList.add('bg-black', 'text-yellow-400');
    }

    // Event Klik Tabs
    tabs.forEach((tab, idx) => {
        tab.addEventListener('click', () => {
            clearInterval(tabTimer); // hentikan timer otomatis jika di klik
            switchTab(idx);
            startTimer(); // mulai lagi
        });
    });

    // Auto putar tab setiap 6 detik
    function startTimer() { 
        if(tabs.length) tabTimer = setInterval(() => switchTab(currentTab + 1), 6000); 
    }
    startTimer();


    // 2. Scroll Reveal (Muncul saat discroll)
    const revealElements = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, { threshold: 0.15 }); // 15% elemen terlihat baru muncul

    revealElements.forEach(el => observer.observe(el));


    // 3. Mouse Parallax Effect (Efek melayang mengikuti cursor retro)
    document.addEventListener('mousemove', (e) => {
        // Kalkulasi pergerakan mouse
        const x = (window.innerWidth / 2 - e.pageX) / 45;
        const y = (window.innerHeight / 2 - e.pageY) / 45;
        
        // Target elemen roket, ufo, dan bintang
        document.querySelectorAll('.animate-float, .animate-ufo, .animate-rocket').forEach(el => {
            el.style.transform = `translate(${x}px, ${y}px)`;
        });
    });
});