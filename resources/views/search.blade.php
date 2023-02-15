<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Výsledky hledání</h1>
    <div class="flex mb-5">
        <div class="flex-1">
            <p class="text-center"><a
                    class="{{ request('in') == 'all' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                    href="?query={{ request('query') }}&in=all&page=1">Vše</a></p>
        </div>
        <div class="flex-1">
            <p class="text-center"><a
                    class="{{ request('in') == 'author' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                    href="?query={{ request('query') }}&in=author&page=1">Autoři</a></p>
        </div>
        <div class="flex-1">
            <p class="text-center"><a
                    class="{{ request('in') == 'work' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                    href="?query={{ request('query') }}&in=work&page=1">Díla</a></p>
        </div>
        <div class="flex-1">
            <p class="text-center"><a
                    class="{{ request('in') == 'book' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                    href="?query={{ request('query') }}&in=book&page=1">Knihy</a></p>
        </div>
        @auth
            <div class="flex-1">
                <p class="text-center"><a
                        class="{{ request('in') == 'user' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                        href="?query={{ request('query') }}&in=user&page=1">Uživatelé</a></p>
            </div>
            <div class="flex-1">
                <p class="text-center"><a
                        class="{{ request('in') == 'booking' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                        href="?query={{ request('query') }}&in=booking&page=1">Rezervace</a></p>
            </div>
        @endauth
    </div>
    @if (request('in') == 'all')
        {{-- If all results are shown --}}
        @unless(count($results['author']) == 0)
            <h2 class="text-2xl">Autoři</h2>
            <div class="py-3">
                <x-Deck type="author">
                    @foreach ($results['author'] as $author)
                        <x-Card type="author" :data=$author number="{{ $loop->index }}" more="1"
                            placement="away" />
                    @endforeach
                </x-Deck>
            </div>
        @endunless
        @unless(count($results['work']) == 0)
            <h2 class="text-2xl">Díla</h2>
            <div class="py-3">
                <x-Deck type="work">
                    @foreach ($results['work'] as $work)
                        <x-Card type="work" :data=$work number="{{ $loop->index }}" more="1" placement="away" />
                    @endforeach
                </x-Deck>
            </div>
        @endunless
        @unless(count($results['book']) == 0)
            <h2 class="text-2xl">Knihy</h2>
            <div class="py-3">
                <x-Deck type="book">
                    @foreach ($results['book'] as $book)
                        <x-Card type="book" :data=$book number="{{ $loop->index }}" more="1" placement="away" />
                    @endforeach
                </x-Deck>
            </div>
        @endunless
        @auth
            @unless(count($results['user']) == 0)
                <h2 class="text-2xl">Uživatelé</h2>
                <div class="py-3">
                    <x-Deck type="user">
                        @foreach ($results['user'] as $user)
                            <x-Card type="user" :data=$user number="{{ $loop->index }}" more="1" placement="away" />
                        @endforeach
                    </x-Deck>
                </div>
            @endunless
            @unless(count($results['booking']) == 0)
                <h2 class="text-2xl">Rezervace</h2>
                <div class="py-3">
                    <x-Deck type="booking">
                        @foreach ($results['booking'] as $booking)
                            <x-Card type="booking" :data=$booking number="{{ $loop->index }}" more="1"
                                placement="away" />
                        @endforeach
                    </x-Deck>
                </div>
            @endunless
        @endauth
        @if (count($results['author']) == 0 &&
                count($results['work']) == 0 &&
                count($results['book']) == 0 &&
                (auth()->check() == true ? count($results['user']) == 0 : true) &&
                (auth()->check() == true ? count($results['booking']) == 0 : true))
            <p class="text-center">Nebyly nalezeny žádné výsledky</p>
        @endif
    @elseif (request('in') == 'author')
        {{-- If only authors are shown --}}
        @if (count($results['author']) == 0)
            <p class="text-center">Nebyli nalezeni žádní autoři</p>
        @endif
        <x-Deck type="author">
            @foreach ($results['author'] as $author)
                <x-Card :data=$author type="author" number="0" more="0" placement="away" />
            @endforeach
        </x-Deck>
        {{ $results['author']->appends(request()->input())->links() }}
    @elseif (request('in') == 'work')
        {{-- If only works are shown --}}
        @if (count($results['work']) == 0)
            <p class="text-center">Nebyla nalezena žádná díla</p>
        @endif
        <x-Deck type="work">
            @foreach ($results['work'] as $work)
                <x-Card :data=$work type="work" number="0" more="0" placement="away" />
            @endforeach
        </x-Deck>
        {{ $results['work']->appends(request()->input())->links() }}
    @elseif (request('in') == 'book')
        {{-- If only books are shown --}}
        @if (count($results['book']) == 0)
            <p class="text-center">Nebyly nalezeny žádné knihy</p>
        @endif
        <x-Deck type="book">
            @foreach ($results['book'] as $book)
                <x-Card :data=$book type="book" number="0" more="0" placement="away" />
            @endforeach
        </x-Deck>
        {{ $results['book']->appends(request()->input())->links() }}
    @elseif (request('in') == 'user')
        {{-- If only users are shown --}}
        @if (count($results['user']) == 0 || !auth()->check())
            <p class="text-center">Nebyli nalezeni žádní uživatelé</p>
        @else
            <x-Deck type="user">
                @foreach ($results['user'] as $user)
                    <x-Card :data=$user type="user" number="0" more="0" placement="away" />
                @endforeach
            </x-Deck>
            {{ $results['user']->appends(request()->input())->links() }}
        @endif
    @elseif (request('in') == 'booking')
        {{-- If only bookings are shown --}}
        @if (count($results['booking']) == 0 || !auth()->check())
            <p class="text-center">Nebyli nalezeni žádné rezervace</p>
        @else
            <x-Deck type="booking">
                @foreach ($results['booking'] as $booking)
                    <x-Card :data=$booking type="booking" number="0" more="0" placement="away" />
                @endforeach
            </x-Deck>
            {{ $results['booking']->appends(request()->input())->links() }}
        @endif
    @endif
</x-layout>
