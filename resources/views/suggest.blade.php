<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Protože jste četli {{ $work->title }}</h1>
    @unless(count($suggestions) == 0)
        <x-Deck type="work">
            @foreach ($suggestions as $suggestion)
                <x-Card :data=$suggestion :info="['work', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $suggestions->appends(request()->input())->links() }}
    @else
        <p>Nemůžeme posoudit, která díla s tímto souvisejí</p>
    @endunless
</x-layout>
