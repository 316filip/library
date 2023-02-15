@if ($type == 'book' && ($values->image !== null || $placement == 'index'))
    {{-- When showing a book, display cover image --}}
    <div class="flex justify-center mb-1 mx-4 relative">
        @if ($values->image !== null)
            <img src="{{ asset('/img/' . $values->image) }}" alt="Obrázek přebalu"
                class="{{ $placement == 'index' ? 'max-h-28' : 'max-h-52' }} shadow">
        @else
            <img src="{{ asset('/img/book_cover.svg') }}" alt="Ukázkový obrázek přebalu" class="max-h-28 drop-shadow">
        @endif
    </div>
@elseif ($type == 'work')
    {{-- When showing a work, display three cover images --}}
    <div class="flex justify-center mb-1 mx-4 h-28 relative">
        @for ($i = 0; $i < 3; $i++)
            @php
                // Different classes for first, second and third image
                $position = $i == 0 ? 'bottom-0 ml-8' : '';
                $position = $i == 1 ? '-z-10 bottom-4' : $position;
                $position = $i == 2 ? '-z-20 bottom-8 mr-8' : $position;
            @endphp

            @if (isset($values->books[$i]))
                {{-- If there is a book with this index --}}
                @if ($values->books[$i]->image !== null)
                    {{-- If the book has a cover picture --}}
                    <img src="{{ asset('/img/' . $values->books[$i]->image) }}" alt="Obrázek přebalu"
                        class="max-h-20 {{ $position }} shadow absolute">
                @else
                    {{-- If there is no cover picture --}}
                    <img src="{{ asset('/img/book_cover.svg') }}" alt="Ukázkový obrázek přebalu"
                        class="max-h-20 {{ $position }} drop-shadow absolute">
                @endif
            @else
                {{-- If there is no book with this index --}}
                <div
                    class="h-20 w-14 bg-sky-100 border border-slate-200 {{ $position }} shadow rounded-sm absolute">
                </div>
            @endif
        @endfor
    </div>
@elseif ($type == 'author' && ($values->image !== null || $placement == 'index'))
    {{-- When showing an author, display a profile picture --}}
    <div class="flex justify-center mb-1 mx-4 {{ $placement == 'index' ? 'h-28' : 'h-52' }} relative">
        @if ($values->image === null)
            <div class="absolute h-28 w-28 bg-sky-100 bg-cover bg-center rounded-full border border-slate-200 shadow"
                style="background-image: url({{ asset('/img/author_profile.svg') }})"></div>
        @else
            <div class="absolute {{ $placement == 'index' ? 'h-28 w-28' : 'h-52 w-52' }} bg-sky-100 bg-cover bg-center rounded-full border border-slate-200 shadow"
                style="background-image: url({{ asset('/img/' . $values->image) }})"></div>
        @endif
    </div>
@elseif ($type == 'user' && ($values->image !== null || $placement == 'index'))
    {{-- When showing an user, display a profile picture --}}
    <div class="flex justify-center mb-1 mx-4 h-28 relative">
        <div class="absolute h-28 w-28 bg-sky-100 bg-cover bg-center rounded-full border border-slate-200 shadow"
            style="background-image: url({{ asset('/img/user_profile.svg') }})"></div>
    </div>
@elseif ($type == 'booking' && ($values->book->image !== null || $placement == 'index'))
    {{-- When showing a booking, display cover image --}}
    <div class="flex justify-center mb-1 mx-4 relative">
        @if ($values->book->image !== null)
            <img src="{{ asset('/img/' . $values->book->image) }}" alt="Obrázek přebalu"
                class="{{ $placement == 'index' ? 'max-h-28' : 'max-h-52' }} shadow">
        @else
            <img src="{{ asset('/img/book_cover.svg') }}" alt="Ukázkový obrázek přebalu" class="max-h-28 drop-shadow">
        @endif
    </div>
@endif
