<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - HIMTI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a1b3d 0%, #133d87 50%, #1e4fa3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        .container {
            text-align: center;
            z-index: 10;
            padding: 40px 20px;
            max-width: 800px;
            width: 100%;
        }

        .space-scene {
            width: 300px;
            height: 300px;
            margin: 0 auto 30px;
            position: relative;
            perspective: 1000px;
        }

        .moon {
            position: absolute;
            top: 20px;
            right: 30px;
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0, #d0d0d0);
            border-radius: 50%;
            box-shadow: 
                inset -10px -5px 0 rgba(0, 0, 0, 0.1),
                0 0 40px rgba(255, 255, 255, 0.3);
            animation: moonFloat 6s ease-in-out infinite;
        }

        .moon::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 20px;
            width: 8px;
            height: 8px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
        }

        .moon::after {
            content: '';
            position: absolute;
            top: 35px;
            right: 15px;
            width: 5px;
            height: 5px;
            background: rgba(0, 0, 0, 0.08);
            border-radius: 50%;
        }

        .logo {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 240px;
            height: 240px;
            animation: logoFloat 8s ease-in-out infinite;
            transform-origin: center bottom;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.3));
        }

        .stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle 2s ease-in-out infinite;
        }

        .star:nth-child(1) {
            top: 10%;
            left: 15%;
            width: 3px;
            height: 3px;
            animation-delay: 0s;
        }

        .star:nth-child(2) {
            top: 25%;
            left: 80%;
            width: 2px;
            height: 2px;
            animation-delay: 0.5s;
        }

        .star:nth-child(3) {
            top: 60%;
            left: 20%;
            width: 4px;
            height: 4px;
            animation-delay: 1s;
        }

        .star:nth-child(4) {
            top: 40%;
            right: 10%;
            width: 2px;
            height: 2px;
            animation-delay: 1.5s;
        }

        .star:nth-child(5) {
            top: 70%;
            right: 30%;
            width: 3px;
            height: 3px;
            animation-delay: 2s;
        }

        .trail {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 5px;
            height: 0;
            background: linear-gradient(180deg, transparent, rgba(78, 205, 196, 0.8), transparent);
            animation: trailGrow 8s ease-in-out infinite;
        }

        @keyframes moonFloat {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg);
            }
            50% { 
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes logoFloat {
            0% {
                transform: translateX(-50%) translateY(0px) rotate(0deg);
            }
            25% {
                transform: translateX(-50%) translateY(-80px) rotate(-3deg);
            }
            50% {
                transform: translateX(-30%) translateY(-150px) rotate(3deg);
            }
            75% {
                transform: translateX(-10%) translateY(-200px) rotate(-2deg);
            }
            100% {
                transform: translateX(-50%) translateY(0px) rotate(0deg);
            }
        }

        @keyframes twinkle {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        @keyframes trailGrow {
            0% {
                height: 0;
                opacity: 0;
            }
            25% {
                height: 80px;
                opacity: 0.6;
            }
            50% {
                height: 150px;
                opacity: 0.8;
            }
            75% {
                height: 200px;
                opacity: 0.5;
            }
            100% {
                height: 0;
                opacity: 0;
            }
        }

        .title {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: slideInUp 1s ease-out;
        }

        .subtitle {
            font-size: 1.3rem;
            color: #e8f4fd;
            margin-bottom: 30px;
            animation: slideInUp 1s ease-out 0.2s both;
        }

        .description {
            font-size: 1.1rem;
            color: #b8d4f0;
            line-height: 1.6;
            margin-bottom: 40px;
            animation: slideInUp 1s ease-out 0.4s both;
        }

        .feature-preview {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 30px;
            margin-top: 40px;
            animation: slideInUp 1s ease-out 0.6s both;
        }

        .feature-title {
            font-size: 1.4rem;
            color: white;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .feature-list {
            list-style: none;
            color: #e8f4fd;
            font-size: 1rem;
        }

        .feature-list li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 30px;
        }

        .feature-list li::before {
            content: "🚀";
            position: absolute;
            left: 0;
            color: #ffd700;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .nebula {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(78, 205, 196, 0.1), rgba(255, 107, 107, 0.05), transparent);
            animation: nebulaFloat 20s linear infinite;
        }

        .nebula:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-duration: 25s;
        }

        .nebula:nth-child(2) {
            bottom: 20%;
            right: 15%;
            animation-duration: 30s;
            animation-delay: -10s;
        }

        @keyframes nebulaFloat {
            0% {
                transform: rotate(0deg) translateX(50px) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                opacity: 0.6;
            }
            100% {
                transform: rotate(360deg) translateX(50px) rotate(-360deg);
                opacity: 0.3;
            }
        }

        .launch-text {
            position: absolute;
            bottom: 150px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.9rem;
            color: #4ecdc4;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 0.7;
                transform: translateX(-50%) scale(1);
            }
            50% {
                opacity: 1;
                transform: translateX(-50%) scale(1.05);
            }
        }

        @media (max-width: 768px) {
            .title {
                font-size: 2.2rem;
            }
            
            .subtitle {
                font-size: 1.1rem;
            }
            
            .space-scene {
                width: 250px;
                height: 250px;
            }
            
            .moon {
                width: 60px;
                height: 60px;
            }
            
            .logo {
                width: 90px;
                height: 90px;
            }
            
            .feature-preview {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    @include('components.navbar')
    <div class="background-animation">
        <div class="nebula"></div>
        <div class="nebula"></div>
    </div>

    <div class="container">
        <div class="space-scene">
            <div class="stars">
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
            </div>
            
            <div class="moon"></div>
            
            <div class="logo">
                <img src="assets/logo_kabinet_transparan.png" alt="Logo Kabinet HMTI" />
            </div>
            
            <div class="trail"></div>
        </div>

        <h1 class="title">Coming Soon</h1>
        <p class="subtitle">Bersiap untuk Petualangan Digital</p>
        <p class="description">
            Tim HMTI sedang mempersiapkan peluncuran fitur revolusioner yang akan membawa pengalaman mahasiswa teknik informatika ke level yang baru. Seperti roket yang sedang bersiap menuju bulan, inovasi kami akan segera mengangkasa!
        </p>
    </div>
</body>
</html>