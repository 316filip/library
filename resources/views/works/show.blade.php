<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">{{ $work->title }}</h1>
    <p class="text-center text-xl">{{ $work->subtitle }}</p>
    <h2 class="text-2xl mb-5"><a href="javascript:void(0)" onclick="workDetails()">Informace o díle <i
                class="fa-solid fa-caret-right transition rotate-90" id="work-details-toggle"></i></a></h2>
    <div id="work-details-table" class="mb-5">
        <x-Workdetails :work=$work />
    </div>
    <h2 class="text-2xl">Vydání</h2>
    @unless(count($work->books) == 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-5">
            @foreach ($work->books as $book)
                <x-Card :data=$book type="book" number="0" />
            @endforeach
        </div>
    @else
        <p class="mt-5">Nemáme žádná vydání</p>
    @endunless
</x-layout>
