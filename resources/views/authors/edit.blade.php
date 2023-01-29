<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Upravit autora</h1>
    <div class="flex justify-center">
        <form method="POST" action="/autor/{{ $author->id }}" enctype="multipart/form-data"
            class="w-full px-2 max-w-2xl 2xl:max-w-3xl">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-3 sm:grid-cols-8 gap-x-4">
                <div class="mb-3">
                    <label for="edit-author-name_prefix" class="block mb-1">Titul</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="name_prefix"
                        id="edit-author-name_prefix"
                        value="{{ old('name_prefix') == '' ? $author->name_prefix : old('name_prefix') }}"
                        autocomplete="off">
                    @error('name_prefix')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 col-span-2">
                    <label for="edit-author-first_name"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Jméno</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="first_name"
                        id="edit-author-first_name"
                        value="{{ old('first_name') == '' ? $author->first_name : old('first_name') }}"
                        autocomplete="off">
                    @error('first_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 col-span-3 sm:col-span-2">
                    <label for="edit-author-middle_name" class="block mb-1">Prostřední jména</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="middle_name"
                        id="edit-author-middle_names"
                        value="{{ old('middle_name') == '' ? $author->middle_name : old('middle_name') }}"
                        autocomplete="off">
                    @error('middle_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 col-span-2">
                    <label for="edit-author-last_name"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Příjmení</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="last_name"
                        id="edit-author-last_name"
                        value="{{ old('last_name') == '' ? $author->last_name : old('last_name') }}" autocomplete="off">
                    @error('last_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-work-name_suffix" class="block mb-1">Titul</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="name_suffix"
                        id="edit-author-name_suffix"
                        value="{{ old('name_suffix') == '' ? $author->name_suffix : old('name_suffix') }}"
                        autocomplete="off">
                    @error('name_suffix')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @php
                $birth_date = old('birth_date') == '' ? $author->birth_date : old('birth_date');
                if ($birth_date !== null) {
                    $birth_date = date('Y-m-d', strtotime($birth_date));
                }
                
                $death_date = old('death_date') == '' ? $author->death_date : old('death_date');
                if ($death_date !== null) {
                    $death_date = date('Y-m-d', strtotime($death_date));
                }
            @endphp
            <div class="grid sm:grid-cols-2 sm:gap-4">
                <div class="mb-3">
                    <label for="edit-author-birth_date" class="block mb-1">Datum narození</label>
                    <input type="date" class="p-2 w-full border border-slate-200 rounded-lg" name="birth_date"
                        id="edit-author-birth_date" value="{{ $birth_date }}" autocomplete="off">
                    @error('bith_date')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-author-death_date" class="block mb-1">Datum úmrtí</label>
                    <input type="date" class="p-2 w-full border border-slate-200 rounded-lg" name="death_date"
                        id="edit-author-death_date" value="{{ $death_date }}" autocomplete="off">
                    @error('death_date')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="edit-work-description" class="block mb-1">Popis</label>
                <textarea name="description" class="p-2 w-full border border-slate-200 rounded-lg" id="edit-work-description"
                    cols="30" rows="10" autocomplete="off">{{ old('description') == '' ? $author->description : old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edit-author-image" class="block mb-1">Obrázek / Fotografie</label>
                <div class="flex gap-4">
                    <input type="file" accept="image/*"
                        class="w-full border border-slate-200 rounded-lg file:font-sans file:border file:border-solid file:border-sky-100 file:bg-sky-200 file:shadow-sm file:px-3 file:py-2 file:mr-2 file:rounded-lg text-slate-500"
                        name="image" id="edit-author-image" autocomplete="off"
                        aria-describedby="edit-author-image-hint" onchange="preview(this)">
                    <button class="px-3 py-2 bg-yellow-400 rounded-lg shadow" onclick="empty(event)"
                        title="Vyprázdnit výběr obrázku">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
                <p id="edit-author-image-hint" class="text-slate-500 text-sm">Vyberte takový obrázek, aby hlava byla
                    umístěna uprostřed.</p>
                @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="image_update" id="edit-author-image_update" value="0" autocomplete="off">
            <div class="flex justify-center mb-3">
                <div id="edit-author-image-preview"
                    class="bg-sky-100 h-20 w-20 bg-cover bg-center rounded-full shadow"
                    style="background-image: url({{ asset('/img/' . ($author->image === null ? 'author_profile.svg' : $author->image)) }})"
                    title="Náhled obrázku">
                </div>
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 border border-slate-200 bg-yellow-400 hover:bg-amber-400 shadow-sm rounded-lg transition"
                        value="Uložit změny">
                </div>
            </div>
        </form>
    </div>

    <script>
        function preview(file) {
            $('#edit-author-image_update').val(1);
            if (file.files === undefined) {
                $('#edit-author-image-preview').css('background-image', 'url(/img/author_profile.svg)');
                return;
            }
            let src = URL.createObjectURL(file.files[0]);
            $('#edit-author-image-preview').css('background-image', 'url(' + src + ')');
        }

        function empty(e) {
            e.preventDefault();
            $('#edit-author-image_update').val(1);
            $('#edit-author-image').val('');
            preview($('#edit-author-image'));
        }
    </script>
</x-layout>
