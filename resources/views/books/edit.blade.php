<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Upravit knihu</h1>
    <div class="flex justify-center">
        <form method="POST" action="/kniha/{{ $book->id }}" enctype="multipart/form-data"
            class="w-full max-w-3xl">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="edit-book-title" class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Název
                    knihy</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="title"
                    id="edit-book-title" placeholder="Bible"
                    value="{{ old('title') ?? $book->title }}" autocomplete="off">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edit-book-subtitle" class="block mb-1">Podnázev</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="subtitle"
                    id="edit-book-subtitle" placeholder="Písmo svaté Starého a Nového zákona"
                    value="{{ old('subtitle') ?? $book->subtitle }}" autocomplete="off">
                @error('subtitle')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <x-Select type="work" target="{{ $book->work_id }}" :values=$works></x-Select>
                @error('work_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edit-book-description" class="block mb-1">Popis</label>
                <textarea name="description" class="p-2 w-full border border-slate-200 rounded-lg" id="edit-book-description"
                    cols="30" rows="10" autocomplete="off">{{ old('description') ?? $book->description }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid sm:grid-cols-2 sm:gap-x-4">
                <div class="mb-3">
                    <label for="edit-work-language"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Jazyk</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="language"
                        id="edit-work-language" placeholder="Čeština (Český ekumenický překlad)"
                        value="{{ old('language') ?? $book->language }}" autocomplete="off">
                    @error('language')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-translator" class="block mb-1">Překladatel</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="translator"
                        id="edit-book-translator" placeholder=""
                        value="{{ old('translator') ?? $book->translator }}"
                        autocomplete="off">
                    @error('translator')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-illustrator" class="block mb-1">Ilustrátor</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="illustrator"
                        id="edit-book-illustrator" placeholder=""
                        value="{{ old('illustrator') ?? $book->illustrator }}"
                        autocomplete="off">
                    @error('illustrator')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-length"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Počet stran</label>
                    <input type="number" class="p-2 w-full border border-slate-200 rounded-lg" name="length"
                        id="edit-book-length" placeholder="1387" min="1"
                        value="{{ old('length') ?? $book->length }}" autocomplete="off">
                    @error('length')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-house"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Nakladatelství</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="house"
                        id="edit-book-house" placeholder="Česká biblická společnost"
                        value="{{ old('house') ?? $book->house }}" autocomplete="off">
                    @error('house')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-year"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Rok vydání</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="year"
                        id="edit-book-year" placeholder="2016"
                        value="{{ old('year') ?? $book->year }}" autocomplete="off">
                    @error('year')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-place" class="block mb-1">Místo vydání</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="place"
                        id="edit-book-place" placeholder="Praha"
                        value="{{ old('place') ?? $book->place }}" autocomplete="off">
                    @error('place')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-publication" class="block mb-1">Číslo publikace</label>
                    <input type="number" class="p-2 w-full border border-slate-200 rounded-lg" name="publication"
                        id="edit-book-publication" placeholder="22" min="1"
                        value="{{ old('publication') ?? $book->publication }}"
                        autocomplete="off">
                    @error('publication')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-ISBN" class="block mb-1">ISBN</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="ISBN"
                        id="edit-book-ISBN" placeholder="978-80-7545-028-9"
                        value="{{ old('ISBN') ?? $book->ISBN }}" autocomplete="off">
                    @error('ISBN')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-book-amount"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Počet knih</label>
                    <input type="number" class="p-2 w-full border border-slate-200 rounded-lg" name="amount"
                        id="edit-book-amount" placeholder="1" min="1"
                        value="{{ old('amount') ?? $book->amount }}" autocomplete="off">
                    @error('amount')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="edit-book-image" class="block mb-1">Obrázek přebalu</label>
                <div class="flex gap-4">
                    <input type="file" accept="image/*"
                        class="w-full border border-slate-200 rounded-lg file:font-sans file:border file:border-solid file:border-sky-100 file:bg-sky-200 file:shadow-sm file:px-3 file:py-2 file:mr-2 file:rounded-lg text-slate-500"
                        name="image" id="edit-book-image" autocomplete="off" onchange="preview(this)">
                    <button class="px-3 py-2 bg-yellow-400 rounded-lg shadow" onclick="empty(event)"
                        title="Vyprázdnit výběr obrázku">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="image_update" id="edit-book-image_update" value="0"
                autocomplete="off">
            <div class="flex justify-center mb-3">
                <img id="edit-book-image-preview" class="max-h-40 drop-shadow"
                    src="{{ asset('/img/' . ($book->image === null ? 'book_cover.svg' : $book->image)) }}"
                    alt="Náhled přebalu" title="Náhled přebalu" onclick="$('#edit-book-image').click()">
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 bg-yellow-400 hover:bg-amber-400 shadow rounded-lg transition"
                        value="Uložit změny">
                </div>
            </div>
        </form>
    </div>

    <script>
        function preview(file) {
            $('#edit-book-image_update').val(1);
            if (file.files === undefined) {
                $('#edit-book-image-preview').attr('src', '{{ asset('/img/book_cover.svg') }}');
                return;
            }
            let src = URL.createObjectURL(file.files[0]);
            $('#edit-book-image-preview').attr('src', src);
        }

        function empty(e) {
            e.preventDefault();
            $('#edit-book-image_update').val(1);
            $('#edit-book-image').val('');
            preview($('#edit-book-image'));
        }
    </script>
</x-layout>
