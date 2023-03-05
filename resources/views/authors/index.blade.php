<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Nejmladší autoři</h1>
    @unless(count($authors) == 0)
        <x-Deck type="work">
            @foreach ($authors as $author)
                <x-Card :data=$author :info="['author', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $authors->appends(request()->input())->links() }}
    @else
        <p class="text-center mb-5 text-slate-500">Žádní autoři v knihovně...</p>
    @endunless
</x-layout>
