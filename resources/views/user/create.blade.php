<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Registrace</h1>
    <div class="flex justify-center">
        <form method="POST" action="/ucet" class="w-full px-2 max-w-2xl 2xl:max-w-3xl">
            @csrf
            <div class="grid sm:grid-cols-2 gap-x-4">
                <div class="mb-3">
                    <label for="create-user-first_name"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Jméno</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="first_name"
                        id="create-user-first_name" placeholder="Jan" value="{{ old('first_name') }}"
                        autocomplete="given-name">
                    @error('first_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-user-last_name"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Příjmení</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="last_name"
                        id="create-user-last_name" placeholder="Srna" value="{{ old('last_name') }}"
                        autocomplete="family-name">
                    @error('last_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 col-span-2">
                <label for="create-user-email"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Email</label>
                <input type="email" class="p-2 w-full border border-slate-200 rounded-lg" name="email"
                    id="create-user-email" placeholder="jan.srna@email.cz" value="{{ old('email') }}"
                    autocomplete="email">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 col-span-3 sm:col-span-2">
                <label for="create-user-password"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Heslo</label>
                <input type="password" class="p-2 w-full border border-slate-200 rounded-lg" name="password"
                    id="create-user-password" placeholder="" value="{{ old('password') }}" autocomplete="new-password">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 col-span-2">
                <label for="create-user-password_confirmation"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Znovu heslo</label>
                <input type="password" class="p-2 w-full border border-slate-200 rounded-lg"
                    name="password_confirmation" id="create-user-password_confirmation" placeholder=""
                    value="{{ old('password_confirmation') }}" autocomplete="new-password">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 border border-slate-200 bg-yellow-400 hover:bg-amber-400 shadow-sm rounded-lg transition"
                        value="Vytvořit účet">
                </div>
            </div>
        </form>
    </div>
    <p class="text-center">Už máte účet? <a href="/prihlaseni" class="text-yellow-500">Přihlašte se!</a></p>
</x-layout>
