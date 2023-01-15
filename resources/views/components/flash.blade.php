{{-- If there is a flash message to display, this component will do it --}}
@if (session()->has('message'))
    @php
        // Define colors based on recieved data
        if (session('color') == 'success') {
            $bg_color = 'bg-sky-400';
            $text_color = 'text-white';
        }
    @endphp

    <div id="flash"
        class="fixed w-1/3 -top-20 -top-0 left-1/2 transform -translate-x-1/2 mt-5 px-10 py-3 {{ $bg_color }} {{ $text_color }} shadow-lg rounded-lg z-40 transition-all">
        <p class="text-center">
            {{ session('message') }}
            @if (session()->has('link'))
                <a href="{{ session('link') }}" class="text-yellow-200 underline">Zobrazit</a>
            @endif
        </p>
    </div>

    <script>
        // Hide the flash message after 6 seconds
        setTimeout(() => {
            $('#flash').removeClass('-top-0');
        }, 6000);
    </script>
@endif
