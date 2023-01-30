<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">{{ $work->title }}</h1>
    <p class="text-center text-xl mb-5">{{ $work->subtitle }}</p>
    <div class="flex gap-3 justify-center mb-5">
        <div class="h-8 w-8">
            <p class="h-full w-full bg-yellow-400 rounded-full text-center">
                <a class="align-middle" href="/titul/{{ $work->id }}/upravit">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>
            </p>
        </div>
        <div class="h-8 w-8">
            <button class="h-full w-full bg-red-500 rounded-full" onclick="openDelete()">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        </div>
    </div>
    <x-Delete id="{{ $work->id }}" type="work"></x-Delete>
    <h2 class="text-2xl mb-5"><a href="javascript:void(0)" onclick="workDetails()">Informace o díle <i
                class="fa-solid fa-caret-right transition rotate-90" id="work-details-toggle"></i></a></h2>
    <div id="work-details-table" class="mb-5">
        <x-Workdetails :work=$work />
    </div>
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
