<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">
        {{ $user->name }}
    </h1>
    <x-Manage type="user" :identifier="[$user->code, $user->id]"></x-Manage>
    <div>
        <x-Details type="user" :data=$user placement="home">Informace o uživateli</x-Details>
    </div>
</x-layout>
