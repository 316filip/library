<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Nejnovější díla</h1>
    @unless(count($works) == 0)
        <x-Deck type="work">
            @foreach ($works as $work)
                <x-Card :data=$work :info="['work', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $works->appends(request()->input())->links() }}
    @else
        <p>Nemáme žádná díla v knihovně</p>
    @endunless
</x-layout>
