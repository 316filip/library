<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Přihlášení</h1>
    <div class="flex justify-center">
        <form method="POST" action="/authenticate" class="w-full max-w-3xl">
            @csrf
            <div class="mb-3">
                <label for="create-user-email"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Email</label>
                <input type="email" class="p-2 w-full border border-slate-200 rounded-lg" name="email"
                    id="create-user-email" placeholder="" value="{{ old('email') }}" autocomplete="email">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="create-user-password"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Heslo</label>
                <input type="password" class="p-2 w-full border border-slate-200 rounded-lg" name="password"
                    id="create-user-password" placeholder="" value="{{ old('password') }}"
                    autocomplete="current-password">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <input class="p-2 mb-0.5 mr-1 border border-slate-200 rounded-lg" type="checkbox" name="remember"
                    id="create-user-remember">
                <label for="create-user-remember">Zapamatovat si mě</label>
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 bg-yellow-400 hover:bg-amber-400 shadow rounded-lg transition"
                        value="Přihlásit se">
                </div>
            </div>
        </form>
    </div>
    <p class="text-center">Nemáte účet? <a href="/registrace" class="text-yellow-500">Vytvořte si ho!</a></p>
    <p class="text-center">Zapomenuté heslo? <a href="/reset" class="text-yellow-500">Resetujte ho!</a></p>
</x-layout>
