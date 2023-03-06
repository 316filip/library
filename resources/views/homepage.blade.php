<x-Layout heading="Domů">
    <div class="h-80 mb-8">
        <div class="absolute w-full h-80 left-0">
            <div
                class="relative h-full bg-gradient-to-b from-yellow-100 to-yellow-200 flex items-center justify-center -top-6">
                <h1 class="text-6xl text-center font-bold">Knihovna</h1>
            </div>
            <div class="w-full -translate-y-3/4 h-20 bg-contain bg-repeat-x bg-center"
                style="background-image: url(/img/devider.svg)">
            </div>
        </div>
    </div>
    <div>
        <h1 class="text-4xl text-center font-bold mb-5">Vítejte!</h1>
        <p class="text-center mb-5">Vytvořte si účet v naší knihovně a otevřete si dveře do bezplatné knihovny plné titulů,
            které Vás uchvátí.</p>
        <p class="text-center py-2 mb-5">
            <a href="/knihovna"
                class="px-3 py-2 shadow bg-yellow-400 hover:bg-amber-400 transition rounded-lg">Procházet</a>
        </p>
        <p class="text-center mb-5">Pokud hledáte něco konkrétního, můžete to zkusit vyhledat.</p>
        <div class="flex justify-center mb-5">
            <button class="px-3 py-2 shadow bg-sky-100 hover:bg-sky-200 transition rounded-lg"
                onclick="showSearchBar()">Hledat</button>
        </div>
        <h2 class="text-2xl text-center font-bold mb-5">Často kladené otázky</h2>
        <div class="flex justify-center">
            <div class="w-full max-w-4xl grid gap-3">
                <div class="border border-slate-200 rounded-lg px-4">
                    <div class="py-4 cursor-pointer" onclick="faq(1)">Jak se mohu stát členem? <i
                            class="fa-solid fa-caret-right transition" id="faq1-toggle"></i></div>
                    <div class="pt-4 border-t border-slate-200 py-4" id="faq1" style="display: none;">
                        <p>Abyste si mohli začít půjčovat knihy v naší knihovně, stačí si vytvořit účet na našem webu.
                            Při Vaší první osobní návštěvě Vám dáme Váš čtenářský průkaz. Jeho cena je 50 Kč.</p>
                    </div>
                </div>
                <div class="border border-slate-200 rounded-lg px-4">
                    <div class="py-4 cursor-pointer" onclick="faq(2)">Jaká je cena za zapůjčení knihy? <i
                            class="fa-solid fa-caret-right transition" id="faq2-toggle"></i></div>
                    <div class="pt-4 border-t border-slate-200 py-4" id="faq2" style="display: none;">
                        <p>Zapůjčení knihy je bezplatné. Platí se pouze za vydání čtenářského průkazu a případná pokuta
                            za pozdní vrácení knihy.</p>
                    </div>
                </div>
                <div class="border border-slate-200 rounded-lg px-4">
                    <div class="py-4 cursor-pointer" onclick="faq(3)">Kolik knih mohu mít půjčených současně? <i
                            class="fa-solid fa-caret-right transition" id="faq3-toggle"></i></div>
                    <div class="pt-4 border-t border-slate-200 py-4" id="faq3" style="display: none;">
                        <p>V jednu chvíli můžete mít rezervovaných až pět knih.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function faq(num) {
            $('#faq' + num).slideToggle();
            $('#faq' + num + '-toggle').toggleClass('rotate-90');
        }
    </script>
</x-Layout>
