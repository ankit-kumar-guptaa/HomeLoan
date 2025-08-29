<nav id="navbar" class="navbar navbar-expand-lg fixed-top">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            color: #1E3A8A !important;
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            transition: color 0.3s ease;
            text-decoration: none;
        }
        
        .navbar-brand:hover {
            color: #3730A3 !important;
        }
        
        .navbar-brand span {
            font-size: 0.7rem;
            color: #F59E0B;
            font-weight: 600;
            margin-top: -2px;
        }
        
        .navbar-nav {
            align-items: center;
            gap: 1rem;
        }
        
        .nav-link {
            color: #111827 !important;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            padding: 0.5rem 0.8rem !important;
            transition: color 0.3s ease;
            font-size: 0.95rem;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #1E3A8A, #F59E0B);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: #1E3A8A !important;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }
        
        /* Custom Hamburger with Animation */
        .navbar-toggler {
            border: none;
            padding: 8px;
            transition: transform 0.3s ease;
            background: none;
            position: relative;
            z-index: 1002;
        }
        
        .navbar-toggler:hover {
            transform: scale(1.1);
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler-icon {
            display: none;
        }
        
        /* Custom hamburger lines */
        .hamburger-lines {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .hamburger-lines span {
            width: 28px;
            height: 3px;
            background: #111827;
            border-radius: 2px;
            transition: all 0.3s ease;
            display: block;
        }
        
        /* Hamburger animation fix - using custom class instead of aria-expanded */
        .navbar-toggler.menu-open .hamburger-lines span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }
        
        .navbar-toggler.menu-open .hamburger-lines span:nth-child(2) {
            opacity: 0;
        }
        
        .navbar-toggler.menu-open .hamburger-lines span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
        
        /* Mobile overlay */
        .nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 998;
        }
        
        .nav-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        /* Bootstrap mobile menu customization */
        @media (max-width: 991.98px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .navbar-brand span {
                font-size: 0.65rem;
            }
            
            .navbar-collapse {
                position: fixed;
                top: 0;
                right: 0;
                height: 100vh;
                width: 280px;
                background: #ffffff;
                padding: 6rem 2rem 2rem;
                transform: translateX(100%);
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: -5px 0 25px rgba(0,0,0,0.1);
                z-index: 999;
                overflow-y: auto;
                border: none;
            }
            
            .navbar-collapse.show {
                transform: translateX(0);
            }
            
            .navbar-nav {
                gap: 0;
                width: 100%;
            }
            
            .nav-item {
                width: 100%;
                border-bottom: 1px solid #e5e7eb;
            }
            
            .nav-item:last-child {
                border-bottom: none;
            }
            
            .nav-link {
                font-size: 1.1rem;
                padding: 1rem 0 !important;
                width: 100%;
                display: block;
                transition: all 0.3s ease;
            }
            
            .nav-link:hover {
                color: #1E3A8A !important;
                padding-left: 10px !important;
            }
            
            .nav-link::after {
                bottom: 0;
                height: 1px;
            }
        }
        
        /* Extra Small Devices */
        @media (max-width: 575.98px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            
            .navbar-brand span {
                font-size: 0.6rem;
            }
            
            .navbar-collapse {
                width: 250px;
                padding: 5rem 1.5rem 2rem;
            }
            
            .nav-link {
                font-size: 1rem;
            }
            
            .hamburger-lines span {
                width: 24px;
                height: 2.5px;
            }
        }
        
        /* Desktop styles */
        @media (min-width: 992px) {
            .nav-overlay {
                display: none !important;
            }
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Body padding for fixed navbar */
        body {
            padding-top: 80px;
        }
        
        @media (max-width: 991.98px) {
            body {
                padding-top: 70px;
            }
        }
    </style>

    <div class="container">
        <a class="navbar-brand" href="#home" onclick="scrollToTop()">
            Elite Corporate Solutions
            <span>Since 2010</span>
        </a>

        <button class="navbar-toggler" type="button" id="navbarToggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger-lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#calculator">Calculator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features">Why Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Mobile overlay -->
    <div id="nav-overlay" class="nav-overlay"></div>

    <script>
        // Get elements
        const navbarToggler = document.getElementById('navbarToggler');
        const navMenu = document.getElementById('navbarNav');
        const navOverlay = document.getElementById('nav-overlay');
        const navLinks = document.querySelectorAll('.nav-link');
        const navbar = document.getElementById('navbar');

        // State tracking
        let isMenuOpen = false;
        let bsCollapse = null;

        // Initialize Bootstrap collapse
        function initBootstrapCollapse() {
            if (!bsCollapse) {
                bsCollapse = new bootstrap.Collapse(navMenu, { toggle: false });
            }
        }

        // Open menu
        function openMenu() {
            if (isMenuOpen) return;
            
            initBootstrapCollapse();
            isMenuOpen = true;
            
            // Visual states
            navbarToggler.classList.add('menu-open');
            navbarToggler.setAttribute('aria-expanded', 'true');
            navOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Open with Bootstrap
            bsCollapse.show();
        }

        // Close menu - COMPLETE RESET
        function closeMenu() {
            if (!isMenuOpen) return;
            
            isMenuOpen = false;
            
            // Reset all visual states
            navbarToggler.classList.remove('menu-open');
            navbarToggler.setAttribute('aria-expanded', 'false');
            navOverlay.classList.remove('active');
            document.body.style.overflow = '';
            
            // Force remove any hover states on toggler
            navbarToggler.blur();
            navbarToggler.style.transform = '';
            
            // Close with Bootstrap
            if (bsCollapse) {
                bsCollapse.hide();
            }
        }

        // Toggle menu
        function toggleMenu() {
            if (isMenuOpen) {
                closeMenu();
            } else {
                openMenu();
            }
        }

        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Event listeners
        navbarToggler.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });

        // Bootstrap events
        navMenu.addEventListener('show.bs.collapse', function() {
            if (!isMenuOpen) {
                isMenuOpen = true;
                navbarToggler.classList.add('menu-open');
                navbarToggler.setAttribute('aria-expanded', 'true');
                navOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });

        navMenu.addEventListener('hide.bs.collapse', function() {
            isMenuOpen = false;
            navbarToggler.classList.remove('menu-open');
            navbarToggler.setAttribute('aria-expanded', 'false');
            navOverlay.classList.remove('active');
            document.body.style.overflow = '';
            
            // Force reset hamburger button state
            navbarToggler.blur();
            navbarToggler.style.transform = '';
        });

        navMenu.addEventListener('hidden.bs.collapse', function() {
            // Additional safety reset
            isMenuOpen = false;
            navbarToggler.classList.remove('menu-open');
            navbarToggler.setAttribute('aria-expanded', 'false');
            navOverlay.classList.remove('active');
            document.body.style.overflow = '';
            
            // Force reset all button styles
            navbarToggler.blur();
            navbarToggler.style.transform = '';
            navbarToggler.classList.remove('hover');
        });

        // Click outside to close
        document.addEventListener('click', function(event) {
            if (isMenuOpen && !navbar.contains(event.target)) {
                closeMenu();
            }
        });

        // Overlay click
        navOverlay.addEventListener('click', closeMenu);

        // Nav links click
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 991 && isMenuOpen) {
                    setTimeout(closeMenu, 100);
                }
            });
        });

        // Window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 991 && isMenuOpen) {
                closeMenu();
            }
        });

        // Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isMenuOpen) {
                closeMenu();
            }
        });

        // Scroll effects
        let ticking = false;
        function updateNavbar() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            ticking = false;
        }

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        }, { passive: true });

        // Active link tracking
        function setActiveLink() {
            const sections = document.querySelectorAll('section[id]');
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        }

        let scrollTicking = false;
        window.addEventListener('scroll', () => {
            if (!scrollTicking) {
                requestAnimationFrame(setActiveLink);
                scrollTicking = true;
                setTimeout(() => {
                    scrollTicking = false;
                }, 100);
            }
        }, { passive: true });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            setActiveLink();
            document.body.style.overflow = '';
            
            // Force reset hamburger state on load
            navbarToggler.classList.remove('menu-open');
            navbarToggler.setAttribute('aria-expanded', 'false');
            isMenuOpen = false;
        });

        // Additional safety - force reset every few seconds
        setInterval(() => {
            if (!isMenuOpen && navbarToggler.classList.contains('menu-open')) {
                navbarToggler.classList.remove('menu-open');
                navbarToggler.setAttribute('aria-expanded', 'false');
                navbarToggler.blur();
                navbarToggler.style.transform = '';
                document.body.style.overflow = '';
            }
        }, 3000);
    </script>
</nav>
