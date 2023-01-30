<x-layout>
    @unless($book->image === null)
        <div class="flex justify-center mb-3">
            <img src="{{ asset('/img/' . $book->image) }}" alt="Obrázek přebalu" class="max-h-52 drop-shadow">
        </div>
    @endunless
    <h1 class="text-4xl text-center font-bold mb-5">{{ $book->title }}</h1>
    <p class="text-center text-xl mb-5">{{ $book->subtitle }}</p>
    <div class="flex gap-3 justify-center mb-5">
        <div class="h-8 w-8">
            <p class="h-full w-full bg-yellow-400 rounded-full text-center">
                <a class="align-middle" href="/kniha/{{ $book->id }}/upravit">
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
    <x-Delete id="{{ $book->id }}" type="book"></x-Delete>
    <div>
        <h2 class="text-2xl mb-5"><a href="javascript:void(0)" onclick="workDetails()">Informace o díle <i
                    class="fa-solid fa-caret-right transition" id="work-details-toggle"></i></a></h2>
        <div id="work-details-table" class="mb-5" style="display: none">
            <x-Workdetails :work='$book->work' />
            <p class="text-right mt-2"><a href="/titul/{{ $book->work->id }}"><i class="fa-solid fa-arrow-right"></i>
                    Přejít na knihu</a>
            </p>
        </div>
    </div>
    <div>
        <h2 class="text-2xl mb-5"><a href="javascript:void(0)" onclick="bookDetails()">Informace o knize <i
                    class="fa-solid fa-caret-right transition rotate-90" id="book-details-toggle"></i></a></h2>
        <div id="book-details-table">
            <table
                class="table-auto w-full border border-slate-200 rounded-md border-separate border-spacing-x-4 border-spacing-y-3 mb-5">
                @unless($book->description == null)
                    <tr>
                        <td class="align-top">Popis:</td>
                        <td class="align-bottom text-justify">{{ $book->description }}</td>
                    </tr>
                @endunless
                <tr>
                    <td class="align-top">Jazyk:</td>
                    <td class="align-bottom">{{ $book->language }}</td>
                </tr>
                @unless($book->translator == null)
                    <tr>
                        <td class="align-top">Překladatel:</td>
                        <td class="align-bottom">{{ $book->translator }}</td>
                    </tr>
                @endunless
                @unless($book->illustrator == null)
                    <tr>
                        <td class="align-top">Ilustrátor:</td>
                        <td class="align-bottom">{{ $book->illustrator }}</td>
                    </tr>
                @endunless
                <tr>
                    <td class="align-top">Rozsah:</td>
                    <td class="align-bottom">{{ $book->length }} stran</td>
                </tr>
                <tr>
                    <td class="align-top">Nakladatelství:</td>
                    <td class="align-bottom">{{ $book->house }}</td>
                </tr>
                <tr>
                    <td class="align-top">Rok vydání:</td>
                    <td class="align-bottom">{{ $book->year }}</td>
                </tr>
                @unless($book->publication == null)
                    <tr>
                        <td class="align-top">Publikace:</td>
                        <td class="align-bottom">{{ $book->publication }}</td>
                    </tr>
                @endunless
                @unless($book->place == null)
                    <tr>
                        <td class="align-top">Místo vydání:</td>
                        <td class="align-bottom">{{ $book->place }}</td>
                    </tr>
                @endunless
                @unless($book->ISBN == null)
                    <tr>
                        <td class="align-top">ISBN:</td>
                        <td class="align-bottom">{{ $book->ISBN }}</td>
                    </tr>
                @endunless
            </table>
        </div>
    </div>

    <script>
        /**
         * Toggles book details table
         */
        function bookDetails() {
            $("#book-details-table").slideToggle();
            $("#book-details-toggle").toggleClass("rotate-90");
        }
    </script>
</x-layout>
