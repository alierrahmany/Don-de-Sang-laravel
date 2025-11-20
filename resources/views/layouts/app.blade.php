<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodBank - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- ... autres balises ... -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles pour assurer que la sidebar fonctionne correctement */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        /* Empêcher le débordement horizontal */
        .main-container {
            overflow-x: hidden;
        }
        
        /* Style spécifique pour les messages flash */
        .flash-message {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        /* Ensure navbar spans full width */
        .full-width-navbar {
            left: 0;
            right: 0;
            width: 100%;
        }
        
        /* Dropdown styles */
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 1000;
            margin-top: 8px;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown-content a {
            color: #374151;
            padding: 12px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }
        
        .dropdown-content a:hover {
            background-color: #f3f4f6;
        }
        
        /* Mobile responsive dropdown */
        @media (max-width: 640px) {
            .dropdown-content {
                right: -10px;
                min-width: 180px;
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen main-container">
    @if(auth()->check())
    <!-- Top Navigation - Fixed with no margins -->
    <nav class="bg-red-600 text-white shadow-lg fixed w-full top-0 z-50 full-width-navbar">
        <div class="w-full px-4"> <!-- Changed from max-w-7xl mx-auto -->
            <div class="flex justify-between items-center py-4">
                <!-- Left Section - Don de Sang -->
                <div class="flex items-center space-x-4">
                    <button id="sidebarToggle" class="lg:hidden text-white focus:outline-none mr-2">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <i class="fas fa-heart text-red-600 text-sm"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">Don de Sang Admin</h1>
                        </div>
                    </div>
                </div>

                <!-- Right Section - User Dropdown -->
                <div class="flex items-center space-x-4">
                    <div class="dropdown relative">
                        <button class="flex items-center space-x-3 bg-red-700 px-4 py-2 rounded-lg hover:bg-red-800 transition-colors">
                            <i class="fas fa-user-circle"></i>
                            <span class="text-sm hidden sm:inline">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div class="dropdown-content">
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">Administrateur</p>
                            </div>
                            
                            <!-- Déconnexion -->
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-3 text-gray-700 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-sign-out-alt text-gray-400"></i>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-16 min-h-screen">
        <!-- Sidebar - Structure fixe -->
        <div id="sidebar" class="bg-white shadow-lg w-64 fixed left-0 top-16 h-[calc(100vh-4rem)] lg:static lg:h-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
            <div class="flex flex-col h-full">
                

                <!-- Navigation Links -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-600 border-r-4 border-red-600' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 text-center"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Donneurs -->
                    <a href="{{ route('donneurs.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-all duration-200 {{ request()->routeIs('donneurs.*') ? 'bg-red-50 text-red-600 border-r-4 border-red-600' : '' }}">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="font-medium">Gestion Donneurs</span>
                    </a>

                    <!-- Receveurs -->
                    <a href="{{ route('receveurs.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-all duration-200 {{ request()->routeIs('receveurs.*') ? 'bg-red-50 text-red-600 border-r-4 border-red-600' : '' }}">
                        <i class="fas fa-hand-holding-heart w-5 text-center"></i>
                        <span class="font-medium">Gestion Receveurs</span>
                    </a>
                    <!-- Dans la navigation de la sidebar, ajoutez : -->
<a href="{{ route('matching.index') }}" 
   class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-all duration-200 {{ request()->routeIs('matching.*') ? 'bg-red-50 text-red-600 border-r-4 border-red-600' : '' }}">
    <i class="fas fa-heartbeat w-5 text-center"></i>
    <span class="font-medium">Matching</span>
</a>
                </nav>

                <!-- User Info Sidebar -->
                <div class="p-4 border-t border-gray-200 mt-auto">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-red-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">Administrateur</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-0 w-full transition-all duration-300">
            <main class="p-6 w-full">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>
    @else
    <main class="min-h-screen">
        @yield('content')
    </main>
    @endif

    <!-- Messages Flash -->
    @if(session('success'))
    <div class="flash-message fixed top-20 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center space-x-2">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="flash-message fixed top-20 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center space-x-2">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <script>
        // Sidebar State Management
        let sidebarState = localStorage.getItem('sidebarState') || 'closed';
        
        // Initialize sidebar state
        function initializeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth >= 1024) {
                // Desktop - always show sidebar
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                sidebarState = 'open';
            } else {
                // Mobile - use saved state or default to closed
                if (sidebarState === 'open') {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.remove('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                }
            }
        }

        // Sidebar toggle for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth < 1024) {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
                
                // Update state
                sidebarState = sidebar.classList.contains('-translate-x-full') ? 'closed' : 'open';
                localStorage.setItem('sidebarState', sidebarState);
            }
        }

        // Close sidebar on mobile when clicking a link
        function handleSidebarLinkClick() {
            if (window.innerWidth < 1024) {
                const sidebar = document.getElementById('sidebar');
                const sidebarOverlay = document.getElementById('sidebarOverlay');
                
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                
                // Update state
                sidebarState = 'closed';
                localStorage.setItem('sidebarState', sidebarState);
            }
        }

        // Auto-hide flash messages after 5 seconds
        function autoHideFlashMessages() {
            setTimeout(() => {
                const flashMessages = document.querySelectorAll('.flash-message');
                flashMessages.forEach(message => {
                    message.style.display = 'none';
                });
            }, 5000);
        }

        // Close dropdown when clicking outside
        function closeDropdownOnClickOutside() {
            document.addEventListener('click', function(event) {
                const dropdowns = document.querySelectorAll('.dropdown');
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(event.target)) {
                        const dropdownContent = dropdown.querySelector('.dropdown-content');
                        if (dropdownContent) {
                            dropdownContent.style.display = 'none';
                        }
                    }
                });
            });
        }

        // Toggle dropdown on click (for mobile)
        function setupDropdownToggle() {
            const dropdownButtons = document.querySelectorAll('.dropdown button');
            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (window.innerWidth < 1024) {
                        e.preventDefault();
                        const dropdownContent = this.parentElement.querySelector('.dropdown-content');
                        const isVisible = dropdownContent.style.display === 'block';
                        
                        // Close all dropdowns first
                        document.querySelectorAll('.dropdown-content').forEach(content => {
                            content.style.display = 'none';
                        });
                        
                        // Toggle current dropdown
                        dropdownContent.style.display = isVisible ? 'none' : 'block';
                    }
                });
            });
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const sidebarLinks = document.querySelectorAll('#sidebar a');

            // Initialize sidebar state
            initializeSidebar();

            // Sidebar toggle event
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            // Overlay click event
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }

            // Sidebar link click events
            sidebarLinks.forEach(link => {
                link.addEventListener('click', handleSidebarLinkClick);
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                initializeSidebar();
            });

            // Auto-hide flash messages
            autoHideFlashMessages();

            // Dropdown functionality
            closeDropdownOnClickOutside();
            setupDropdownToggle();
        });
    </script>
</body>
</html>