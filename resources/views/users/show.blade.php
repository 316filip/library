<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">
        {{ $user->name }}
    </h1>
    <x-Manage type="user" :identifier="[$user->code, $user->id]"></x-Manage>
    <div>
        <x-Details type="user" :data=$user placement="home">Informace o uživateli</x-Details>
    </div>
    <a id="bookings"></a>
    <h2 class="text-2xl mb-5">Rezervace</h2>
    @unless(count($user->bookings) == 0)
        @php
            $bookings = $user->bookings->paginate(12);
        @endphp
        <x-Deck type="book">
            @foreach ($bookings as $booking)
                <x-Card :data=$booking :info="['booking', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $bookings->links() }}
    @else
        <p class="text-slate-500">Žádné rezervace k zobrazení...</p>
    @endunless

    <script>
        @unless(request('page') == null)
            window.location = "#bookings";
        @endunless
    </script>
</x-layout>
