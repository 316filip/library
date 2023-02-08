<x-layout>
    @unless($author->image === null)
        <div class="flex justify-center mb-3">
            <div class="bg-sky-100 h-52 w-52 bg-cover bg-center rounded-full shadow"
                style="background-image: url({{ asset('/img/' . $author->image) }})"></div>
        </div>
    @endunless
    <h1 class="text-4xl text-center font-bold mb-5">
        {{ $author->name }}
    </h1>
    <x-Manage type="author" identifier="{{ $author->id }}"></x-Manage>
    <x-Details type="author" :data=$author placement="home">Informace o autorovi
    </x-Details>
    <h2 class="text-2xl">Tituly</h2>
    @unless(count($author->works) == 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-5">
            @foreach ($author->works as $work)
                <x-Card :data=$work type="work" number="0" more="0" placement="home" />
            @endforeach
        </div>
    @else
        <p class="mt-5">Nemáme žádné tituly od tohoto autora</p>
    @endunless
</x-layout>
