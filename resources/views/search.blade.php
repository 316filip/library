<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Výsledky hledání</h1>
    <div class="flex mb-5">
        <div class="flex-1">
            <p class="text-center"><a
                    class="{{ request('in') == 'all' ? 'px-5 py-2 bg-sky-100 rounded-md shadow-sm' : '' }}"
                    href="?query={{ request('query') }}&in=all&page=1">Vše</a></p>
        </div>
        <div class="flex-1">
            <p class="text-center"><a
                    class="{{ request('in') == 'author' ? 'px-5 py-2 bg-sky-100 rounded-md shadow-sm' : '' }}"
                    href="?query={{ request('query') }}&in=author&page=1">Autoři</a></p>
        </div>
        <div class="flex-1">
            <p class="text-center"><a
                    class="{{ request('in') == 'work' ? 'px-5 py-2 bg-sky-100 rounded-md shadow-sm' : '' }}"
                    href="?query={{ request('query') }}&in=work&page=1">Díla</a></p>
        </div>
        <div class="flex-1">
            <p class="text-center"><a
                    class="{{ request('in') == 'book' ? 'px-5 py-2 bg-sky-100 rounded-md shadow-sm' : '' }}"
                    href="?query={{ request('query') }}&in=book&page=1">Knihy</a></p>
        </div>
    </div>
    {{-- If all results are shown --}}
    @if (request('in') == 'all')
        @unless(count($results['author']) == 0)
            <h2 class="text-2xl">Autoři</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 py-3">
                @foreach ($results['author'] as $author)
                    <x-Card type="author" :data=$author number="{{ $loop->index }}" more="1" />
                @endforeach
            </div>
        @endunless
        @unless(count($results['work']) == 0)
            <h2 class="text-2xl">Díla</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 py-3">
                @foreach ($results['work'] as $work)
                    <x-Card type="work" :data=$work number="{{ $loop->index }}" more="1" />
                @endforeach
            </div>
        @endunless
        @unless(count($results['book']) == 0)
            <h2 class="text-2xl">Knihy</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 py-3">
                @foreach ($results['book'] as $book)
                    <x-Card type="book" :data=$book number="{{ $loop->index }}" more="1" />
                @endforeach
            </div>
        @endunless
        @if (count($results['author']) == 0 && count($results['work']) == 0 && count($results['book']) == 0)
            <p class="text-center">Nebyly nalezeny žádné výsledky</p>
        @endif
    @elseif (request('in') == 'author')
        @if (count($results['author']) == 0)
            <p class="text-center">Nebyli nalezeni žádní autoři</p>
        @endif
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 pb-3">
            @foreach ($results['author'] as $author)
                <x-Card :data=$author type="author" number="0" more="0" />
            @endforeach
        </div>
        {{ $results['author']->appends(request()->input())->links() }}
    @elseif (request('in') == 'work')
        @if (count($results['work']) == 0)
            <p class="text-center">Nebyla nalezena žádná díla</p>
        @endif
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 pb-3">
            @foreach ($results['work'] as $work)
                <x-Card :data=$work type="work" number="0" more="0" />
            @endforeach
        </div>
        {{ $results['work']->appends(request()->input())->links() }}
    @elseif (request('in') == 'book')
        @if (count($results['book']) == 0)
            <p class="text-center">Nebyly nalezeny žádné knihy</p>
        @endif
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 pb-3">
            @foreach ($results['book'] as $book)
                <x-Card :data=$book type="book" number="0" more="0" />
            @endforeach
        </div>
        {{ $results['book']->appends(request()->input())->links() }}
    @endif
</x-layout>
