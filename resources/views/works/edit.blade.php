<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Upravit titul</h1>
    <div class="flex justify-center">
        <form method="POST" action="/titul/{{ $work->id }}" class="w-full max-w-3xl">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="edit-work-title"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Název titulu</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="title"
                    id="edit-work-title" placeholder="Bible"
                    value="{{ old('title') ?? $work->title }}" autocomplete="off">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edit-work-subtitle" class="block mb-1">Podnázev</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="subtitle"
                    id="edit-work-subtitle" placeholder=""
                    value="{{ old('subtitle') ?? $work->subtitle }}" autocomplete="off">
                @error('subtitle')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edit-work-original_title" class="block mb-1">Originální název</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="original_title"
                    id="edit-work-original_title" placeholder="τὰ βιβλíα"
                    value="{{ old('original_title') ?? $work->original_title }}"
                    autocomplete="off">
                @error('original_title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <x-Select type="author" target="{{ $work->author_id }}" :values=$authors identifier=""></x-Select>
                @error('author_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid sm:grid-cols-2 sm:gap-4">
                <div class="mb-3">
                    <label for="edit-work-class"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Literární druh</label>
                    <select name="class" id="edit-work-class" class="p-2 w-full border border-slate-200 rounded-lg"
                        autocomplete="off">
                        <option value="" hidden selected>Zvolte druh</option>
                        <option value="lyrika" {{ (old('class') ?? $work->class) == 'lyrika' ? 'selected' : '' }}>
                            Lyrika
                        </option>
                        <option value="epika" {{ (old('class') ?? $work->class) == 'epika' ? 'selected' : '' }}>Epika
                        </option>
                        <option value="drama" {{ (old('class') ?? $work->class) == 'drama' ? 'selected' : '' }}>Drama
                        </option>
                    </select>
                    @error('class')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-work-genre" class="block mb-1">Žánr</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="genre"
                        id="edit-work-genre" placeholder=""
                        value="{{ old('genre') ?? $work->genre }}" autocomplete="off">
                    @error('genre')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="edit-work-description" class="block mb-1">Popis</label>
                <textarea name="description" class="p-2 w-full border border-slate-200 rounded-lg" id="edit-work-description"
                    cols="30" rows="10" autocomplete="off">{{ old('description') ?? $work->description }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid sm:grid-cols-3 sm:gap-4">
                <div class="mb-3">
                    <label for="edit-work-language"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Jazyk originálu</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="language"
                        id="edit-work-language" placeholder="Hebrejština"
                        value="{{ old('language') ?? $work->language }}" autocomplete="off">
                    @error('language')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-work-year" class="block mb-1">Rok vzniku</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="year"
                        id="edit-work-year" placeholder=""
                        value="{{ old('year') ?? $work->year }}" autocomplete="off">
                    @error('year')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-work-number" class="block mb-1">Počet básní/kapitol/dějství</label>
                    <input type="number" class="p-2 w-full border border-slate-200 rounded-lg" name="number"
                        id="edit-work-number" placeholder="" min="1"
                        value="{{ old('number') ?? $work->number }}" autocomplete="off">
                    @error('number')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
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
</x-layout>
