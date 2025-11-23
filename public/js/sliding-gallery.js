document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('sliding-gallery-container');
    if (!container) return;

    const slides = Array.from(container.querySelectorAll('.slide'));
    if (!slides.length) return;

    let idx = 0;
    const len = slides.length;
    const intervalMs = 2000; 
    let timer = null;
    let isPaused = false;

    function showSlide(newIdx) {
        slides.forEach((s, i) => s.classList.toggle('active', i === newIdx));
        idx = newIdx;
    }

    function next() {
        showSlide((idx + 1) % len);
    }

    function prev() {
        showSlide((idx - 1 + len) % len);
    }

    function start() {
        stop();
        timer = setInterval(() => { if (!isPaused) next(); }, intervalMs);
    }

    function stop() {
        if (timer) { clearInterval(timer); timer = null; }
    }

    // controls
    const btnNext = container.querySelector('.slider-controls .next');
    const btnPrev = container.querySelector('.slider-controls .prev');

    if (btnNext) btnNext.addEventListener('click', () => { next(); start(); });
    if (btnPrev) btnPrev.addEventListener('click', () => { prev(); start(); });

    // pause on hover
    container.addEventListener('mouseenter', () => { isPaused = true; });
    container.addEventListener('mouseleave', () => { isPaused = false; });

    // keyboard support (left/right)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') { prev(); start(); }
        if (e.key === 'ArrowRight') { next(); start(); }
    });
    // navigation dots
    const dots = Array.from(container.parentElement.querySelectorAll('.slider-dots .dot'));
    function setActiveDot(index) {
        dots.forEach((d, i) => d.classList.toggle('active', i === index));
    }
    if (dots.length) {
        dots.forEach(d => d.addEventListener('click', (ev) => {
            const index = parseInt(d.getAttribute('data-index'));
            if (!Number.isNaN(index)) {
                showSlide(index);
                setActiveDot(index);
                start();
            }
        }));
    }

    // update dots on show
    const originalShowSlide = showSlide;
    showSlide = function(newIdx) {
        originalShowSlide(newIdx);
        if (dots.length) setActiveDot(newIdx);
    };

    // touch / swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    const threshold = 40; // px
    container.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; isPaused = true; });
    container.addEventListener('touchmove', (e) => { touchEndX = e.touches[0].clientX; });
    container.addEventListener('touchend', () => {
        const dx = touchEndX - touchStartX;
        if (Math.abs(dx) > threshold) {
            if (dx < 0) next(); else prev();
            start();
        }
        isPaused = false;
        touchStartX = touchEndX = 0;
    });

    start();
});
