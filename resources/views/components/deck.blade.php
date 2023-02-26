<div
    class="grid {{ $type == 'book' || $type == 'work' || $type == 'booking' ? 'grid-cols-1 min-[470px]:grid-cols-2' : 'grid-cols-2' }} sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4">
    {{ $slot }}
</div>
