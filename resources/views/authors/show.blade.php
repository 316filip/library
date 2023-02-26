<x-layout>
    <x-Image type="author" :data=$author placement="show" />
    <h1 class="text-4xl text-center font-bold mb-5">
        {{ $author->name }}
    </h1>
    <x-Manage type="author" :identifier="[$author->id, $author->slug]"></x-Manage>
    <x-Details type="author" :data=$author placement="home">Informace o autorovi
    </x-Details>
    <h2 class="text-2xl">Tituly</h2>
    @unless(count($author->works) == 0)
        <div class="mt-5">
            <x-Deck type="work">
                @foreach ($author->works as $work)
                    <x-Card :data=$work :info="['work', 0, 'author', '']" />
                @endforeach
            </x-Deck>
        </div>
    @else
        <p class="mt-5">Nemáme žádné tituly od tohoto autora</p>
    @endunless
</x-layout>
