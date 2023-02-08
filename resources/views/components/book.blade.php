<div
    class="flex {{ $placement == 'show' ? 'mb-5 justify-center' : 'items-center border border-slate rounded-lg p-2 shadow-inner mt-2' }}">
    @if ($available === false)
        <p class="text-red-600 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Momentálně nedostupné</p>
    @elseif ($available === 'soon')
        <p class="text-amber-500 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Dostupné již brzy</p>
    @elseif ($available === 'booked')
        <p class="text-slate-500 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Tuto knihu již máte půjčenou
        </p>
    @elseif($available === true)
        <p class="text-lime-600 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Dostupné právě teď</p>
    @else
        <p class="text-amber-500 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Dostupné přibližně od
            {{ date('d. m. Y', strtotime($available)) }}
        </p>
    @endif
    @if ($placement == 'index')
        <button class="px-3 py-2 shadow z-10 {{ $bookable ? 'bg-sky-100' : 'bg-slate-100' }} rounded-lg"
            {{ $bookable ? '' : 'disabled' }} onclick="openBook()"><i class="fa-regular fa-bookmark"></i></button>
    @endif
</div>

@if ($placement == 'show')
    <div class="flex justify-center {{ $placement == 'show' ? 'mb-5' : 'mt-4 mb-1' }}">
        <button
            class="px-3 py-2 shadow {{ $placement == 'show' ? '' : 'z-10' }} {{ $bookable ? 'bg-sky-100' : 'bg-slate-100' }} rounded-lg"
            {{ $bookable ? '' : 'disabled' }} onclick="openBook()">Rezervovat</button>
    </div>
@endif

<div id="fullscreen-book" style="display: none"
    class="fixed top-0 left-0 w-full h-full px-3 backdrop-blur bg-yellow-400/70 z-50 grid grid-cols-1 place-content-center overflow-y-auto">
    <div class="mx-auto w-full max-w-4xl py-8 px-6 rounded-lg shadow-md bg-slate-50">
        <div class="mx-auto max-w-3xl grid grid-cols-1 place-content-center place-items-center gap-5">
            <h2 class="text-2xl font-bold text-center">Rezervace knihy</h2>
            @auth
                <p class="text-center">Knihu si vyzvedněte do pěti dnů od rezervace. Do měsíce ji vraťte.</p>
                <form class="grid grid-cols-2 gap-5 w-full" action="/rezervace" method="post">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ old('book_id') ?? $book->id }}" autocomplete="off">
                    @lib
                        <div class="col-span-2">
                            <x-Select type="user" target="" :values=$users />
                        </div>
                    @endlib
                    <div class="flex justify-center">
                        <input type="button" class="px-3 py-2 bg-sky-100 rounded-lg shadow cursor-pointer" value="Zrušit"
                            onclick="closeBook()" />
                    </div>
                    <div class="flex justify-center">
                        <button class="px-3 py-2 bg-yellow-400 rounded-lg shadow">Rezervovat</button>
                    </div>
                </form>
            @else
                <p class="text-center">Pro možnost rezervace knihy si prosím zřiďte uživatelský účet.</p>
                <div class="grid grid-cols-2 gap-5 w-full">
                    <div class="flex justify-center">
                        <button class="px-3 py-2 bg-sky-100 rounded-lg shadow" onclick="closeBook()">Zrušit</button>
                    </div>
                    <div class="flex justify-center">
                        <a href="/registrace" class="px-3 py-2 bg-yellow-400 rounded-lg shadow">Registrovat</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

<script>
    function openBook() {
        $("#fullscreen-book").fadeIn("fast");
        @lib
        placeDropdown();
        @endlib
    }

    function closeBook() {
        $("#fullscreen-book").fadeOut("fast");
    }
</script>
