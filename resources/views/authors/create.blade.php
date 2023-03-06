<x-Layout heading="Přidat autora">
    <h1 class="text-4xl text-center font-bold mb-5">Přidat autora</h1>
    <div class="flex justify-center">
        <form method="POST" action="/autor" enctype="multipart/form-data" class="w-full max-w-3xl">
            @csrf
            <div class="grid grid-cols-3 sm:grid-cols-8 gap-x-4">
                <div class="mb-3">
                    <label for="create-author-name_prefix" class="block mb-1">Titul</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="name_prefix"
                        id="create-author-name_prefix" placeholder="Sir" value="{{ old('name_prefix') }}"
                        autocomplete="off">
                    @error('name_prefix')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 col-span-2">
                    <label for="create-author-first_name"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Jméno</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="first_name"
                        id="create-author-first_name" placeholder="Arthur" value="{{ old('first_name') }}"
                        autocomplete="off">
                    @error('first_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 col-span-3 sm:col-span-2">
                    <label for="create-author-middle_name" class="block mb-1">Prostřední jména</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="middle_name"
                        id="create-author-middle_name" placeholder="Conan" value="{{ old('middle_name') }}"
                        autocomplete="off">
                    @error('middle_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 col-span-2">
                    <label for="create-author-last_name"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Příjmení</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="last_name"
                        id="create-author-last_name" placeholder="Doyle" value="{{ old('last_name') }}"
                        autocomplete="off">
                    @error('last_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-work-name_suffix" class="block mb-1">Titul</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="name_suffix"
                        id="create-author-name_suffix" placeholder="" value="{{ old('name_suffix') }}"
                        autocomplete="off">
                    @error('name_suffix')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid sm:grid-cols-2 sm:gap-4">
                <div class="mb-3">
                    <label for="create-author-birth_date" class="block mb-1">Datum narození</label>
                    <input type="date" class="p-2 w-full border border-slate-200 rounded-lg" name="birth_date"
                        id="create-author-birth_date" placeholder="22. 05. 1859" value="{{ old('bith_date') }}"
                        autocomplete="off" min="0001-01-01">
                    @error('bith_date')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-author-death_date" class="block mb-1">Datum úmrtí</label>
                    <input type="date" class="p-2 w-full border border-slate-200 rounded-lg" name="death_date"
                        id="create-author-death_date" placeholder="07. 06. 1930" value="{{ old('death_date') }}"
                        autocomplete="off" min="0001-01-01">
                    @error('death_date')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="create-work-description" class="block mb-1">Popis</label>
                <textarea name="description" class="p-2 w-full border border-slate-200 rounded-lg" id="create-work-description"
                    cols="30" rows="10" autocomplete="off">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="create-author-image" class="block mb-1">Obrázek / Fotografie</label>
                <div class="flex gap-4">
                    <input type="file" accept="image/*"
                        class="w-full border border-slate-200 rounded-lg file:font-sans file:border file:border-solid file:border-sky-100 file:bg-sky-200 file:shadow-sm file:px-3 file:py-2 file:mr-2 file:rounded-lg text-slate-500"
                        name="image" id="create-author-image" autocomplete="off"
                        aria-describedby="create-author-image-hint" onchange="preview(this)">
                    <button class="px-3 py-2 bg-yellow-400 hover:bg-amber-400 transition rounded-lg shadow"
                        onclick="empty(event)" title="Vyprázdnit výběr obrázku">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
                <p id="create-author-image-hint" class="text-slate-500 text-sm">Vyberte takový obrázek, aby hlava byla
                    umístěna uprostřed.</p>
                @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center mb-3">
                <div id="create-author-image-preview"
                    class="bg-sky-100 h-20 w-20 bg-cover bg-center rounded-full shadow"
                    style="background-image: url({{ asset('/img/author_profile.svg') }})" title="Náhled obrázku"
                    onclick="$('#create-author-image').click()"></div>
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 bg-yellow-400 hover:bg-amber-400 shadow rounded-lg transition"
                        value="Vytvořit">
                </div>
            </div>
        </form>
    </div>

    <script>
        function preview(file) {
            if (file.files === undefined) {
                $('#create-author-image-preview').css('background-image', 'url(/img/author_profile.svg)');
                return;
            }
            let src = URL.createObjectURL(file.files[0]);
            $('#create-author-image-preview').css('background-image', 'url(' + src + ')');
        }

        function empty(e) {
            e.preventDefault();
            $('#create-author-image').val('');
            preview($('#create-author-image'));
        }
    </script>
</x-Layout>
