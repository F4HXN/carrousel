/**
 * Carrousel Sites Pro - JavaScript
 * Version: 1.1.0
 * Author: Jean-Paul Mansouri (F4HXN)
 */

(function() {
    'use strict';
    
    // Attendre que le DOM soit chargé
    document.addEventListener('DOMContentLoaded', function() {
        initCarousel();
    });
    
    function initCarousel() {
        const wrapper = document.querySelector('.carousel-sites-wrapper');
        if (!wrapper) return;
        
        const track = wrapper.querySelector('.carousel-track');
        const slides = wrapper.querySelectorAll('.carousel-slide');
        const indicatorsContainer = wrapper.querySelector('.carousel-indicators');
        const prevBtn = wrapper.querySelector('.carousel-btn.prev');
        const nextBtn = wrapper.querySelector('.carousel-btn.next');
        
        if (!track || !slides.length) return;
        
        let currentSlide = 0;
        const totalSlides = slides.length;
        let autoPlayInterval;
        
        // Récupérer les paramètres
        const autoplay = wrapper.dataset.autoplay === 'true';
        const delay = parseInt(wrapper.dataset.delay) || 5000;
        
        // Créer les indicateurs
        slides.forEach((slide, index) => {
            const indicator = document.createElement('button');
            indicator.className = 'indicator';
            indicator.setAttribute('aria-label', `Aller à la diapositive ${index + 1}`);
            if (index === 0) indicator.classList.add('active');
            indicator.addEventListener('click', () => goToSlide(index));
            indicatorsContainer.appendChild(indicator);
        });
        
        const indicators = wrapper.querySelectorAll('.indicator');
        
        // Mettre à jour le carrousel
        function updateCarousel() {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
                indicator.setAttribute('aria-current', index === currentSlide ? 'true' : 'false');
            });
            
            // Mettre à jour l'accessibilité
            slides.forEach((slide, index) => {
                slide.setAttribute('aria-hidden', index !== currentSlide ? 'true' : 'false');
            });
        }
        
        // Passer à la diapositive suivante/précédente
        function moveSlide(direction) {
            currentSlide += direction;
            
            if (currentSlide < 0) {
                currentSlide = totalSlides - 1;
            } else if (currentSlide >= totalSlides) {
                currentSlide = 0;
            }
            
            updateCarousel();
        }
        
        // Aller à une diapositive spécifique
        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
        }
        
        // Ouvrir le site
        function openSite(url) {
            window.open(url, '_blank', 'noopener,noreferrer');
        }
        
        // Événements des boutons
        if (prevBtn) {
            prevBtn.addEventListener('click', () => moveSlide(-1));
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => moveSlide(1));
        }
        
        // Événement de clic sur les slides
        slides.forEach(slide => {
            slide.addEventListener('click', function() {
                const url = this.dataset.url;
                if (url) openSite(url);
            });
            
            // Accessibilité clavier
            slide.setAttribute('tabindex', '0');
            slide.setAttribute('role', 'button');
            slide.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const url = this.dataset.url;
                    if (url) openSite(url);
                }
            });
        });
        
        // Événement de clic sur l'instruction "Cliquez pour visiter"
        const clickInstruction = wrapper.querySelector('.click-instruction');
        if (clickInstruction) {
            clickInstruction.addEventListener('click', function(e) {
                e.stopPropagation();
                const currentSlideElement = slides[currentSlide];
                if (currentSlideElement) {
                    const url = currentSlideElement.dataset.url;
                    if (url) openSite(url);
                }
            });
        }
        
        // Auto-play
        function startAutoPlay() {
            if (!autoplay) return;
            
            autoPlayInterval = setInterval(() => {
                moveSlide(1);
            }, delay);
        }
        
        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }
        
        // Pause au survol
        wrapper.addEventListener('mouseenter', stopAutoPlay);
        wrapper.addEventListener('mouseleave', startAutoPlay);
        
        // Navigation clavier
        document.addEventListener('keydown', (e) => {
            // Vérifier si le focus est dans le carrousel
            if (!wrapper.contains(document.activeElement)) return;
            
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                moveSlide(-1);
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                moveSlide(1);
            }
        });
        
        // Support tactile pour mobile
        let touchStartX = 0;
        let touchEndX = 0;
        let touchStartY = 0;
        let touchEndY = 0;
        
        track.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            touchStartY = e.changedTouches[0].screenY;
        }, { passive: true });
        
        track.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            touchEndY = e.changedTouches[0].screenY;
            handleSwipe();
        }, { passive: true });
        
        function handleSwipe() {
            const diffX = touchEndX - touchStartX;
            const diffY = touchEndY - touchStartY;
            
            // S'assurer que c'est un swipe horizontal et non vertical
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                if (diffX < 0) {
                    moveSlide(1); // Swipe gauche
                } else {
                    moveSlide(-1); // Swipe droite
                }
            }
        }
        
        // Démarrer l'auto-play
        startAutoPlay();
        
        // Initialiser
        updateCarousel();
    }
})();
