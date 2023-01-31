<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Knihovna</title>
    <link rel="shortcut icon" href="{{ asset('/img/icon.svg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com?plugins=forms,line-clamp"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/51eae37035.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.hotkeys/0.2.0/jquery.hotkeys.min.js"
        integrity="sha512-njd096AjZyGuWOttOsHolCOFjq9Xg9txZTl6Pd7FOpwf1nyBDsOXpS1cd184l/EWy5ekDJZldDMQPs9bLCSAtQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="/js/layout.js"></script>
</head>

<body>
    {{-- Navbar --}}
    <nav class="sticky top-0 z-30">
        <div class="container mx-auto p-6">
            <div class="relative flex h-10 content-center justify-between">
                {{-- Logo --}}
                <a href="/" class="hover:scale-125 hover:-rotate-6 transition">
                    <img class="h-10" src="{{ asset('/img/logo.svg') }}" alt="">
                </a>

                {{-- Search bar --}}
                <div class="absolute -top-20 xl:-top-2 left-1/2 -translate-x-1/2 h-fit w-full md:max-w-3xl lg:max-w-lg xl:max-w-2xl 2xl:max-w-3xl transition-all rounded-lg p-2"
                    id="search-frame">
                    <form action="/hledat" method="GET" id="search-form">
                        <input type="text" name="query"
                            class="h-10 w-full border border-slate-200 shadow-sm rounded-lg mb-2 pl-2 pr-10"
                            id="search-input" onfocus="showResults()" onblur="hideResults()" onkeyup="search()"
                            autocomplete="off" placeholder="Vyhledat...">
                        <input type="hidden" name="in" value="all" id="search-area">
                        <button class="absolute right-5 top-4" onclick="go()"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <div class="h-80 rounded-lg overflow-auto" id="search-results" style="display: none">
                        <div class="grid place-content-center h-full w-full"><span>Pro vyhledávání začněte psát</span>
                        </div>
                    </div>
                </div>

                {{-- Menu items --}}
                <div class="flex my-auto space-x-3 md:space-x-6">
                    {{-- Show search button --}}
                    <button
                        class="block xl:hidden rounded-md border border-slate-200 bg-yellow-400 px-4 py-2 shadow-sm hover:bg-amber-400 transition"
                        onclick="showSearchBar()" id="show-search-bar">Hledat <i
                            class="fa-solid fa-magnifying-glass"></i></button>

                    {{-- Show fullscreen menu --}}
                    <button onclick="openMenu()"
                        class="block md:hidden rounded-md border border-slate-200 bg-yellow-400 px-4 py-2 shadow-sm hover:bg-amber-400 transition">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    {{-- Links --}}
                    <span class="hidden md:flex my-auto space-x-6">
                        <p class="my-auto"><a class="hover:text-yellow-400 transition" href="/knihovna">Procházet</a>
                        </p>
                        <p class="my-auto"><a class="hover:text-yellow-400 transition" href="#">Kontakt</a></p>

                        {{-- Account dropdown button --}}
                        <button type="button" id="menu-button" aria-expanded="true" aria-haspopup="true"
                            onclick="$('#dropdown-menu').fadeToggle('fast');"
                            onblur="$('#dropdown-menu').fadeOut('fast');">
                            @auth
                                <i class="fa-regular fa-user"></i>
                            @else
                                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            @endauth
                            Účet <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </span>
                </div>

                {{-- Dropdown menu --}}
                <div id="dropdown-menu"
                    class="absolute right-0 z-10 mt-12 w-44 origin-top-right rounded-md bg-white shadow-md ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                    style="display: none">
                    <div class="py-1" role="none">
                        @auth
                            <a href="/ucet" class="block px-3 py-1 hover:text-yellow-400 transition" role="menuitem"
                                tabindex="-1" id="menu-item-0">Správa účtu</a>
                            <form action="/logout" method="post" role="menuitem" tabindex="-1" id="menu-item-1">
                                @csrf
                                <button class="block px-3 py-1 w-full text-left hover:text-yellow-400 transition">Odhlásit
                                    se</button>
                            </form>
                        @else
                            <a href="/prihlaseni" class="block px-3 py-1 hover:text-yellow-400 transition" role="menuitem"
                                tabindex="-1" id="menu-item-0">Přihlásit se</a>
                            <a href="/registrace" class="block px-3 py-1 hover:text-yellow-400 transition" role="menuitem"
                                tabindex="-1" id="menu-item-1">Vytvořit účet</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div id="navbar-backdrop" class="fixed top-0 w-full p-6 backdrop-blur transition bg-sky-100 z-20">
        <div class="h-10"></div>
    </div>

    {{-- Fullscreen menu --}}
    <div id="fullscreen-menu" style="display: none"
        class="fixed top-0 w-full h-full backdrop-blur bg-yellow-400/70 z-50 grid grid-cols-1 place-content-center">
        <div
            class="grid grid-cols-1 mx-8 py-8 rounded-md shadow-md place-content-center place-items-center gap-3 bg-slate-50">
            <p><a href="/knihovna">Procházet</a></p>
            <p><a href="#">Kontakt</a></p>
            <div class="w-full">
                <div
                    class="grid grid-cols-1 mx-8 py-8 rounded-md place-content-center place-items-center gap-3 bg-slate-100 shadow-inner">
                    <p class="font-bold">Účet:</p>
                    @auth
                        <p><a href="/ucet">Správa účtu</a></p>
                        <form action="/logout" method="post" role="menuitem" tabindex="-1" id="menu-item-1">
                            @csrf
                            <button>Odhlásit se</button>
                        </form>
                    @else
                        <p><a href="/prihlaseni">Přihlásit se</a></p>
                        <p><a href="/registrace">Vytvořit účet</a></p>
                    @endauth
                </div>
            </div>
        </div>
        <div class="absolute top-7 right-9 text-3xl cursor-pointer" onclick="closeMenu()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    {{-- Flash message --}}
    <x-Flash />

    {{-- Page content --}}
    <div class="container mx-auto p-6">
        {{ $slot }} {{-- Views output --}}
    </div>
</body>

</html>
