<div class="relative border border-slate-200 shadow-sm rounded-lg p-4{{ $classes }}">
    <h3 class="text-lg">
        {{ $title }}
    </h3>
    <p>
        {{ $subtitle }}
    </p>
    <a href="{{ $link }}" class="absolute inset-0 pointer-events-auto"></a>
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
