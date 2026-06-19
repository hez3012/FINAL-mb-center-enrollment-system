<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H.O.P.E. Enrollment System — M.B. Therapy Center</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/css/tabler.min.css">
    <style>
        :root {
            --green: #1B4332;
            --gold:  #EAB308;
            --cream: #F5F1E8;
        }
        body { background: var(--cream); font-family: 'Inter', sans-serif; color: #374151; }
        .hope-nav {
            background: var(--green);
            padding: .85rem 1.5rem;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,.18);
            display: flex; align-items: center; justify-content: space-between;
        }
        .hope-brand { display: flex; align-items: center; gap: .75rem; text-decoration: none; }
        .hope-brand img { height: 38px; object-fit: contain; }
        .hope-brand span { font-family: 'Playfair Display', serif; color: #fff; font-size: 1.05rem; font-weight: 700; }
        .hope-nav-links { display: flex; gap: .6rem; }
        .hope-nav-links a {
            padding: .45rem 1.1rem; border-radius: 7px; font-size: .85rem;
            font-weight: 600; text-decoration: none; transition: .2s;
        }
        .hope-nav-links .btn-login {
            color: #fff; border: 1.5px solid rgba(255,255,255,.55);
            background: transparent;
        }
        .hope-nav-links .btn-login:hover { border-color: #fff; background: rgba(255,255,255,.1); }
        .hope-nav-links .btn-register {
            background: var(--gold); color: var(--green);
        }
        .hope-nav-links .btn-register:hover { background: #fbbf24; }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--green) 0%, #2D6A4F 100%);
            color: #fff;
            padding: 90px 20px 80px;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute;
            top: -80px; right: -80px;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: rgba(234,179,8,.07);
        }
        .hero::after {
            content: ''; position: absolute;
            bottom: -60px; left: -60px;
            width: 240px; height: 240px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
        }
        .hero-logos { display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 2rem; }
        .hero-logos img.hope { height: 80px; }
        .hero-logos img.mb { height: 60px; border-radius: 8px; }
        .hero h1 { font-family: 'Playfair Display', serif; font-size: 2.8rem; font-weight: 900; margin-bottom: .75rem; color: #fff; }
        .hero h1 span { color: var(--gold); }
        .hero p.tagline { font-style: italic; font-size: 1.15rem; color: rgba(255,255,255,.75); margin-bottom: .5rem; }
        .hero p.subtitle { font-size: 1rem; color: rgba(255,255,255,.6); margin-bottom: 2.5rem; max-width: 540px; margin-left: auto; margin-right: auto; }
        .hero-btns { display: flex; gap: .9rem; justify-content: center; flex-wrap: wrap; }
        .hero-btns a {
            padding: .75rem 2rem; border-radius: 9px; font-weight: 700;
            font-size: .95rem; text-decoration: none; transition: .25s;
        }
        .hero-btns .btn-primary-hero {
            background: var(--gold); color: var(--green);
            box-shadow: 0 6px 20px rgba(234,179,8,.35);
        }
        .hero-btns .btn-primary-hero:hover { background: #fbbf24; transform: translateY(-3px); }
        .hero-btns .btn-secondary-hero {
            background: rgba(255,255,255,.1); color: #fff;
            border: 1.5px solid rgba(255,255,255,.45);
        }
        .hero-btns .btn-secondary-hero:hover { background: rgba(255,255,255,.18); transform: translateY(-3px); }

        /* Services */
        .services { padding: 80px 20px; background: #fff; }
        .services h2 { font-family: 'Playfair Display', serif; text-align: center; color: var(--green); font-size: 2rem; margin-bottom: .5rem; }
        .services p.lead { text-align: center; color: #6b7280; margin-bottom: 3rem; font-size: .95rem; }
        .service-card {
            border-radius: 14px;
            border: 1px solid #e8e3d8;
            padding: 2rem 1.5rem;
            background: var(--cream);
            height: 100%;
            transition: .25s;
            text-align: center;
        }
        .service-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(27,67,50,.1); }
        .service-icon {
            width: 60px; height: 60px; border-radius: 14px;
            background: var(--gold); display: flex; align-items: center;
            justify-content: center; margin: 0 auto 1.2rem;
        }
        .service-icon svg { width: 28px; height: 28px; stroke: var(--green); fill: none; }
        .service-card h5 { font-weight: 700; color: var(--green); margin-bottom: .5rem; }
        .service-card p { font-size: .875rem; color: #6b7280; margin: 0; line-height: 1.7; }

        /* How it works */
        .how { background: var(--cream); padding: 80px 20px; }
        .how h2 { font-family: 'Playfair Display', serif; color: var(--green); font-size: 2rem; text-align: center; margin-bottom: .5rem; }
        .how p.lead { text-align: center; color: #6b7280; margin-bottom: 3rem; font-size: .95rem; }
        .step { display: flex; gap: 1.2rem; margin-bottom: 2rem; }
        .step-num {
            width: 48px; height: 48px; border-radius: 50%; background: var(--green); color: #fff;
            font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 900;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .step-body h6 { font-weight: 700; color: var(--green); margin-bottom: .25rem; }
        .step-body p { font-size: .875rem; color: #6b7280; margin: 0; }

        /* Footer */
        footer { background: var(--green); color: rgba(255,255,255,.75); padding: 2.5rem 1.5rem; text-align: center; }
        footer strong { color: var(--gold); }
        footer a { color: var(--gold); text-decoration: none; }
        footer small { display: block; margin-top: .75rem; opacity: .55; }
    </style>
</head>
<body>

{{-- Nav --}}
<nav class="hope-nav">
    <a class="hope-brand" href="#">
        <img src="{{ asset('HOPE-LOGO.png') }}" alt="HOPE logo">
    </a>
    <div class="hope-nav-links">
        @if(Route::has('login'))
            @auth
                <a class="btn-login" href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a class="btn-login" href="{{ route('login') }}">Log In</a>
                @if(Route::has('register'))
                    <a class="btn-register" href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

{{-- Hero --}}
<section class="hero">
    <div class="hero-logos">
        <img class="hope" src="{{ asset('HOPE-LOGO.png') }}" alt="H.O.P.E. System logo">
        <img class="mb" src="{{ asset('MB-LOGO.png') }}" alt="M.B. Therapy Center logo">
    </div>
    <h1>Holistic Online Profile<br>and <span>Enrollment</span> System</h1>
    <p class="tagline">❝ From Disabilities to Possibilities. ❤ ❞</p>
    <p class="subtitle">The official enrollment management platform of <strong>M.B. Therapy Center</strong> — built to simplify student enrollment and guardian communications.</p>
    <div class="hero-btns">
        <a href="{{ route('login') }}" class="btn-primary-hero">Log In</a>
        @if(Route::has('register'))
        <a href="{{ route('register') }}" class="btn-secondary-hero">Register as Guardian</a>
        @endif
    </div>
</section>

{{-- Services --}}
<section class="services">
    <div class="container">
        <h2>Our Services</h2>
        <p class="lead">M.B. Therapy Center offers specialized therapeutic services for children with special needs.</p>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </div>
                    <h5>Special Education</h5>
                    <p>Tailored learning programs for children with learning differences and developmental needs.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <h5>Speech Therapy</h5>
                    <p>Communication and language development therapy for children with speech difficulties.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    </div>
                    <h5>Occupational Therapy</h5>
                    <p>Building daily life skills and fine motor development for greater independence.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                    </div>
                    <h5>Physical Therapy</h5>
                    <p>Motor skills development and physical rehabilitation through structured therapy sessions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- How it works --}}
<section class="how">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2>How It Works</h2>
                <p class="lead" style="text-align:left;">Three simple steps to get your child enrolled at M.B. Therapy Center.</p>
                <div class="step">
                    <div class="step-num">1</div>
                    <div class="step-body">
                        <h6>Create a Guardian Account</h6>
                        <p>Register using the button above to set up your free guardian account with your contact information.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <div class="step-body">
                        <h6>Submit an Enrollment Application</h6>
                        <p>Fill in your child's details, choose the appropriate service, and upload the required documents online.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <div class="step-body">
                        <h6>Track Your Application</h6>
                        <p>Monitor enrollment status in real time through your Guardian Portal dashboard.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('MB-LOGO-FULL.png') }}" alt="M.B. Therapy Center" style="max-width: 300px; width: 100%;">
            </div>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer>
    <div class="container">
        <p><strong>H.O.P.E.</strong> — Holistic Online Profile and Enrollment System</p>
        <p>For <strong>M.B. Therapy Center</strong> &mdash; <em>"From Disabilities to Possibilities."</em></p>
        <small>&copy; {{ date('Y') }} M.B. Therapy Center. All rights reserved.</small>
    </div>
</footer>

</body>
</html>
