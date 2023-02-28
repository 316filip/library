<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Tvorba nového hesla</h1>
    <div class="flex justify-center">
        <form method="POST" action="/heslo" class="w-full max-w-3xl">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="mb-3">
                <label for="create-user-password"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Heslo</label>
                <input type="password" class="p-2 w-full border border-slate-200 rounded-lg" name="password"
                    id="create-user-password" placeholder="" value="{{ old('password') }}" autocomplete="new-password">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
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
                        class="px-3 py-2 bg-yellow-400 hover:bg-amber-400 shadow rounded-lg transition"
                        value="Aktualizovat heslo">
                </div>
            </div>
        </form>
    </div>
    <p class="text-center">Vzpomněli jste si? <a href="/prihlaseni" class="text-yellow-500">Přihlašte se!</a></p>
</x-layout>
