<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} - MB Center Enrollment</title>

        @fonts

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Custom Styles for Green-YellowGreen-Yellow Theme -->
        <style>
            :root {
                --primary-green: #22c55e;
                --secondary-green: #16a34a;
                --dark-green: #15803d;
                --light-green: #dcfce7;
                --yellowgreen: #84cc16;
                --lime-green: #a3e635;
                --primary-yellow: #eab308;
                --light-yellow: #fef08a;
                --light-bg: #f0fdf4;
                --dark-bg: #052e16;
            }
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            html, body {
                height: 100%;
            }
            
            body {
                background: linear-gradient(135deg, var(--light-bg) 0%, #fef3c7 100%);
                min-height: 100vh;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            /* Navbar Styling */
            .navbar {
                background: linear-gradient(90deg, var(--dark-green) 0%, var(--secondary-green) 50%, var(--primary-green) 100%);
                box-shadow: 0 8px 25px rgba(34, 197, 94, 0.2);
                padding: 1rem 0;
            }
            
            .navbar-brand {
                font-weight: 800;
                font-size: 1.8rem;
                color: white !important;
                letter-spacing: -0.5px;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            
            .navbar-brand i {
                font-size: 2rem;
                color: var(--primary-yellow);
            }
            
            .nav-link {
                color: rgba(255, 255, 255, 0.8) !important;
                font-weight: 600;
                transition: all 0.3s ease;
                margin: 0 0.75rem;
                position: relative;
            }
            
            .nav-link::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--primary-yellow);
                transition: width 0.3s ease;
            }
            
            .nav-link:hover {
                color: white !important;
                transform: translateY(-2px);
            }
            
            .nav-link:hover::after {
                width: 100%;
            }
            
            .btn-auth {
                padding: 0.6rem 1.5rem;
                font-weight: 600;
                border-radius: 8px;
                transition: all 0.3s ease;
                margin: 0 0.5rem;
            }
            
            .btn-login {
                background: transparent;
                color: white;
                border: 2px solid white;
            }
            
            .btn-login:hover {
                background: white;
                color: var(--secondary-green);
                transform: translateY(-3px);
            }
            
            .btn-register {
                background: var(--primary-yellow);
                color: var(--dark-green);
                border: none;
            }
            
            .btn-register:hover {
                background: var(--light-yellow);
                transform: translateY(-3px);
            }
            
            /* Hero Section */
            .hero-section {
                padding: 100px 20px 80px;
                text-align: center;
                background: linear-gradient(180deg, var(--light-bg) 0%, transparent 100%);
            }
            
            .hero-title {
                color: var(--dark-green);
                font-size: 3.5rem;
                font-weight: 900;
                margin-bottom: 1rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
                letter-spacing: -1.5px;
                line-height: 1.2;
            }
            
            .hero-subtitle {
                color: var(--secondary-green);
                font-size: 1.4rem;
                margin-bottom: 2rem;
                font-weight: 600;
                opacity: 0.9;
            }
            
            .hero-description {
                color: #6b7280;
                font-size: 1.1rem;
                margin-bottom: 2.5rem;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
                line-height: 1.8;
            }
            
            .cta-buttons {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
                margin-bottom: 3rem;
            }
            
            .btn-cta-primary {
                background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
                color: white;
                border: none;
                padding: 1rem 2.5rem;
                font-weight: 700;
                border-radius: 10px;
                transition: all 0.3s ease;
                box-shadow: 0 8px 20px rgba(34, 197, 94, 0.3);
                font-size: 1.05rem;
            }
            
            .btn-cta-primary:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 30px rgba(34, 197, 94, 0.4);
                color: white;
            }
            
            .btn-cta-secondary {
                background: var(--primary-yellow);
                color: var(--dark-green);
                border: none;
                padding: 1rem 2.5rem;
                font-weight: 700;
                border-radius: 10px;
                transition: all 0.3s ease;
                box-shadow: 0 8px 20px rgba(234, 179, 8, 0.3);
                font-size: 1.05rem;
            }
            
            .btn-cta-secondary:hover {
                background: var(--light-yellow);
                transform: translateY(-5px);
                box-shadow: 0 12px 30px rgba(234, 179, 8, 0.4);
                color: var(--dark-green);
            }
            
            /* Feature Cards */
            .features-section {
                padding: 80px 20px;
                background: white;
            }
            
            .section-title {
                color: var(--dark-green);
                font-size: 2.8rem;
                font-weight: 900;
                text-align: center;
                margin-bottom: 3rem;
                letter-spacing: -0.5px;
            }
            
            .section-subtitle {
                color: var(--primary-green);
                text-align: center;
                font-size: 1.1rem;
                margin-bottom: 3rem;
                font-weight: 600;
            }
            
            .feature-card {
                background: white;
                border: 3px solid var(--primary-yellow);
                border-radius: 18px;
                padding: 2.5rem;
                transition: all 0.4s ease;
                height: 100%;
                box-shadow: 0 12px 35px rgba(34, 197, 94, 0.08);
                position: relative;
                overflow: hidden;
            }
            
            .feature-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, var(--primary-green) 0%, var(--yellowgreen) 100%);
            }
            
            .feature-card:hover {
                transform: translateY(-12px);
                box-shadow: 0 20px 50px rgba(34, 197, 94, 0.2);
                border-color: var(--primary-green);
            }
            
            .feature-icon {
                width: 70px;
                height: 70px;
                background: linear-gradient(135deg, var(--primary-yellow) 0%, var(--yellowgreen) 100%);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
                font-size: 2.2rem;
                box-shadow: 0 6px 20px rgba(234, 179, 8, 0.25);
            }
            
            .feature-title {
                color: var(--dark-green);
                font-size: 1.4rem;
                font-weight: 800;
                margin-bottom: 0.75rem;
            }
            
            .feature-text {
                color: #6b7280;
                line-height: 1.8;
                font-size: 0.95rem;
            }
            
            /* Stats Section */
            .stats-section {
                background: linear-gradient(135deg, var(--dark-green) 0%, var(--secondary-green) 50%, var(--primary-green) 100%);
                padding: 70px 20px;
                border-radius: 25px;
                color: white;
                margin: 80px 20px;
                box-shadow: 0 20px 50px rgba(34, 197, 94, 0.25);
            }
            
            .stat-item {
                text-align: center;
                padding: 2.5rem;
            }
            
            .stat-number {
                font-size: 3rem;
                font-weight: 900;
                color: var(--primary-yellow);
                display: block;
                margin-bottom: 0.5rem;
            }
            
            .stat-label {
                font-size: 1.1rem;
                opacity: 0.95;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            
            /* Info Section */
            .info-section {
                padding: 80px 20px;
                background: linear-gradient(180deg, transparent 0%, var(--light-bg) 100%);
            }
            
            .info-box {
                background: white;
                border-left: 6px solid var(--primary-green);
                padding: 2rem;
                border-radius: 12px;
                margin-bottom: 2rem;
                box-shadow: 0 8px 20px rgba(34, 197, 94, 0.1);
                transition: all 0.3s ease;
            }
            
            .info-box:hover {
                transform: translateX(5px);
                box-shadow: 0 12px 30px rgba(34, 197, 94, 0.15);
            }
            
            .info-box h5 {
                color: var(--dark-green);
                font-weight: 800;
                margin-bottom: 0.5rem;
            }
            
            .info-box p {
                color: #6b7280;
                margin: 0;
                line-height: 1.7;
            }
            
            /* Links */
            .link-green {
                color: var(--primary-green);
                text-decoration: none;
                font-weight: 700;
                transition: all 0.2s ease;
                border-bottom: 2px solid transparent;
            }
            
            .link-green:hover {
                color: var(--secondary-green);
                border-bottom-color: var(--secondary-green);
            }
            
            /* Footer */
            .footer {
                background: var(--dark-bg);
                color: white;
                padding: 50px 20px 30px;
                text-align: center;
                margin-top: 80px;
            }
            
            .footer p {
                margin: 0;
                opacity: 0.85;
                font-size: 0.95rem;
            }
            
            .footer-version {
                color: var(--primary-yellow);
                font-weight: 700;
                margin-top: 1rem;
            }
            
            /* Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .hero-section {
                animation: fadeInUp 0.8s ease-out;
            }
            
            .feature-card {
                animation: fadeInUp 0.8s ease-out;
            }
            
            .feature-card:nth-child(1) { animation-delay: 0.1s; }
            .feature-card:nth-child(2) { animation-delay: 0.2s; }
            .feature-card:nth-child(3) { animation-delay: 0.3s; }
            .feature-card:nth-child(4) { animation-delay: 0.4s; }
            
            /* Responsive */
            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.5rem;
                }
                
                .hero-subtitle {
                    font-size: 1.1rem;
                }
                
                .section-title {
                    font-size: 2rem;
                }
                
                .cta-buttons {
                    flex-direction: column;
                    align-items: center;
                }
                
                .btn-cta-primary, .btn-cta-secondary {
                    width: 100%;
                    max-width: 300px;
                }
                
                .navbar-brand {
                    font-size: 1.4rem;
                }
            }
        </style>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Fallback styles if needed */
            </style>
        @endif
    </head>
    <body>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-graduation-cap"></i>
                    {{ config('app.name', 'MB Center') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="btn btn-auth btn-login" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt"></i> Log in
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="btn btn-auth btn-register" href="{{ route('register') }}">
                                            <i class="fas fa-user-plus"></i> Register
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <h1 class="hero-title">Welcome to MB Center</h1>
                <p class="hero-subtitle">Enrollment System Platform</p>
                <p class="hero-description">
                    A modern and efficient enrollment management system designed to streamline the educational enrollment process. 
                    Get started today and experience seamless registration and management.
                </p>
                
                <div class="cta-buttons">
                    <a href="{{ route('login') }}" class="btn btn-cta-primary">
                        <i class="fas fa-sign-in-alt"></i> Log In
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-cta-secondary">
                        <i class="fas fa-user-plus"></i> Get Started
                    </a>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <div class="container">
                <h2 class="section-title">Key Features</h2>
                <p class="section-subtitle">Everything you need for seamless enrollment management</p>
                
                <div class="row g-4">
                    <div class="col-lg-6 col-md-12">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-edit" style="color: var(--dark-green);"></i>
                            </div>
                            <h5 class="feature-title">Easy Enrollment</h5>
                            <p class="feature-text">
                                Simple and intuitive enrollment process. Complete your registration in just a few clicks with our user-friendly interface.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-lock" style="color: var(--dark-green);"></i>
                            </div>
                            <h5 class="feature-title">Secure & Safe</h5>
                            <p class="feature-text">
                                Your data is protected with enterprise-grade security. We ensure all your personal information is encrypted and safe.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-chart-bar" style="color: var(--dark-green);"></i>
                            </div>
                            <h5 class="feature-title">Real-time Tracking</h5>
                            <p class="feature-text">
                                Monitor your enrollment status in real-time. Get instant notifications and updates about your application progress.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-headset" style="color: var(--dark-green);"></i>
                            </div>
                            <h5 class="feature-title">24/7 Support</h5>
                            <p class="feature-text">
                                Our dedicated support team is always available to help. Get answers to your questions anytime, anywhere.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section container-fluid">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="stat-item">
                        <span class="stat-number">5,000+</span>
                        <span class="stat-label">Active Students</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Satisfaction Rate</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Partner Schools</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Info Section -->
        <section class="info-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box">
                            <h5><i class="fas fa-rocket" style="color: var(--primary-green);"></i> Get Started</h5>
                            <p>
                                Ready to enroll? Click the button above to create your account and start the enrollment process. It only takes a few minutes!
                            </p>
                        </div>
                        
                        <div class="info-box">
                            <h5><i class="fas fa-book" style="color: var(--primary-green);"></i> Documentation</h5>
                            <p>
                                Check out our comprehensive 
                                <a href="https://laravel.com/docs" target="_blank" class="link-green">documentation</a>
                                to learn more about the system and best practices.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="info-box">
                            <h5><i class="fas fa-video" style="color: var(--primary-green);"></i> Video Tutorials</h5>
                            <p>
                                Watch video tutorials at 
                                <a href="https://laracasts.com" target="_blank" class="link-green">Laracasts</a>
                                to understand how to use the platform effectively.
                            </p>
                        </div>
                        
                        <div class="info-box">
                            <h5><i class="fas fa-cloud" style="color: var(--primary-green);"></i> Cloud Deployment</h5>
                            <p>
                                Deploy your application on 
                                <a href="https://cloud.laravel.com" target="_blank" class="link-green">Laravel Cloud</a>
                                for reliable and scalable hosting.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <p>
                    <strong>MB Center Enrollment System</strong> | Building better education experiences
                </p>
                <p class="footer-version">
                    Version {{ app()->version() }}
                    <a href="https://github.com/laravel/framework/blob/13.x/CHANGELOG.md" target="_blank" class="link-green">
                        View changelog <i class="fas fa-external-link-alt"></i>
                    </a>
                </p>
                <p style="margin-top: 2rem; font-size: 0.9rem; opacity: 0.7;">
                    &copy; 2024 MB Center Enrollment System. All rights reserved.
                </p>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        </script>
    </body>
</html>
