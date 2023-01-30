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
    <div class="flex gap-3 justify-center mb-5">
        <div class="h-8 w-8">
            <p class="h-full w-full bg-yellow-400 rounded-full text-center">
                <a class="align-middle" href="/autor/{{ $author->id }}/upravit">
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
    <x-Delete id="{{ $author->id }}" type="author"></x-Delete>
    <h2 class="text-2xl mb-5"><a href="javascript:void(0)" onclick="authorDetails()">Informace o autorovi <i
                class="fa-solid fa-caret-right transition rotate-90" id="author-details-toggle"></i></a></h2>
    <div id="author-details-table">
        <table
            class="table-auto w-full border border-slate-200 rounded-md border-separate border-spacing-x-4 border-spacing-y-3 mb-5">
            @unless($author->description == null)
                <tr>
                    <td class="align-top">Popis:</td>
                    <td class="align-bottom text-justify">{{ $author->description }}</td>
                </tr>
            @endunless
            @unless($author->birth_date == null)
                <tr>
                    <td class="align-top">Datum narození:</td>
                    <td class="align-bottom">{{ date('d. m. Y', strtotime($author->birth_date)) }}</td>
                </tr>
            @endunless
            @unless($author->death_date == null)
                <tr>
                    <td class="align-top">Datum úmrtí:</td>
                    <td class="align-bottom">{{ date('d. m. Y', strtotime($author->death_date)) }}</td>
                </tr>
            @endunless
            <tr>
                <td class="align-top">U nás v knihovně:</td>
                @php
                    $amount = count($author->works);
                    if ($amount == 1) {
                        $ending = '';
                    } elseif ($amount >= 2 && $amount <= 4) {
                        $ending = 'y';
                    } else {
                        $ending = 'ů';
                    }
                @endphp
                <td class="align-bottom">{{ $amount }} titul{{ $ending }}</td>
            </tr>
        </table>
    </div>
    <h2 class="text-2xl">Tituly</h2>
    @unless(count($author->works) == 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-5">
            @foreach ($author->works as $work)
                <x-Card :data=$work type="work" number="0" more="0" />
            @endforeach
        </div>
    @else
        <p class="mt-5">Nemáme žádné tituly od tohoto autora</p>
    @endunless

    <script>
        /**
         * Toggles author details table
         */
        function authorDetails() {
            $("#author-details-table").slideToggle();
            $("#author-details-toggle").toggleClass("rotate-90");
        }
    </script>
</x-layout>
