<div class="relative {{ $classes }}">
    <div class="h-full border border-slate-200 shadow-sm rounded-lg p-4 grid place-content-between">
        <div>
            <h3 class="text-lg line-clamp-3">
                {{ $type == 'author' ? $values->name : $values->title }}
            </h3>
            <p class="line-clamp-4">
                {{ $type == 'author' ? '' : $values->subtitle }}
            </p>
        </div>
        @if ($type == 'book')
            <div>
                <p>{{ count($values->bookings) }} rezervace</p>
                @if (count($values->bookings) !== 0 && substr($values->bookings->last()->to, 0, 10) > date('Y-m-d'))
                    <p class="text-red-600">Dostupné od
                        {{ date('d. m. Y', strtotime($values->bookings->last()->to)) }}
                    </p>
                @else
                    <p class="text-lime-600">Dostupné právě teď</p>
                @endif
            </div>
        @endif
    </div>
    <a href="{{ $link }}" class="absolute inset-0 pointer-events-auto" title="{{ $title }}"></a>
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
