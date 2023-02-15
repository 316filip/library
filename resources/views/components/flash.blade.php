{{-- If there is a flash message to display, this component will do it --}}
@if (session()->has('message'))
    <div id="flash"
        class="fixed w-2/3 sm:w-1/2 md:w-1/3 -top-28 -top-0 left-1/2 transform -translate-x-1/2 mt-5 px-10 py-3 bg-{{ $color_bg }} text-{{ $color_text }} shadow-lg rounded-lg z-40 transition-all">
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
