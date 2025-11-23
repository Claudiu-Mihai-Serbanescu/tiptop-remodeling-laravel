<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- ===== SEO dinamic fără condiționale ===== --}}
    <title>@yield('title','TipTop — Home Remodeling')</title>
    <meta name="description" content="@yield('meta_description','Full-service home remodeling: kitchens, bathrooms, flooring, painting. Licensed & insured. Free estimates.')" />
    <link rel="canonical" href="@yield('canonical', request()->url())" />

    {{-- Open Graph / Twitter --}}
    <meta property="og:type" content="@yield('og_type','website')" />
    <meta property="og:title" content="@yield('og_title', trim(View::yieldContent('title','TipTop — Home Remodeling')))" />
    <meta property="og:description" content="@yield('og_description', trim(View::yieldContent('meta_description','Full-service home remodeling')))" />
    <meta property="og:url" content="@yield('og_url', request()->url())" />
    <meta property="og:image" content="@yield('og_image', asset('og-default.jpg'))" />
    <meta property="og:site_name" content="TipTop" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('twitter_title', trim(View::yieldContent('title','TipTop — Home Remodeling')))" />
    <meta name="twitter:description" content="@yield('twitter_description', trim(View::yieldContent('meta_description','Full-service home remodeling')))" />
    <meta name="twitter:image" content="@yield('twitter_image', asset('og-default.jpg'))" />

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <!-- TOPBAR -->

    <body>
        <!-- TOPBAR -->
        <div class="topbar" id="topbar">
            <div class="container tb">
                <div class="row mobile" aria-label="Quick contacts">
                    <a href="mailto:info@tiptop.com"><span class="icon">✉️</span>Email</a>
                    <a href="https://facebook.com" target="_blank" rel="noopener me"><span class="icon">ⓕ</span>Facebook</a>
                </div>
                <div class="row short"><span>🏡 Licensed & insured</span></div>
                <div class="row long">
                    <span>🏡 Full-service home remodeling in your area</span><span aria-hidden="true">•</span>
                    <span>Licensed & Insured</span><span aria-hidden="true">•</span>
                    <span>Free Estimates</span>
                </div>
                <div class="row">
                    <a href="tel:+12023862748" class="phone" aria-label="Call TipTop">📞 202 386-2748</a>
                    <a href="{{ route('contact') }}" class="cta">Get a Free Estimate</a>
                </div>
            </div>
        </div>

        <!-- HEADER -->
        <header class="header" id="siteHeader">
            <div class="container hwrap">
                <a class="logo" href="{{ route('home') }}" aria-label="TipTop Home">
                    <img src="/logo.png" alt="TipTop" loading="eager" decoding="async" />
                </a>

                <button class="burger" id="burger" aria-expanded="false" aria-controls="mainNav" aria-label="Open menu">
                    <span class="bars"></span>
                </button>

                <nav class="nav" id="mainNav" aria-label="Primary">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home')?'active':'' }}">Home</a>
                    <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*')?'active':'' }}">Services</a>
                    <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*')?'active':'' }}">Portfolio</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about')?'active':'' }}">About</a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact')?'active':'' }}">Contact</a>
                </nav>
            </div>
            <div class="backdrop" id="navBackdrop" aria-hidden="true"></div>
        </header>

        <main class="container">
            @yield('content')
        </main>
        <x-contact-cta />
        <x-contact />
        <!-- FOOTER (SEO) -->
        <footer class="footer" id="siteFooter">
            <div class="container footer-grid" role="contentinfo">
                <!-- Brand / NAP -->
                <section class="f-brand">
                    <a class="f-logo" href="{{ route('home') }}" aria-label="TipTop Home">
                        <img src="/logo.png" alt="TipTop logo" loading="lazy" decoding="async" />
                    </a>
                    <address class="f-nap">
                        <strong>TipTop</strong><br />
                        123 Main Street<br />
                        Washington, DC 20001<br />
                        <a href="tel:+12023862748">(+1) 202 386-2748</a><br />
                        <a href="mailto:info@tiptop.com">info@tiptop.com</a>
                    </address>
                    <p class="f-hours"><strong>Hours:</strong> Mon–Sat 08:00–18:00</p>
                    <div class="f-cta">
                        <a href="{{ route('contact') }}" class="btn btn-primary">Get a Free Estimate</a>
                    </div>
                </section>

                <!-- Site links -->
                <nav class="f-links" aria-label="Site links">
                    <h3 class="f-title">Company</h3>
                    <ul>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('projects.index') }}">Portfolio</a></li>
                        <li><a href="{{ route('services.index') }}">Services</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('home') }}#faq">FAQ</a></li>
                    </ul>
                </nav>

                <!-- Services (top categories) -->
                <nav class="f-services" aria-label="Popular services">
                    <h3 class="f-title">Popular Services</h3>
                    <ul>
                        <li><a href="{{ route('services.index') }}#kitchens">Kitchen Remodeling</a></li>
                        <li><a href="{{ route('services.index') }}#bathrooms">Bathroom Remodeling</a></li>
                        <li><a href="{{ route('services.index') }}#flooring">Flooring & Tiling</a></li>
                        <li><a href="{{ route('services.index') }}#painting">Interior & Exterior Painting</a></li>
                        <li><a href="{{ route('services.index') }}#roofing">Roofing & Gutters</a></li>
                    </ul>
                </nav>

                <!-- Trust / Social -->
                <section class="f-social">
                    <h3 class="f-title">Stay Connected</h3>
                    <ul class="f-social-list">
                        <li><a href="https://facebook.com" target="_blank" rel="noopener me" aria-label="Facebook">Facebook</a></li>
                        <li><a href="mailto:info@tiptop.com" aria-label="Email">Email</a></li>
                    </ul>
                    <p class="f-badge">🏡 Licensed & Insured • Free Estimates</p>
                </section>
            </div>

            <div class="footer-legal">
                <div class="container legal-wrap">
                    <p>© {{ now()->year }} TipTop. All rights reserved.</p>
                    <nav aria-label="Legal">
                        <a href="{{ route('home') }}#terms">Terms</a>
                        <a href="{{ route('home') }}#privacy">Privacy</a>
                        <a href="{{ route('home') }}#cookies">Cookies</a>
                    </nav>
                </div>
            </div>


        </footer>

        <script>
            // ===== calc înălțimi pt. offset sticky corect
            function setHeights() {
                const topbar = document.getElementById('topbar');
                const header = document.getElementById('siteHeader');
                const r = document.documentElement;
                const compact = r.classList.contains('compact');
                r.style.setProperty('--topbar-h', compact ? '0px' : ((topbar?.offsetHeight || 0) + 'px'));
                r.style.setProperty('--header-h', (header?.querySelector('.hwrap')?.offsetHeight || header?.offsetHeight || 56) + 'px');
            }
            addEventListener('load', setHeights);
            addEventListener('resize', setHeights);
            document.fonts?.addEventListener?.('loadingdone', setHeights);

            // ===== burger logic
            const html = document.documentElement,
                burger = document.getElementById('burger'),
                backdrop = document.getElementById('navBackdrop');

            const openNav = () => {
                html.classList.add('nav-open');
                burger.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            };
            const closeNav = () => {
                html.classList.remove('nav-open');
                burger.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            };

            burger?.addEventListener('click', () =>
                html.classList.contains('nav-open') ? closeNav() : openNav()
            );
            backdrop?.addEventListener('click', closeNav);
            document.getElementById('mainNav')?.addEventListener('click', (e) => {
                if (e.target.tagName === 'A' && matchMedia('(max-width:1024px)').matches) closeNav();
            });

            // ===== Scroll: topbar hide + header shrink
            const SHRINK_AT = 24; // px
            addEventListener('scroll', () => {
                const y = scrollY || pageYOffset;
                const doc = document.documentElement;
                if (y > SHRINK_AT) doc.classList.add('compact');
                else doc.classList.remove('compact');
                setHeights();
            }, {
                passive: true
            });
        </script>
    </body>

</html>