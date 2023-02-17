<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Rezervace #{{ $booking->code }}</h1>
    <div class="flex justify-center mb-5">
        <div class="flex gap-3 items-center">
            <p class="inline {{ $booking->late ? 'text-red-500' : '' }}">{{ $booking->until }}</p>
            <x-Extend :data=$booking placement="show" />
        </div>
    </div>
    <div class="grid grid-cols-5 lg:grid-cols-12">
        <div class="border border-slate-200 rounded-lg px-5 pt-5 text-center col-span-5">
            <x-Image type="user" :data="$booking->user" placement="index" />
            <x-Details type="user" :data="$booking->user" placement="away">{{ $booking->user->name }}</x-Details>
        </div>
        <div class="col-span-5 lg:col-span-2 grid grid-col-1 p-1">
            <div class="flex justify-center items-center">
                <form action="/rezervace/{{ $booking->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="manage">
                    <select class="w-full rounded-lg border-none shadow bg-yellow-400 py-2" name="status"
                        id="edit-booking-status" autocomplete="off" onchange="$(this).parent().submit()">
                        <option value="booked" {{ !$booking->borrowed && !$booking->returned ? 'selected' : '' }}>
                            Rezervováno</option>
                        <option value="borrowed" {{ $booking->borrowed && !$booking->returned ? 'selected' : '' }}>
                            Půjčeno
                        </option>
                        <option value="returned" {{ $booking->returned ? 'selected' : '' }}>Vyřízeno</option>
                    </select>
                    @error('status')
                        <p class="text-center text-red-500 text-sm mt-3">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
        <div class="border border-slate-200 rounded-lg px-5 pt-5 text-center col-span-5">
            <x-Image type="book" :data="$booking->book" placement="index" />
            <x-Details type="book" :data="$booking->book" placement="away">{{ $booking->book->title }}</x-Details>
        </div>
    </div>
</x-layout>
