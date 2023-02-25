<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">
        {{ $category->name }}
    </h1>
    <p class="text-center mb-5">{{ $category->description }}</p>
    <x-Manage type="category" :identifier="[$category->id, $category->slug]"></x-Manage>
    <x-Deck type="work">
        @foreach ($assignments as $assignment)
            <x-Card type="work" :data="$assignment->work" number="0" more="0" placement="away" />
        @endforeach
    </x-Deck>
    {{ $assignments->appends(request()->input())->links() }}
</x-layout>
