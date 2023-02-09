<x-layout>
    <x-Image type="book" :data=$book placement="show" />
    <h1 class="text-4xl text-center font-bold mb-5">{{ $book->title }}</h1>
    <p class="text-center text-xl mb-5">{{ $book->subtitle }}</p>
    <x-Manage type="book" identifier="{{ $book->id }}"></x-Manage>
    <x-Book :data=$book placement="show" />
    <div>
        <x-Details type="work" :data='$book->work' placement="away">Informace o díle
        </x-Details>
        <x-Details type="book" :data=$book placement="home">Informace o knize</x-Details>
    </div>
</x-layout>
