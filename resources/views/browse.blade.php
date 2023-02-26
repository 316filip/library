<x-layout>
    @lib
        <h1 class="text-4xl text-center font-bold mb-5">Aktivní rezervace</h1>
        <div class="mb-5">
            <x-Deck type="booking">
                @foreach ($bookings as $booking)
                    <x-Card :data=$booking :info="['booking', $loop->index, 'bookings', '']" />
                @endforeach
            </x-Deck>
        </div>
    @endlib

    <h1 class="text-4xl text-center font-bold mb-5">Knihy</h1>
    @unless(count($works) == 0)
        <h2 class="text-2xl font-bold mb-5">Novinky</h2>
        <div class="mb-5">
            <x-Deck type="work">
                @foreach ($works as $work)
                    <x-Card :data=$work :info="['work', $loop->index, 'new', '']" />
                @endforeach
            </x-Deck>
        </div>
    @else
        <p>Žádné knihy v knihovně</p>
    @endunless

    @foreach ($suggestions as $suggestion)
        <h2 class="text-2xl font-bold mb-5">Protože jste četli {{ $suggestion['title'] }}</h2>
        <div class="mb-5">
            <x-Deck type="work">
                @foreach ($suggestion['works'] as $work)
                    <x-Card :data=$work :info="['work', $loop->index, 'read', $suggestion['slug']]" />
                @endforeach
            </x-Deck>
        </div>
    @endforeach

    @foreach ($categories as $category)
        @unless(count($category->assignments) == 0)
            <h2 class="text-2xl font-bold mb-5">{{ $category->name }}</h2>
            <div class="mb-5">
                <x-Deck type="work">
                    @foreach ($category->assignments->take(8) as $assignment)
                        <x-Card :data="$assignment->work" :info="['work', $loop->index, 'category', $category->slug]" />
                    @endforeach
                </x-Deck>
            </div>
        @endunless
    @endforeach

    <h1 class="text-4xl text-center font-bold mb-5">Autoři</h1>
    @unless(count($authors) == 0)
        <h2 class="text-2xl font-bold mb-5">Nejmladší</h2>
        <div class="mb-5">
            <x-Deck type="author">
                @foreach ($authors as $author)
                    <x-Card :data=$author :info="['author', $loop->index, 'young', '']" />
                @endforeach
            </x-Deck>
        </div>
    @else
        <p>Žádní autoři v knihovně</p>
    @endunless
</x-layout>
