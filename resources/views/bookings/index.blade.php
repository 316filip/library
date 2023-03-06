<x-Layout heading="Aktivní rezervace">
    <h1 class="text-4xl text-center font-bold mb-5">Aktivní rezervace</h1>
    @unless(count($bookings) == 0)
        <x-Deck type="booking">
            @foreach ($bookings as $booking)
                <x-Card :data=$booking :info="['booking', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $bookings->appends(request()->input())->links() }}
    @else
        <p>V tuto chvíli nemá nikdo vypůjčenu žádnou knihu</p>
    @endunless
</x-Layout>
