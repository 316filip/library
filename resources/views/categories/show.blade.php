<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">
        {{ $category->name }}
    </h1>
    <x-Manage type="category" :identifier="[$category->id, $category->slug]"></x-Manage>
    <p class="text-center mb-5">{{ $category->description }}</p>
    <x-Deck type="work">
        @foreach ($assignments as $assignment)
            <x-Card :data="$assignment->work" :info="['work', 0, '', '']" />
        @endforeach
    </x-Deck>
    {{ $assignments->appends(request()->input())->links() }}
</x-layout>
