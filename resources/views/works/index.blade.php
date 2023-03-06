<x-Layout heading="Nejnovější tituly">
    <h1 class="text-4xl text-center font-bold mb-5">Nejnovější tituly</h1>
    @unless(count($works) == 0)
        <x-Deck type="work">
            @foreach ($works as $work)
                <x-Card :data=$work :info="['work', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $works->appends(request()->input())->links() }}
    @else
        <p class="text-center mb-5 text-slate-500">Knihovna je prázdná...</p>
    @endunless
</x-Layout>
