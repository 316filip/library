<div
    class="grid {{ $type == 'book' || $type == 'work' ? 'grid-cols-1 min-[400px]:grid-cols-2' : 'grid-cols-2' }} sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
    {{ $slot }}
</div>
