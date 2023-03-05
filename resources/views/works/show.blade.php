<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">{{ $work->title }}</h1>
    <p class="text-center text-xl mb-5">{{ $work->subtitle }}</p>
    @lib
        <x-Manage type="work" :identifier="[$work->id, $work->slug]"></x-Manage>
    @endlib
    <x-Details type="work" :data=$work placement="home">Informace o titulu</x-Details>
    <h2 class="text-2xl mb-5">Vydání</h2>
    @unless(count($work->books) == 0)
        <x-Deck type="book">
            @foreach ($work->books as $book)
                <x-Card :data=$book :info="['book', 0, 'work', '']" />
            @endforeach
        </x-Deck>
    @else
        <p>Nemáme žádná vydání</p>
    @endunless
</x-layout>
