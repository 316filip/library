<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Knihy</h1>
    @unless(count($works) == 0)
        <h2 class="text-2xl font-bold mb-5">Novinky</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @foreach ($works as $work)
                <x-Card :data=$work type="work" number="{{ $loop->index }}" more="0" placement="away" />
            @endforeach
        </div>
    @else
        <p>Žádné knihy v knihovně</p>
    @endunless

    <h1 class="text-4xl text-center font-bold mt-5 mb-5">Autoři</h1>
    @unless(count($authors) == 0)
        <h2 class="text-2xl font-bold mb-5">Nejmladší</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @foreach ($authors as $author)
                <x-Card :data=$author type="author" number="{{ $loop->index }}" more="0" placement="away" />
            @endforeach
        </div>
    @else
        <p>Žádní autoři v knihovně</p>
    @endunless
</x-layout>
