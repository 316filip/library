<x-Layout heading="Přidat kategorii">
    <h1 class="text-4xl text-center font-bold mb-5">Přidat kategorii</h1>
    <div class="flex justify-center">
        <form method="POST" action="/kategorie" class="w-full max-w-3xl">
            @csrf
            <div class="mb-3">
                <label for="create-name"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Název</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="name"
                    id="create-name" placeholder="Pro mládež" value="{{ old('name') }}" autocomplete="off">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="create-category-description" class="block mb-1">Popis</label>
                <textarea name="description" class="p-2 w-full border border-slate-200 rounded-lg" id="create-category-description"
                    cols="30" rows="10" autocomplete="off">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
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
</x-Layout>
