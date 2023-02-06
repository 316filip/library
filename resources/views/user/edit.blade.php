<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Úpravy účtu</h1>
    <h2 class="text-2xl text-center font-bold my-3">Změna údajů</h2>
    <div class="flex justify-center">
        <form method="POST" action="/ucet/{{ $user->id }}" class="w-full px-2 max-w-2xl 2xl:max-w-3xl">
            @csrf
            @method('PUT')
            <input type="hidden" name="type" value="data">
            <div class="grid sm:grid-cols-2 gap-x-4">
                <div class="mb-3">
                    <label for="edit-user-first_name"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Jméno</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="first_name"
                        id="edit-user-first_name" placeholder="Jan" value="{{ old('first_name') ?? $user->first_name }}"
                        autocomplete="given-name">
                    @error('first_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="edit-user-last_name"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Příjmení</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="last_name"
                        id="edit-user-last_name" placeholder="Srna" value="{{ old('last_name') ?? $user->last_name }}"
                        autocomplete="family-name">
                    @error('last_name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="edit-user-email"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Email</label>
                <input type="email" class="p-2 w-full border border-slate-200 rounded-lg" name="email"
                    id="edit-user-email" placeholder="jan.srna@email.cz" value="{{ old('email') ?? $user->email }}"
                    autocomplete="email">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 border border-slate-200 bg-yellow-400 hover:bg-amber-400 shadow-sm rounded-lg transition"
                        value="Aktualizovat údaje">
                </div>
            </div>
        </form>
    </div>
    <h2 class="text-2xl text-center font-bold my-3">Změna hesla</h2>
    <div class="flex justify-center">
        <form method="POST" action="/ucet/{{ $user->id }}" class="w-full px-2 max-w-2xl 2xl:max-w-3xl">
            @csrf
            @method('PUT')
            <input type="hidden" name="type" value="password">
            <div class="mb-3">
                <label for="edit-user-password_old"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Heslo</label>
                <input type="password" class="p-2 w-full border border-slate-200 rounded-lg" name="password_old"
                    id="edit-user-password_old" placeholder="" value="{{ old('password_old') }}"
                    autocomplete="current-password">
                @error('password_old')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edit-user-password"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Heslo</label>
                <input type="password" class="p-2 w-full border border-slate-200 rounded-lg" name="password"
                    id="edit-user-password" placeholder="" value="{{ old('password') }}" autocomplete="new-password">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edit-user-password_confirmation"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Znovu heslo</label>
                <input type="password" class="p-2 w-full border border-slate-200 rounded-lg"
                    name="password_confirmation" id="edit-user-password_confirmation" placeholder=""
                    value="{{ old('password_confirmation') }}" autocomplete="new-password">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 border border-slate-200 bg-yellow-400 hover:bg-amber-400 shadow-sm rounded-lg transition"
                        value="Změnit heslo">
                </div>
            </div>
        </form>
    </div>
    @admin
        <h2 class="text-2xl text-center font-bold my-3">Změna oprávnění</h2>
        <div class="flex justify-center">
            <form method="POST" action="/ucet/{{ $user->id }}" class="w-full px-2 max-w-2xl 2xl:max-w-3xl">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="competency">
                <div class="mb-3">
                    <div class="flex justify-center">
                        <div class="mb-1">
                            <input type="checkbox" class="p-2 mb-0.5 mr-1 border border-slate-200 rounded-lg"
                                name="admin" id="edit-user-admin" placeholder="" value="1"
                                {{ (old('admin') ?? $user->admin) == 1 ? 'checked' : '' }} autocomplete="off">
                            <label for="edit-user-admin" class="inline">Knihovník</label>
                        </div>
                    </div>
                    @error('admin')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-center">
                    <div class="mb-3">
                        <input type="submit"
                            class="px-3 py-2 border border-slate-200 bg-yellow-400 hover:bg-amber-400 shadow-sm rounded-lg transition"
                            value="Použít oprávnění">
                    </div>
                </div>
            </form>
        </div>
    @endadmin
</x-layout>
