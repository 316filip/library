<div class="relative {{ $classes }}">
    <div class="h-full border border-slate-200 shadow-sm rounded-lg p-4 grid">
        <div>
            <div
                class="flex justify-center {{ $type == 'user' ? '' : 'mb-1' }} mx-4{{ $type == 'work' || $type == 'author' ? ' h-28' : '' }} relative">
                @if ($type == 'book')
                    {{-- When showing a book, display cover image --}}
                    @if ($values->image !== null)
                        <img src="{{ asset('/img/' . $values->image) }}" alt="Obrázek přebalu" class="max-h-28 shadow">
                    @else
                        <img src="{{ asset('/img/book_cover.svg') }}" alt="Ukázkový obrázek přebalu"
                            class="max-h-28 drop-shadow">
                    @endif
                @elseif ($type == 'work')
                    {{-- When showing a work, display three cover images --}}
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
                @elseif ($type == 'author')
                    {{-- When showing an author, display a profile picture --}}
                    @if ($values->image === null)
                        <div class="absolute h-28 w-28 bg-sky-100 bg-cover bg-center rounded-full border border-slate-200 shadow"
                            style="background-image: url({{ asset('/img/author_profile.svg') }})"></div>
                    @else
                        <div class="absolute h-28 w-28 bg-sky-100 bg-cover bg-center rounded-full border border-slate-200 shadow"
                            style="background-image: url({{ asset('/img/' . $values->image) }})"></div>
                    @endif
                @endif
            </div>
            <div>
                {{-- Name / title + subtitle --}}
                <h3 class="text-lg line-clamp-3">
                    {{ $type == 'author' || $type == 'user' ? $values->name : $values->title }}
                </h3>
                @unless($type == 'author')
                    <p class="line-clamp-4">
                        {{ $values->subtitle }}
                    </p>
                @endunless
            </div>
        </div>
        @if ($type == 'book')
            {{-- When showing a book, display availibility info --}}
            <div class="w-full pt-3 place-self-end">
                <hr class="mb-1">
                <p>
                    {{ $values->work->author->name }}
                </p>
                @auth
                    <p class="text-slate-500 text-sm">{{ count($values->bookings) }} rezervace</p>
                @endauth
                @if ($values->date === true)
                    <p class="text-lime-600 text-sm">Dostupné právě teď</p>
                @elseif ($values->date === false)
                    <p class="text-red-600 text-sm">Momentálně nedostupné</p>
                @else
                    <p class="text-amber-500 text-sm">Dostupné od
                        {{ date('d. m. Y', strtotime($values->date)) }}
                    </p>
                @endif
            </div>
        @elseif ($type == 'work')
            {{-- When showing a work, display number of books --}}
            <div class="w-full pt-3 place-self-end">
                <hr class="mb-1">
                <p>
                    {{ $values->author->name }}
                </p>
                <p class="text-slate-500 text-sm">{{ count($values->books) }} vydání v naší knihovně</p>
            </div>
        @endif
    </div>

    {{-- Link to the result --}}
    <a href="{{ $link }}" class="absolute inset-0 pointer-events-auto" title="{{ $title }}"></a>

    {{-- For last search result in a row, display 'show more' link --}}
    <div class="{{ $overlay }}">
        <div class="absolute inset-0 rounded-lg flex">
            <div class="flex-auto w-32 rounded-l-lg bg-gradient-to-r from-transparent to-slate-100"></div>
            <div class="flex-auto w-64 rounded-r-lg bg-slate-100"></div>
        </div>
        <a href="?query={{ request('query') }}&in={{ $filter }}" class="absolute inset-0 pointer-events-auto">
            <div class="grid h-full content-center justify-end pr-3">
                <span>Více {{ $filter_text }} <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>
    </div>
</div>
