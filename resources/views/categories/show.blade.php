<x-Layout heading="Kategorie {{ $category->name }}">
    <h1 class="text-4xl text-center font-bold mb-5">
        {{ $category->name }}
    </h1>
    @lib
        <x-Manage type="category" :identifier="[$category->id, $category->slug]"></x-Manage>
    @endlib
    <p class="text-center mb-5">{{ $category->description }}</p>
    <x-Deck type="work">
        @foreach ($assignments as $assignment)
            <x-Card :data="$assignment->work" :info="['work', 0, '', '']" />
        @endforeach
    </x-Deck>
    {{ $assignments->appends(request()->input())->links() }}
    @if (count($assignments) == 0)
        <p class="text-center mb-5 text-slate-500">Žádný titul nemá tuto kategorii...</p>
    @endif
</x-Layout>
