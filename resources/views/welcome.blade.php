<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PearlHub — Sri Lanka's premium marketplace for property, stays, vehicles, events, experiences and SME services.">
    <meta name="theme-color" content="#00d4ff">

    <title>PearlHub — Sri Lanka's Premium Marketplace</title>

    <!-- Preconnect for faster font load (two tags: one for DNS, one for CORS) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=manrope:400,600,700,800&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif

    <style>
        /* ── Light-mode overrides (default) ──────────────────── */
        :root {
            --dark-bg:           #f0f9ff;
            --dark-bg-secondary: #e0f2fe;
            --dark-secondary:    #bae6fd;
            --dark-card:         #ffffff;
            --dark-hover:        #f0f9ff;
            --text-white:        #0c4a6e;
            --text-primary:      #075985;
            --text-secondary:    #0369a1;
            --text-muted:        #0284c7;
            --accent-teal:       #0284c7;
            --accent-teal-rgb:   2, 132, 199;
            --accent-gold:       #d97706;
            --accent-gold-rgb:   217, 119, 6;
            --border-color:      #7dd3fc;
            --border-light:      #38bdf8;
            --shadow-sm:         0 4px 12px rgba(2,132,199,0.15);
            --shadow-md:         0 12px 32px rgba(2,132,199,0.2);
            --shadow-glow-teal:  0 0 30px rgba(2,132,199,0.25);
        }

        /* ── Dark-mode token overrides ───────────────────────── */
        html.dark {
            --dark-bg:           #0a0e27;
            --dark-bg-secondary: #0d111e;
            --dark-secondary:    #0f1422;
            --dark-card:         #1a232f;
            --dark-hover:        #20293d;
            --text-white:        #ffffff;
            --text-primary:      #e6edf3;
            --text-secondary:    #8b949e;
            --text-muted:        #6e7681;
            --accent-teal:       #00d4ff;
            --accent-teal-rgb:   0, 212, 255;
            --accent-gold:       #d4af37;
            --accent-gold-rgb:   212, 175, 55;
            --border-color:      #2a3f5f;
            --border-light:      #3d5580;
            --shadow-sm:         0 4px 12px rgba(0,0,0,0.3);
            --shadow-md:         0 12px 32px rgba(0,0,0,0.4);
            --shadow-glow-teal:  0 0 30px rgba(0,212,255,0.3);
        }

        /* ── Body base ───────────────────────────────────────── */
        body {
            background: var(--dark-bg);
            color: var(--text-primary);
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* ── Skip link for keyboard nav ──────────────────────── */
        .skip-link {
            position: absolute;
            top: -999px;
            left: 0;
            padding: 0.5rem 1rem;
            background: var(--accent-teal);
            color: #fff;
            font-weight: 700;
            z-index: 9999;
            border-radius: 0 0 8px 0;
            transition: top 0.2s;
        }
        .skip-link:focus {
            top: 0;
        }

        /* ── Dark-mode toggle ────────────────────────────────── */
        #dark-toggle {
            background: var(--dark-card);
            border: 1.5px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 9999px;
            padding: 0.35rem 0.8rem;
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        #dark-toggle:hover {
            border-color: var(--accent-teal);
            box-shadow: var(--shadow-glow-teal);
        }
        #dark-toggle:focus-visible {
            outline: 3px solid var(--accent-teal);
            outline-offset: 2px;
        }

        /* ── Mobile nav toggle ───────────────────────────────── */
        #mobile-menu-btn {
            display: none;
            background: transparent;
            border: none;
            color: var(--text-primary);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.25rem;
        }
        @media (max-width: 767px) {
            #mobile-menu-btn { display: flex; align-items: center; }
            .nav-links { display: none !important; }
            .nav-links.open { display: flex !important; flex-direction: column; position: absolute; top: 64px; left: 0; right: 0; background: var(--dark-card); padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); z-index: 40; gap: 1rem; }
        }

        /* ── Vertical cards ──────────────────────────────────── */
        .vertical-card {
            background: var(--dark-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        .vertical-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-teal), var(--accent-gold));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease-out;
        }
        .vertical-card:hover::before { transform: scaleX(1); }
        .vertical-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
            border-color: var(--accent-teal);
        }
        .vertical-card:focus-within {
            outline: 3px solid var(--accent-teal);
            outline-offset: 2px;
        }
        .v-icon { font-size: 2.5rem; }
        .v-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-white);
        }
        .v-desc { font-size: 0.9rem; color: var(--text-secondary); line-height: 1.6; }

        /* ── Steps ───────────────────────────────────────────── */
        .step-num {
            width: 2.5rem; height: 2.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-teal), var(--accent-gold));
            color: #fff;
            font-weight: 800;
            font-size: 1rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* ── CTA Banner ──────────────────────────────────────── */
        .cta-banner {
            background: linear-gradient(135deg, rgba(var(--accent-teal-rgb),0.12), rgba(var(--accent-gold-rgb),0.12));
            border: 1px solid rgba(var(--accent-teal-rgb),0.35);
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
        }

        /* ── Section title accent line ───────────────────────── */
        .section-title-line {
            width: 4rem; height: 4px;
            background: linear-gradient(90deg, var(--accent-teal), var(--accent-gold));
            border-radius: 2px;
            margin: 0.75rem auto 0;
        }

        /* ── Focus-visible global ────────────────────────────── */
        :focus-visible {
            outline: 3px solid var(--accent-teal);
            outline-offset: 2px;
        }

        /* ── Reduced motion ──────────────────────────────────── */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- Skip nav for keyboard/screen-reader users -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <div class="site-shell">

        <!-- ════════════════════════ HEADER ════════════════════════ -->
        <header role="banner">
            <div class="header-container" style="position:relative;">
                <!-- Brand -->
                <a href="/" class="brand" aria-label="PearlHub home">
                    💎 PearlHub
                </a>

                <!-- Desktop navigation -->
                <nav aria-label="Primary navigation">
                    <ul class="nav-links" id="nav-links" role="list">
                        <li><a href="#verticals">Marketplace</a></li>
                        <li><a href="#how-it-works">How it works</a></li>
                        <li><a href="#stats">About</a></li>
                    </ul>
                </nav>

                <!-- Actions -->
                <div class="auth-buttons">
                    <!-- Dark mode toggle -->
                    <button id="dark-toggle" aria-label="Toggle dark mode" title="Toggle dark / light mode">
                        <span id="dark-icon" aria-hidden="true">🌙</span>
                        <span class="sr-only">Toggle theme</span>
                    </button>

                    @auth
                        <a href="{{ url('/admin') }}" class="btn-signin" style="text-decoration:none;">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ url('/admin') }}" class="btn-signin" style="text-decoration:none;">
                            Admin Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile burger -->
                <button id="mobile-menu-btn" aria-controls="nav-links" aria-expanded="false" aria-label="Toggle mobile navigation">
                    <span aria-hidden="true">☰</span>
                </button>
            </div>
        </header>

        <!-- ════════════════════════ MAIN ════════════════════════ -->
        <main id="main-content">

            <!-- ──────────────── HERO ──────────────────────────── -->
            <section class="hero" aria-labelledby="hero-heading">
                <div class="hero-content">
                    <p class="hero-badge" role="note">🇱🇰 Built for Sri Lanka</p>

                    <h1 id="hero-heading">
                        Sri Lanka's Premium<br>Digital Marketplace
                    </h1>

                    <p style="margin-top:1.5rem;margin-bottom:0;">
                        Property · Stays · Vehicles · Events · SME Services · Taxi — all in one place.
                        Buy, rent, book and connect with verified providers across the island.
                    </p>

                    <div class="hero-actions" style="margin-top:2rem;">
                        <a href="{{ url('/admin') }}" class="btn-primary" role="button"
                           style="text-decoration:none;display:inline-block;text-align:center;">
                            🚀 Go to Admin Panel
                        </a>
                        <a href="#verticals" class="btn-secondary" role="button"
                           style="text-decoration:none;display:inline-block;text-align:center;">
                            Explore Verticals ↓
                        </a>
                    </div>
                </div>
            </section>

            <!-- ──────────────── STATS ──────────────────────────── -->
            <section id="stats" class="section" aria-labelledby="stats-heading"
                     style="padding-top:0;padding-bottom:2rem;">
                <div class="container">
                    <h2 id="stats-heading" class="sr-only">Platform statistics</h2>
                    <div class="stats-bar" role="list">
                        <div class="stat-item" role="listitem">
                            <div class="stat-icon" aria-hidden="true">🏠</div>
                            <div class="stat-value">6</div>
                            <div class="stat-label">Verticals</div>
                        </div>
                        <div class="stat-item" role="listitem">
                            <div class="stat-icon" aria-hidden="true">✅</div>
                            <div class="stat-value">100%</div>
                            <div class="stat-label">Verified Listings</div>
                        </div>
                        <div class="stat-item" role="listitem">
                            <div class="stat-icon" aria-hidden="true">💳</div>
                            <div class="stat-value">3</div>
                            <div class="stat-label">Payment Gateways</div>
                        </div>
                        <div class="stat-item" role="listitem">
                            <div class="stat-icon" aria-hidden="true">🛡️</div>
                            <div class="stat-value">24/7</div>
                            <div class="stat-label">Secure Escrow</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ──────────────── VERTICALS ─────────────────────── -->
            <section id="verticals" class="section" aria-labelledby="verticals-heading">
                <div class="container">
                    <div class="section-title">
                        <h2 id="verticals-heading">Explore Every Vertical</h2>
                        <p class="section-subtitle">
                            One platform — six specialised marketplaces tailored for Sri Lanka.
                        </p>
                        <div class="section-title-line" aria-hidden="true"></div>
                    </div>

                    <div class="grid" role="list" aria-label="Service verticals">
                        @php
                        $verticals = [
                            ['icon'=>'🏠','title'=>'Property','desc'=>'Buy or sell residential and commercial real estate with escrow protection and verified ownership documents.'],
                            ['icon'=>'🛏️','title'=>'Stays','desc'=>'Book holiday bungalows, villas and guesthouses island-wide. Instant availability and secure payments.'],
                            ['icon'=>'🚗','title'=>'Vehicles','desc'=>'Rent or purchase cars, bikes and tuk-tuks. Full inspection reports and digital ownership transfer.'],
                            ['icon'=>'🎉','title'=>'Events','desc'=>'Discover and list concerts, weddings, workshops and cultural events. Built-in ticketing and RSVPs.'],
                            ['icon'=>'🧑‍💼','title'=>'SME Services','desc'=>'Find plumbers, electricians, tutors and more. Browse reviews and book verified local professionals.'],
                            ['icon'=>'🚕','title'=>'Taxi','desc'=>'Real-time ride booking with live driver tracking, fare estimator and cashless payment.'],
                        ];
                        @endphp

                        @foreach($verticals as $v)
                        <article class="vertical-card grid-item" role="listitem">
                            <div class="v-icon" aria-hidden="true">{{ $v['icon'] }}</div>
                            <h3 class="v-title">{{ $v['title'] }}</h3>
                            <p class="v-desc">{{ $v['desc'] }}</p>
                        </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- ──────────────── HOW IT WORKS ──────────────────── -->
            <section id="how-it-works" class="section"
                     aria-labelledby="hiw-heading"
                     style="background: linear-gradient(135deg, rgba(var(--accent-teal-rgb),0.05), rgba(var(--accent-gold-rgb),0.04)); border-top: 1px solid rgba(var(--border-color),0.3); border-bottom: 1px solid rgba(var(--border-color),0.3);">
                <div class="container">
                    <div class="section-title">
                        <h2 id="hiw-heading">How PearlHub Works</h2>
                        <p class="section-subtitle">Three simple steps to buy, book or list anything.</p>
                        <div class="section-title-line" aria-hidden="true"></div>
                    </div>

                    <ol style="list-style:none;padding:0;margin:0;display:grid;gap:2rem;"
                        aria-label="Steps to use PearlHub">
                        @foreach([
                            ['Register','Create a free account and choose your role — customer, provider or driver.'],
                            ['Discover','Browse verified listings across all six verticals with real-time availability.'],
                            ['Transact Safely','Book, pay and track your transaction through our built-in escrow and wallet system.'],
                        ] as $i => $step)
                        <li style="display:flex;align-items:flex-start;gap:1.25rem;">
                            <div class="step-num" aria-hidden="true">{{ $i + 1 }}</div>
                            <div>
                                <h3 style="font-size:1.1rem;font-weight:700;color:var(--text-white);margin-bottom:0.25rem;">
                                    <span class="sr-only">Step {{ $i + 1 }}: </span>{{ $step[0] }}
                                </h3>
                                <p>{{ $step[1] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </section>

            <!-- ──────────────── CTA ────────────────────────────── -->
            <section class="section" aria-labelledby="cta-heading">
                <div class="container">
                    <div class="cta-banner">
                        <h2 id="cta-heading" style="color:var(--text-white);margin-bottom:1rem;">
                            Ready to manage the platform?
                        </h2>
                        <p style="font-size:1.05rem;color:var(--text-secondary);margin-bottom:2rem;">
                            Sign in to the admin dashboard to manage users, listings, transactions and more.
                        </p>
                        <a href="{{ url('/admin') }}" class="btn-primary"
                           style="text-decoration:none;display:inline-block;font-size:1.05rem;">
                            Go to Admin Dashboard →
                        </a>
                    </div>
                </div>
            </section>

        </main>

        <!-- ════════════════════════ FOOTER ════════════════════════ -->
        <footer role="contentinfo">
            <div class="container" style="text-align:center;">
                <p style="font-size:1.1rem;font-weight:700;color:var(--text-white);margin-bottom:0.5rem;">
                    💎 PearlHub
                </p>
                <p>Sri Lanka's Premium Digital Marketplace</p>
                <nav aria-label="Footer navigation" style="margin-top:1rem;">
                    <ul role="list" style="list-style:none;padding:0;margin:0;display:flex;flex-wrap:wrap;justify-content:center;gap:1.5rem;">
                        <li><a href="{{ url('/admin') }}" style="color:var(--accent-teal);">Admin</a></li>
                        <li><a href="{{ url('/api/v1/health') }}" style="color:var(--accent-teal);">API Health</a></li>
                    </ul>
                </nav>
                <p style="margin-top:1.5rem;font-size:0.8rem;color:var(--text-muted);">
                    &copy; {{ date('Y') }} PearlHub. Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                </p>
            </div>
        </footer>

    </div><!-- .site-shell -->

    <script>
    (function () {
        'use strict';

        // ── Dark-mode persistence ────────────────────────────────
        var html = document.documentElement;
        var btn  = document.getElementById('dark-toggle');
        var icon = document.getElementById('dark-icon');

        function applyTheme(dark) {
            if (dark) {
                html.classList.add('dark');
                if (icon) icon.textContent = '☀️';
            } else {
                html.classList.remove('dark');
                if (icon) icon.textContent = '🌙';
            }
        }

        // Restore saved preference or honour OS preference
        var saved = localStorage.getItem('pearlhub-theme');
        var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        applyTheme(saved === 'dark' || (saved === null && prefersDark));

        if (btn) {
            btn.addEventListener('click', function () {
                var isDark = html.classList.contains('dark');
                applyTheme(!isDark);
                localStorage.setItem('pearlhub-theme', !isDark ? 'dark' : 'light');
            });
        }

        // ── Mobile navigation toggle ─────────────────────────────
        var mobileBtn = document.getElementById('mobile-menu-btn');
        var navLinks  = document.getElementById('nav-links');
        if (mobileBtn && navLinks) {
            mobileBtn.addEventListener('click', function () {
                var expanded = mobileBtn.getAttribute('aria-expanded') === 'true';
                mobileBtn.setAttribute('aria-expanded', String(!expanded));
                navLinks.classList.toggle('open', !expanded);
            });
        }
    }());
    </script>
</body>
</html>
