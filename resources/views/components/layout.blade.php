<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Knihovna</title>
    <script src="https://cdn.tailwindcss.com?plugins=line-clamp"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/51eae37035.js" crossorigin="anonymous"></script>
    <script src="/js/layout.js"></script>
</head>

<body>
    {{-- Navbar --}}
    <nav class="sticky top-0 z-50">
        <div class="container mx-auto p-6">
            <div class="relative flex h-10 content-center justify-between">
                {{-- Logo --}}
                <a href="/" class="hover:scale-125 hover:-rotate-6 transition">
                    <img class="h-10" src="{{ asset('/img/logo.svg') }}" alt="">
                </a>
                {{-- Search bar --}}
                <div class="absolute -top-20 xl:-top-2 left-1/2 -translate-x-1/2 h-fit w-full md:w-3/4 lg:w-1/2 transition-all rounded-lg p-2"
                    id="search-frame">
                    <form action="/hledat" method="GET" onsubmit="go(event)">
                        <input type="text" name="query" class="h-10 w-full border border-slate-200 rounded-lg mb-2 pl-2 pr-10"
                            id="search-input" onfocus="showResults()" onblur="hideResults()" onkeyup="search()"
                            autocomplete="off" placeholder="Vyhledat...">
                        <button class="absolute right-5 top-4" onclick="go(event)"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <div class="h-80 rounded-lg overflow-auto" id="search-results" style="display: none">
                        <div class="grid place-content-center h-full w-full"><span>Pro vyhledávání začněte psát</span>
                        </div>
                    </div>
                </div>
                {{-- Menu items --}}
                <div class="flex my-auto space-x-6">
                    <button class="block xl:hidden bg-yellow-400 p-2 rounded-md" onclick="showSearchBar()"
                        id="show-search-bar">Hledat <i class="fa-solid fa-magnifying-glass"></i></button>
                    {{-- Show search bar button --}}
                    <span class="hidden md:flex my-auto space-x-6">
                        <a class="hover:text-yellow-400 transition" href="/knihovna">Knihovna</a>
                        <a class="hover:text-yellow-400 transition" href="/autor">Autoři</a>
                        <a class="hover:text-yellow-400 transition" href="#">O nás</a>
                        <a class="hover:text-yellow-400 transition" href="#">Účet</a>
                    </span>
                </div>
            </div>
        </div>
    </nav>
    <div id="navbar-backdrop" class="fixed top-0 w-full p-6 backdrop-blur transition bg-sky-100 z-40">
        <div class="h-10"></div>
    </div>

    {{-- Page content --}}
    <div class="container mx-auto p-6">
        {{ $slot }} {{-- Views output --}}
    </div>
</body>

</html>
