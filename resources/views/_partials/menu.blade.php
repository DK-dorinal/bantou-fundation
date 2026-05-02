<header class="fixed top-0 left-0 w-full z-50 bg-white/90 backdrop-blur-md shadow-md border-b border-[#d4af37]/30 transition-all duration-300 font-sans" id="header">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('asset/img/logo/BFund/logo BH BF-05.png') }}" alt="Logo Bantou Foundation" class="h-12 w-auto">
            </a>

            <!-- Menu Desktop -->
            <ul class="hidden lg:flex items-center space-x-1">
                <!-- Notre Identité -->
                <li class="relative group">
                    <a href="{{ route('identite') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold uppercase tracking-wide text-[#d4af37] hover:text-[#e6c34d] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent rounded-lg transition-all duration-300 {{ Route::currentRouteName() == 'identite' ? 'bg-gradient-to-r from-[#d4af37]/15 to-transparent text-[#e6c34d]' : '' }}">
                        <i class="fas fa-users text-sm"></i>
                        <span>Notre Identité</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                    </a>
                    <div class="absolute left-1/2 -translate-x-1/2 top-full pt-3 w-72 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        <div class="bg-white/95 backdrop-blur-md rounded-xl shadow-2xl border border-[#d4af37]/20 border-t-3 border-t-[#d4af37] overflow-hidden">
                            <a href="{{ route('identite') }}#histoire" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-history w-5 text-[#d4af37]"></i> Histoire & Création
                            </a>
                            <a href="{{ route('identite') }}#mission" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-bullseye w-5 text-[#d4af37]"></i> Mission & Vision
                            </a>
                            <a href="{{ route('identite') }}#nos-valeurs" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-heart w-5 text-[#d4af37]"></i> Nos Valeurs
                            </a>
                            <a href="{{ route('identite') }}#conseil-administration" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-sitemap w-5 text-[#d4af37]"></i> Gouvernance
                            </a>
                            <a href="{{ route('identite') }}#mot-fondateur" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-quote-left w-5 text-[#d4af37]"></i> Mot du Fondateur
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Nos Actions -->
                <li class="relative group">
                    <a href="{{ route('action') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold uppercase tracking-wide text-[#d4af37] hover:text-[#e6c34d] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent rounded-lg transition-all duration-300 {{ Route::currentRouteName() == 'action' ? 'bg-gradient-to-r from-[#d4af37]/15 to-transparent text-[#e6c34d]' : '' }}">
                        <i class="fas fa-hands-helping text-sm"></i>
                        <span>Nos Actions</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                    </a>
                    <div class="absolute left-1/2 -translate-x-1/2 top-full pt-3 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        <div class="bg-white/95 backdrop-blur-md rounded-xl shadow-2xl border border-[#d4af37]/20 border-t-3 border-t-[#d4af37] overflow-hidden">
                            <a href="{{ route('action') }}#axes-intervention" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-graduation-cap w-5 text-[#d4af37]"></i> Nos Axes d'Intervention
                            </a>
                            <a href="{{ route('action') }}#chiffres-cles" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-chart-line w-5 text-[#d4af37]"></i> Chiffres clés
                            </a>
                            <a href="{{ route('action') }}#projets-realises" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-check-circle w-5 text-[#d4af37]"></i> Projets réalisés
                            </a>
                            <a href="{{ route('action') }}#projets-cours" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                <i class="fas fa-spinner w-5 text-[#d4af37]"></i> Projets en cours
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Blog -->
                <li>
                    <a href="{{ route('blog') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold uppercase tracking-wide text-[#d4af37] hover:text-[#e6c34d] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent rounded-lg transition-all duration-300 {{ Route::currentRouteName() == 'blog' ? 'bg-gradient-to-r from-[#d4af37]/15 to-transparent text-[#e6c34d]' : '' }}">
                        <i class="fas fa-newspaper text-sm"></i>
                        <span>Blog & Actualités</span>
                    </a>
                </li>

                <!-- Nous Rejoindre -->
                <li class="relative group">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold uppercase tracking-wide text-[#d4af37] hover:text-[#e6c34d] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent rounded-lg transition-all duration-300">
                        <i class="fas fa-handshake text-sm"></i>
                        <span>Nous Rejoindre</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                    </a>
                    <div class="absolute right-0 top-full pt-3 w-72 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        <div class="bg-white/95 backdrop-blur-md rounded-xl shadow-2xl border border-[#d4af37]/20 border-t-3 border-t-[#d4af37] overflow-hidden">
                            @auth
                                <div class="text-center px-4 py-4 bg-gradient-to-br from-[#d4af37]/10 to-transparent">
                                    <i class="fas fa-user-circle text-5xl text-[#d4af37] mb-2"></i>
                                    <div class="font-bold text-[#d4af37] text-sm">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                                <div class="h-px bg-gradient-to-r from-transparent via-[#d4af37]/20 to-transparent my-1"></div>
                                <a href="{{ route('user_dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-tachometer-alt w-5 text-[#d4af37]"></i> Tableau de bord
                                </a>
                                <a href="{{ route('user_profil') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-user w-5 text-[#d4af37]"></i> Mon profil
                                </a>
                                <a href="{{ route('historique') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-history w-5 text-[#d4af37]"></i> Historique des actions
                                </a>
                                <div class="h-px bg-gradient-to-r from-transparent via-[#d4af37]/20 to-transparent my-1"></div>
                                <a href="#" id="logoutMenuLink" class="flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:text-red-600 hover:bg-red-50 hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-sign-out-alt w-5"></i> Déconnexion
                                </a>
                            @else
                                <a href="{{ route('don') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-gift w-5 text-[#d4af37]"></i> Faire un don
                                </a>
                                <a href="{{ route('benevole') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-hands w-5 text-[#d4af37]"></i> Devenir bénévole
                                </a>
                                <a href="{{ route('partenaire') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-handshake w-5 text-[#d4af37]"></i> Devenir partenaire
                                </a>
                                <a href="{{ route('adhesion') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-user-plus w-5 text-[#d4af37]"></i> Adhérer à la fondation
                                </a>
                                <div class="h-px bg-gradient-to-r from-transparent via-[#d4af37]/20 to-transparent my-1"></div>
                                <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-sign-in-alt w-5 text-[#d4af37]"></i> Connexion
                                </a>
                                <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent hover:pl-6 transition-all duration-300">
                                    <i class="fas fa-user-plus w-5 text-[#d4af37]"></i> Inscription
                                </a>
                            @endauth
                        </div>
                    </div>
                </li>
            </ul>

            <!-- Bouton Don Desktop -->
            <div class="hidden lg:block">
                <a href="{{ route('don') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#d4af37] to-[#e6c34d] text-white font-bold text-sm uppercase rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                    <i class="fas fa-gift"></i> Faire un Don
                </a>
            </div>

            <!-- Bouton Menu Mobile -->
            <button class="lg:hidden flex flex-col items-center justify-center w-10 h-10 rounded-lg bg-[#d4af37]/10 hover:bg-[#d4af37]/20 transition-all duration-300" id="mobile-menu-toggle">
                <span class="block w-5 h-0.5 bg-[#d4af37] my-1 transition-all duration-300"></span>
                <span class="block w-5 h-0.5 bg-[#d4af37] my-1 transition-all duration-300"></span>
                <span class="block w-5 h-0.5 bg-[#d4af37] my-1 transition-all duration-300"></span>
            </button>
        </div>

        <!-- Menu Mobile -->
        <div class="lg:hidden fixed left-0 right-0 top-20 bg-white/95 backdrop-blur-md shadow-xl transform -translate-x-full transition-transform duration-300 z-40 overflow-y-auto max-h-[calc(100vh-80px)]" id="mobile-menu">
            <div class="flex flex-col py-4">
                <!-- Notre Identité Mobile -->
                <div class="border-b border-[#d4af37]/10">
                    <button class="mobile-dropdown-btn w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-users"></i>
                            <span>Notre Identité</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="mobile-dropdown-content hidden bg-[#d4af37]/5">
                        <a href="{{ route('identite') }}#histoire" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-history w-4 text-[#d4af37]"></i> Histoire & Création
                        </a>
                        <a href="{{ route('identite') }}#mission" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-bullseye w-4 text-[#d4af37]"></i> Mission & Vision
                        </a>
                        <a href="{{ route('identite') }}#nos-valeurs" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-heart w-4 text-[#d4af37]"></i> Nos Valeurs
                        </a>
                        <a href="{{ route('identite') }}#conseil-administration" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-sitemap w-4 text-[#d4af37]"></i> Gouvernance
                        </a>
                        <a href="{{ route('identite') }}#mot-fondateur" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-quote-left w-4 text-[#d4af37]"></i> Mot du Fondateur
                        </a>
                    </div>
                </div>

                <!-- Nos Actions Mobile -->
                <div class="border-b border-[#d4af37]/10">
                    <button class="mobile-dropdown-btn w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-hands-helping"></i>
                            <span>Nos Actions</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="mobile-dropdown-content hidden bg-[#d4af37]/5">
                        <a href="{{ route('action') }}#axes-intervention" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-graduation-cap w-4 text-[#d4af37]"></i> Nos Axes d'Intervention
                        </a>
                        <a href="{{ route('action') }}#chiffres-cles" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-chart-line w-4 text-[#d4af37]"></i> Chiffres clés
                        </a>
                        <a href="{{ route('action') }}#projets-realises" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-check-circle w-4 text-[#d4af37]"></i> Projets réalisés
                        </a>
                        <a href="{{ route('action') }}#projets-cours" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                            <i class="fas fa-spinner w-4 text-[#d4af37]"></i> Projets en cours
                        </a>
                    </div>
                </div>

                <!-- Blog Mobile -->
                <a href="{{ route('blog') }}" class="flex items-center gap-3 px-6 py-4 border-b border-[#d4af37]/10 font-semibold text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                    <i class="fas fa-newspaper"></i>
                    <span>Blog & Actualités</span>
                </a>

                <!-- Nous Rejoindre Mobile -->
                <div class="border-b border-[#d4af37]/10">
                    <button class="mobile-dropdown-btn w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-handshake"></i>
                            <span>Nous Rejoindre</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="mobile-dropdown-content hidden bg-[#d4af37]/5">
                        @auth
                            <div class="px-6 py-4 text-center bg-gradient-to-br from-[#d4af37]/10 to-transparent">
                                <i class="fas fa-user-circle text-4xl text-[#d4af37] mb-2"></i>
                                <div class="font-bold text-[#d4af37] text-sm">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <a href="{{ route('user_dashboard') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-tachometer-alt w-4 text-[#d4af37]"></i> Tableau de bord
                            </a>
                            <a href="{{ route('user_profil') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-user w-4 text-[#d4af37]"></i> Mon profil
                            </a>
                            <a href="{{ route('historique') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-history w-4 text-[#d4af37]"></i> Historique des actions
                            </a>
                            <a href="#" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-red-500 hover:text-red-600 hover:bg-red-50 transition-all duration-300" id="logoutMobileLink">
                                <i class="fas fa-sign-out-alt w-4"></i> Déconnexion
                            </a>
                        @else
                            <a href="{{ route('don') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-gift w-4 text-[#d4af37]"></i> Faire un don
                            </a>
                            <a href="{{ route('benevole') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-hands w-4 text-[#d4af37]"></i> Devenir bénévole
                            </a>
                            <a href="{{ route('partenaire') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-handshake w-4 text-[#d4af37]"></i> Devenir partenaire
                            </a>
                            <a href="{{ route('adhesion') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-user-plus w-4 text-[#d4af37]"></i> Adhérer à la fondation
                            </a>
                            <div class="h-px bg-gradient-to-r from-transparent via-[#d4af37]/20 to-transparent my-1"></div>
                            <a href="{{ route('login') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-sign-in-alt w-4 text-[#d4af37]"></i> Connexion
                            </a>
                            <a href="{{ route('register') }}" class="flex items-center gap-3 px-6 py-3 pl-12 text-sm text-gray-600 hover:text-[#d4af37] hover:bg-gradient-to-r hover:from-[#d4af37]/10 hover:to-transparent transition-all duration-300">
                                <i class="fas fa-user-plus w-4 text-[#d4af37]"></i> Inscription
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Bouton Don Mobile -->
                <div class="p-4 mt-2">
                    <a href="{{ route('don') }}" class="flex items-center justify-center gap-2 w-full px-5 py-3 bg-gradient-to-r from-[#d4af37] to-[#e6c34d] text-white font-bold text-sm uppercase rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-gift"></i> Faire un Don
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="h-20 w-full"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Header scroll effect
        const header = document.getElementById('header');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('shadow-lg');
                header.classList.add('border-b-[#d4af37]/50');
            } else {
                header.classList.remove('shadow-lg');
                header.classList.remove('border-b-[#d4af37]/50');
            }
        });

        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const spans = mobileToggle?.querySelectorAll('span');

        if (mobileToggle && mobileMenu) {
            mobileToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('-translate-x-full');
                spans?.forEach((span, index) => {
                    if (mobileMenu.classList.contains('-translate-x-full')) {
                        span.style.transform = '';
                        span.style.opacity = '1';
                    } else {
                        if (index === 0) span.style.transform = 'rotate(45deg) translate(5px, 5px)';
                        if (index === 1) span.style.opacity = '0';
                        if (index === 2) span.style.transform = 'rotate(-45deg) translate(5px, -5px)';
                    }
                });
                document.body.style.overflow = mobileMenu.classList.contains('-translate-x-full') ? '' : 'hidden';
            });
        }

        // Mobile dropdown buttons
        const mobileDropdownBtns = document.querySelectorAll('.mobile-dropdown-btn');
        mobileDropdownBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const icon = this.querySelector('.fa-chevron-down');
                content.classList.toggle('hidden');
                icon?.classList.toggle('rotate-180');
            });
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                if (mobileMenu && !mobileMenu.classList.contains('-translate-x-full')) {
                    mobileMenu.classList.add('-translate-x-full');
                    spans?.forEach(span => {
                        span.style.transform = '';
                        span.style.opacity = '1';
                    });
                    document.body.style.overflow = '';
                }
            });
        });

        // Logout functionality
        const logoutLinks = document.querySelectorAll('#logoutMenuLink, #logoutMobileLink');
        logoutLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Déconnexion',
                        text: 'Voulez-vous vraiment vous déconnecter ?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d4af37',
                        cancelButtonColor: '#dc2626',
                        confirmButtonText: 'Oui, me déconnecter',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form')?.submit();
                        }
                    });
                } else {
                    document.getElementById('logout-form')?.submit();
                }
            });
        });
    });
</script>

{{-- Formulaire de déconnexion --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<style>
.text-\[\#d4af37\]
{
    color: #1a2b55;
}
</style>
