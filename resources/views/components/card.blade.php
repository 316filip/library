<div {{ $attributes->merge(['class' => 'relative border border-slate-200 shadow-sm rounded-lg p-4']) }}>
    <h3 class="text-lg">
        {{ $title }}
    </h3>
    <p>
        {{ $subtitle }}
    </p>
    <a href="{{$link}}" class="absolute inset-0 pointer-events-auto"></a>
</div>
