<style>
        /* Reset dan Variabel */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #2c3e50;
            --secondary-light: #4a6491;
            --accent: #e74c3c;
            --tiktok: #000000;
            --tiktok-hover: #333333;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --gray: #95a5a6;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark);
            line-height: 1.7;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* ========== NAVIGASI BARU ========== */
        .navbar {
            background: rgba(44, 62, 80, 0.95);
            backdrop-filter: blur(10px);
            padding: 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }
        
        .navbar.scrolled {
            background: rgba(44, 62, 80, 0.98);
            padding: 0;
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        
        .logo {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }
        
        .logo:hover {
            color: var(--primary);
            transform: scale(1.05);
        }
        
        .logo span {
            color: var(--primary);
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
            margin: 0;
            padding: 0;
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            padding: 8px 0;
            transition: var(--transition);
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link.active {
            color: var(--primary);
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        .nav-button {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        .nav-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            background: linear-gradient(135deg, var(--primary-dark) 0%, #2573a7 100%);
        }
        
        /* Tombol TikTok Baru */
        .tiktok-button {
            background: var(--tiktok);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        
        .tiktok-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
            background: var(--tiktok-hover);
        }
        
        .button-group {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .mobile-menu-btn:hover {
            color: var(--primary);
        }
        
        /* Responsive Navigation */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 70px);
                background: rgba(44, 62, 80, 0.98);
                backdrop-filter: blur(10px);
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding-top: 50px;
                transition: 0.5s;
                gap: 0;
            }
            
            .nav-menu.active {
                left: 0;
            }
            
            .nav-item {
                width: 100%;
                text-align: center;
                margin: 15px 0;
            }
            
            .nav-link {
                display: block;
                padding: 15px 0;
                font-size: 1.2rem;
                width: 100%;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .nav-button, .tiktok-button {
                margin-top: 10px;
                padding: 12px 30px;
            }
            
            .button-group {
                flex-direction: column;
                width: 100%;
                padding: 0 20px;
            }
        }
        
        /* Space for fixed navbar */
        .navbar-space {
            height: 70px;
        }
        
        /* Animasi Keyframes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        
        @keyframes blink {
            0%, 100% { border-color: transparent; }
            50% { border-color: var(--primary); }
        }
        
        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header dengan Animasi Gradient */
        .header {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
            color: white;
            padding: 100px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeIn 1s ease-out;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: gradientBG 15s ease infinite;
            background-size: 400% 400%;
        }
        
        .header-content {
            position: relative;
            z-index: 2;
            animation: fadeIn 1.5s ease-out;
        }
        
        .header h1 {
            font-size: 3.5rem;
            margin-bottom: 15px;
            background: linear-gradient(to right, white, var(--light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
            animation: slideInLeft 1s ease-out;
        }
        
        .title-animation {
            font-size: 1.8rem;
            margin-bottom: 25px;
            opacity: 0.9;
            animation: slideInRight 1s ease-out 0.3s both;
        }
        
        .typing-text {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            border-right: 3px solid var(--primary);
            animation: typing 3.5s steps(40, end), blink .75s step-end infinite;
        }
        
        /* Floating Particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        /* Content Box dengan Hover Effects */
        .content-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 0.8s ease-out forwards;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .content-box:nth-child(2) { animation-delay: 0.2s; }
        .content-box:nth-child(3) { animation-delay: 0.4s; }
        .content-box:nth-child(4) { animation-delay: 0.6s; }
        
        .content-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .content-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--accent));
            transform: scaleY(0);
            transform-origin: top;
            transition: transform 0.5s ease;
        }
        
        .content-box:hover::before {
            transform: scaleY(1);
        }
        
        /* Title dengan Underline Animation */
        .title {
            color: var(--secondary);
            font-size: 2.2rem;
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
            animation: slideInLeft 0.8s ease-out;
        }
        
        .title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            animation: titleUnderline 1s ease-out 0.5s forwards;
        }
        
        @keyframes titleUnderline {
            to { transform: scaleX(1); }
        }
        
        /* Profile Section dengan Floating Image */
        .profile-section {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .profile-image-container {
            position: relative;
            animation: float 4s ease-in-out infinite;
        }
        
        .profile-image {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 8px solid white;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 2;
            transition: var(--transition);
        }
        
        .profile-image:hover {
            transform: rotate(5deg) scale(1.05);
        }
        
        .profile-image-container::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--accent));
            top: -10px;
            left: -10px;
            z-index: 1;
            animation: pulse 2s ease-in-out infinite;
        }
        
        .profile-info {
            flex: 1;
            min-width: 300px;
        }
        
        /* Button dengan Animasi */
        .button-container {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .route-button {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeIn 1s ease-out;
        }
        
        .route-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        
        .route-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.4);
        }
        
        .route-button:hover::before {
            left: 100%;
        }
        
        .route-button i {
            font-size: 1.2rem;
        }
        
        /* Skills dengan Progress Bar Animation */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .skill-item {
            background: var(--light);
            padding: 20px;
            border-radius: 15px;
            transition: var(--transition);
            animation: fadeIn 0.8s ease-out;
        }
        
        .skill-item:hover {
            transform: translateY(-5px);
            background: white;
            box-shadow: var(--shadow);
        }
        
        .skill-name {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .skill-bar {
            height: 10px;
            background: #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .skill-level {
            height: 100%;
            background: linear-gradient(to right, var(--primary), var(--accent));
            border-radius: 5px;
            width: 0;
            animation: fillBar 1.5s ease-out forwards;
        }
        
        @keyframes fillBar {
            from { width: 0; }
        }
        
        /* Contact List dengan Icons Animation */
        .contact-list {
            list-style: none;
            margin-top: 20px;
        }
        
        .contact-list li {
            padding: 18px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
            animation: fadeIn 0.8s ease-out;
        }
        
        .contact-list li:hover {
            transform: translateX(10px);
            background: var(--light);
            padding-left: 20px;
            border-radius: 10px;
        }
        
        .contact-list li:last-child {
            border-bottom: none;
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            transition: var(--transition);
        }
        
        .contact-list li:hover .contact-icon {
            transform: rotate(15deg) scale(1.1);
        }
        
        /* Footer dengan Wave Animation */
        .footer {
            background: var(--secondary);
            color: white;
            padding: 60px 0 30px;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: -100px;
            left: 0;
            width: 100%;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%23ffffff'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-repeat: no-repeat;
            animation: wave 20s linear infinite;
        }
        
        @keyframes wave {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        .footer-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        
        .footer p {
            margin-bottom: 10px;
            opacity: 0.9;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .footer-link {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: var(--transition);
            position: relative;
        }
        
        .footer-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }
        
        .footer-link:hover {
            opacity: 1;
            transform: translateY(-3px);
        }
        
        .footer-link:hover::after {
            width: 100%;
        }
        
        /* Scroll Animation */
        .fade-in {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Tombol Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 999;
            opacity: 0;
            transform: translateY(20px);
            transition: var(--transition);
        }
        
        .back-to-top.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }
            
            .title {
                font-size: 1.8rem;
            }
            
            .profile-section {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-image-container {
                margin: 0 auto;
            }
            
            .button-container {
                justify-content: center;
            }
            
            .route-button {
                width: 100%;
                justify-content: center;
            }
            
            .content-box {
                padding: 30px 20px;
            }
            
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
            }
            
            .footer-links {
                gap: 15px;
            }
        }

        /* Tambahkan di style.blade.php */
.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 12px 20px;
    border-radius: 8px;
    display: inline-block;
    animation: fadeIn 0.5s ease;
    border-left: 4px solid #28a745;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    padding: 12px 20px;
    border-radius: 8px;
    display: inline-block;
    animation: fadeIn 0.5s ease;
    border-left: 4px solid #dc3545;
}

.alert-info {
    background: #d1ecf1;
    color: #0c5460;
    padding: 12px 20px;
    border-radius: 8px;
    display: inline-block;
    animation: fadeIn 0.5s ease;
    border-left: 4px solid #17a2b8;
}

.alert-warning {
    background: #fff3cd;
    color: #856404;
    padding: 12px 20px;
    border-radius: 8px;
    display: inline-block;
    animation: fadeIn 0.5s ease;
    border-left: 4px solid #ffc107;
}   
    </style>
    <!-- Font Awesome untuk Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>