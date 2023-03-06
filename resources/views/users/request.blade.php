<x-Layout heading="Reset hesla">
    <h1 class="text-4xl text-center font-bold mb-5">Reset hesla</h1>
    <div class="flex justify-center">
        <form method="POST" action="/reset" class="w-full max-w-3xl">
            @csrf
            <div class="mb-3">
                <label for="reset-pwd-email"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Email</label>
                <input type="email" class="p-2 w-full border border-slate-200 rounded-lg" name="email"
                    id="reset-pwd-email" placeholder="jan.srna@email.cz" value="{{ old('email') }}"
                    autocomplete="email">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 bg-yellow-400 hover:bg-amber-400 shadow rounded-lg transition"
                        value="Resetovat heslo">
                </div>
            </div>
        </form>
    </div>
    <p class="text-center">Vzpomněli jste si? <a href="/prihlaseni" class="text-yellow-500">Přihlašte se!</a></p>
</x-Layout>
