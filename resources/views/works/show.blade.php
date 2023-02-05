<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">{{ $work->title }}</h1>
    <p class="text-center text-xl mb-5">{{ $work->subtitle }}</p>
    <x-Manage type="work" identifier="{{ $work->id }}"></x-Manage>
    <x-Details type="work" :data=$work placement="home">Informace o díle</x-Details>
    <h2 class="text-2xl mb-5">Vydání</h2>
    @unless(count($work->books) == 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @foreach ($work->books as $book)
                <x-Card :data=$book type="book" number="0" more="0" />
            @endforeach
        </div>
    @else
        <p>Nemáme žádná vydání</p>
    @endunless
</x-layout>
