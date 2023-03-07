<div class="relative {{ $classes }}">
    <div class="h-full border border-slate-200 shadow-sm rounded-lg p-4 grid">
        <div>
            <x-Image type="{{ $type }}" :data=$values placement="index" />
            <div>
                {{-- Name / title + subtitle --}}
                <h3 class="text-lg text-center line-clamp-3">
                    {{ $type == 'author' || $type == 'user' ? $values->name : ($type == 'booking' ? $values->book->title : $values->title) }}
                </h3>
                @unless($type == 'author' || $type == 'booking')
                    <p class="line-clamp-4 text-sm text-center text-slate-500 pt-1">
                        {{ $values->subtitle }}
                    </p>
                @endunless
            </div>
        </div>
        @if ($type == 'book')
            {{-- When showing a book, display author & availibility info --}}
            <div class="w-full place-self-end">
                @if ($filter !== 'work')
                    <p class="text-sm text-slate-500 py-1">
                        {{ $values->work->author->name }}
                    </p>
                @endif
                <x-Book :data=$values placement="index" />
            </div>
        @elseif ($type == 'work')
            {{-- When showing a work, display author & number of books --}}
            <div class="w-full place-self-end">
                @if ($filter !== 'author')
                    <p class="text-sm text-slate-500 py-1">
                        {{ $values->author->name }}
                    </p>
                @endif
                <p class="text-slate-500 text-sm">{{ count($values->books) }} vydání v naší knihovně</p>
            </div>
        @elseif ($type == 'booking')
            {{-- When showing a booking, display booking details --}}
            <div
                class="w-full place-self-end flex items-center gap-2 border border-slate rounded-lg p-2 shadow-inner mt-3">
                <div class="basis-full">
                    @if (auth()->user()->librarian)
                        <p class="text-slate-500 text-sm">
                            <i class="fa-regular fa-user"></i> {{ $values->user->name }}
                        </p>
                    @endif
                    <p class="{{ $values->late ? 'text-red-500' : 'text-slate-500' }} text-sm">
                        <i class="fa-regular fa-calendar"></i> {{ $values->until }}
                    </p>
                </div>
                <x-Extend :data=$values placement="index" />
            </div>
        @endif
    </div>

    {{-- Link to the result --}}
    <a href="{{ $link }}" class="absolute inset-0 pointer-events-auto" title="{{ $title }}"></a>

    {{-- For last search result in a row, display 'show more' link --}}
    <div class="{{ $overlay }}">
        <div class="absolute inset-0 rounded-lg flex z-10">
            <div class="flex-auto w-64 rounded-l-lg bg-gradient-to-r from-transparent to-slate-100"></div>
            <div class="flex-auto w-32 rounded-r-lg bg-slate-100"></div>
        </div>
        <a href="?filter={{ $filter }}{{ $query }}{{ $in }}"
            class="absolute inset-0 pointer-events-auto z-10">
            <div class="grid h-full content-center justify-end pr-3">
                <span>Více {{ $filter_text }} <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>
    </div>
</div>
