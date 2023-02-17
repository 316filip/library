<form class="z-10 {{ $booking->extendable === 'hide' ? 'hidden' : '' }}" action="/rezervace/{{ $booking->id }}"
    method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="type" value="extend">
    <button
        class="px-3 py-2 shadow {{ $booking->extendable === true ? 'bg-sky-100 hover:bg-sky-200' : 'bg-slate-200' }} rounded-lg transition"
        title="Prodloužit rezervaci o měsíc" {{ $booking->extendable === true ? '' : 'disabled' }}>
        @if ($placement == 'show')
            Prodloužit
        @else
            <i class="fa-regular fa-clock"></i>
        @endif
    </button>
</form>
