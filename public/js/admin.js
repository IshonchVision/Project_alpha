// ========================================
// MOBILE MENU FUNCTIONALITY
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    // Faqat mobil/tablet uchun menu toggle yaratish
    function initMobileMenu() {
        if (window.innerWidth <= 768) {
            // Agar tugma yo'q bo'lsa, yaratamiz
            if (!document.querySelector('.mobile-menu-toggle')) {
                // Mobile menu toggle button
                const toggleBtn = document.createElement('button');
                toggleBtn.className = 'mobile-menu-toggle';
                toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
                toggleBtn.setAttribute('aria-label', 'Toggle Menu');
                document.body.appendChild(toggleBtn);

                // Sidebar overlay
                const overlay = document.createElement('div');
                overlay.className = 'sidebar-overlay';
                document.body.appendChild(overlay);

                // Toggle sidebar ochish/yopish
                toggleBtn.addEventListener('click', function() {
                    const sidebar = document.querySelector('.sidebar');
                    const isActive = sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');

                    // Icon o'zgartirish
                    const icon = this.querySelector('i');
                    icon.className = isActive ? 'fas fa-times' : 'fas fa-bars';
                });

                // Overlay bosilganda yopish
                overlay.addEventListener('click', function() {
                    closeSidebar();
                });

                // Menu linkni bosganda sidebar yopish
                const menuLinks = document.querySelectorAll('.menu-link');
                menuLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 768) {
                            setTimeout(() => closeSidebar(), 200);
                        }
                    });
                });

                // Escape tugmasi bilan yopish
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeSidebar();
                    }
                });
            }
        }
    }

    // Sidebar yopish funksiyasi
    function closeSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        const toggleBtn = document.querySelector('.mobile-menu-toggle');

        if (sidebar && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            const icon = toggleBtn.querySelector('i');
            icon.className = 'fas fa-bars';
        }
    }

    // Sahifa yuklanganda ishga tushirish
    initMobileMenu();

    // Window resize bo'lganda tekshirish
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const toggleBtn = document.querySelector('.mobile-menu-toggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');

            if (window.innerWidth > 768) {
                // Desktop - sidebar har doim ko'rinadi
                if (toggleBtn) toggleBtn.style.display = 'none';
                if (sidebar) sidebar.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
            } else {
                // Mobile - toggle button ko'rsatish
                if (toggleBtn) {
                    toggleBtn.style.display = 'flex';
                } else {
                    initMobileMenu();
                }
            }
        }, 250);
    });
});

// ========================================
// TABLE SCROLL INDICATOR
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    const tables = document.querySelectorAll('.table-container');

    tables.forEach(container => {
        const table = container.querySelector('table');
        if (!table) return;

        // Agar jadval katta bo'lsa, scroll indikatorini ko'rsatish
        if (container.scrollWidth > container.clientWidth) {
            const indicator = document.createElement('div');
            indicator.className = 'table-scroll-indicator';
            indicator.innerHTML = '<i class="fas fa-arrow-right"></i> Scroll →';
            indicator.style.cssText = `
                position: absolute;
                top: 15px;
                right: 15px;
                background: linear-gradient(135deg, #3b82f6, #8b5cf6);
                color: white;
                padding: 8px 15px;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 700;
                z-index: 10;
                pointer-events: none;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
                animation: pulse 2s infinite;
            `;

            // Container pozitsiyasini relative qilish
            container.style.position = 'relative';
            container.appendChild(indicator);

            // Scroll bo'lganda indikatorni yashirish
            container.addEventListener('scroll', function() {
                if (this.scrollLeft > 50) {
                    indicator.style.opacity = '0';
                } else {
                    indicator.style.opacity = '1';
                }
            });
        }
    });
});

// ========================================
// SMOOTH SCROLL ANIMATION
// ========================================
const style = document.createElement('style');
style.textContent = `
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.8;
        }
    }
`;
document.head.appendChild(style);

// ========================================
// ACTIVE MENU LINK HIGHLIGHT
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const menuLinks = document.querySelectorAll('.menu-link');

    menuLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }

        link.addEventListener('click', function() {
            // Remove active from all
            menuLinks.forEach(l => l.classList.remove('active'));
            // Add to clicked
            this.classList.add('active');
        });
    });
});

// ========================================
// BACK TO TOP BUTTON (agar kerak bo'lsa)
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    const backToTopBtn = document.querySelector('.back-to-top');

    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.style.display = 'flex';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });

        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

// ========================================
// CONSOLE LOG - RESPONSIVE MODE
// ========================================
console.log('🔥 Admin Dashboard Responsive Mode Active!');
console.log('📱 Mobile: < 768px | 📊 Tablet: 768-1024px | 💻 Desktop: > 1024px');
