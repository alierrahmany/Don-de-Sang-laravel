<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - BloodBank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #fef2f2 0%, #fff 50%, #fff1f2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .heartbeat {
            animation: heartbeat 1.5s ease-in-out infinite both;
        }
        
        @keyframes heartbeat {
            from {
                transform: scale(1);
                transform-origin: center center;
                animation-timing-function: ease-out;
            }
            10% {
                transform: scale(0.95);
                animation-timing-function: ease-in;
            }
            17% {
                transform: scale(1);
                animation-timing-function: ease-out;
            }
            33% {
                transform: scale(0.95);
                animation-timing-function: ease-in;
            }
            45% {
                transform: scale(1);
                animation-timing-function: ease-out;
            }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translate(0,  0px); }
            50%  { transform: translate(0, -10px); }
            100%   { transform: translate(0, 0px); }    
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
        }
        
        .bg-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(254, 202, 202, 0.15) 0%, transparent 55%),
                radial-gradient(circle at 75% 75%, rgba(251, 207, 232, 0.15) 0%, transparent 55%),
                radial-gradient(circle at 50% 10%, rgba(254, 240, 240, 0.2) 0%, transparent 35%);
        }
        
        .bg-hearts {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .heart {
            position: absolute;
            opacity: 0.1;
            fill: #ef4444;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-pattern">
    <!-- Éléments décoratifs flottants améliorés -->
    <div class="absolute top-10 left-10 w-6 h-6 bg-red-200 rounded-full opacity-70 floating" style="animation-delay: 0s;"></div>
    <div class="absolute top-20 right-20 w-4 h-4 bg-pink-200 rounded-full opacity-60 floating" style="animation-delay: 0.5s;"></div>
    <div class="absolute bottom-20 left-20 w-5 h-5 bg-rose-200 rounded-full opacity-50 floating" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-10 right-10 w-3 h-3 bg-red-300 rounded-full opacity-70 floating" style="animation-delay: 1.5s;"></div>
    
    <!-- Cœurs décoratifs en arrière-plan -->
    <div class="bg-hearts">
        <svg class="heart w-8 h-8 absolute top-1/4 left-1/4" viewBox="0 0 24 24">
            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
        <svg class="heart w-6 h-6 absolute top-1/3 right-1/4" viewBox="0 0 24 24">
            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
        <svg class="heart w-10 h-10 absolute bottom-1/4 right-1/3" viewBox="0 0 24 24">
            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
        <svg class="heart w-5 h-5 absolute bottom-1/3 left-1/3" viewBox="0 0 24 24">
            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
    </div>
    
    <div class="max-w-md w-full relative z-10">
        <!-- Logo/Icon Section -->
        <div class="text-center mb-10">
            <div class="mx-auto h-24 w-24 bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl flex items-center justify-center shadow-lg transform hover:scale-105 transition-all duration-300 heartbeat">
                <svg class="h-12 w-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900 tracking-tight">
                Connexion Admin
            </h2>
            <p class="mt-3 text-sm text-gray-600 font-medium">
                Don de Sang - <span class="text-red-600 font-semibold">Chaque goutte compte</span>
            </p>
        </div>

        <!-- Login Card -->
        <div class="glass-effect rounded-2xl card-shadow p-8 space-y-6 border border-gray-100">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Adresse email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 input-focus sm:text-sm"
                            placeholder="admin@bloodbank.ma" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 input-focus sm:text-sm"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="group relative w-full flex justify-center items-center py-3.5 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="h-5 w-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Se connecter
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Text -->
        <p class="mt-8 text-center text-xs text-gray-500 font-medium">
            Plateforme sécurisée de gestion des dons de sang
        </p>
    </div>
</body>
</html>