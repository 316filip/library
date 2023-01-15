<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Přidat titul</h1>
    <div class="flex justify-center">
        <form method="POST" action="/titul" class="w-full px-2 max-w-2xl 2xl:max-w-3xl">
            @csrf
            <div class="mb-3">
                <label for="create-work-title"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Název titulu</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="title"
                    id="create-work-title" placeholder="Bible" value="{{ old('title') }}" autocomplete="off">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="create-work-subtitle" class="block mb-1">Podnázev</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="subtitle"
                    id="create-work-subtitle" placeholder="" value="{{ old('subtitle') }}" autocomplete="off">
                @error('subtitle')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <x-Select type="author" :values=$authors></x-Select>
                @error('author')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid sm:grid-cols-2 sm:gap-4">
                <div class="mb-3">
                    <label for="create-work-class"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Literární druh</label>
                    <select name="class" id="create-work-class" class="p-2 w-full border border-slate-200 rounded-lg"
                        autocomplete="off">
                        <option value="" hidden selected>Zvolte druh</option>
                        <option value="lyrika" {{ old('class') == 'lyrika' ? 'selected' : '' }}>Lyrika</option>
                        <option value="epika" {{ old('class') == 'epika' ? 'selected' : '' }}>Epika</option>
                        <option value="drama" {{ old('class') == 'drama' ? 'selected' : '' }}>Drama</option>
                    </select>
                    @error('class')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-work-genre" class="block mb-1">Žánr</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="genre"
                        id="create-work-genre" placeholder="" value="{{ old('genre') }}" autocomplete="off">
                    @error('genre')
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
            <div class="grid sm:grid-cols-3 sm:gap-4">
                <div class="mb-3">
                    <label for="create-work-language"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Jazyk originálu</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="language"
                        id="create-work-language" placeholder="Hebrejština" value="{{ old('language') }}"
                        autocomplete="off">
                    @error('language')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-work-year" class="block mb-1">Rok vzniku</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="year"
                        id="create-work-year" placeholder="" value="{{ old('year') }}" autocomplete="off">
                    @error('year')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-work-number" class="block mb-1">Počet básní/kapitol/dějství</label>
                    <input type="number" class="p-2 w-full border border-slate-200 rounded-lg" name="number"
                        id="create-work-number" placeholder="" min="1" value="{{ old('number') }}"
                        autocomplete="off">
                    @error('number')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 border border-slate-200 bg-yellow-400 hover:bg-amber-400 shadow-sm rounded-lg transition"
                        value="Vytvořit">
                </div>
            </div>
        </form>
    </div>
</x-layout>
