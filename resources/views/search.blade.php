<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Výsledky hledání</h1>
    <div class="overflow-x-auto">
        <div class="flex gap-8 py-2 mb-3 overflow-visible">
            <div class="flex-1">
                <p class="text-center"><a
                        class="{{ request('in') == 'all' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                        href="?filter=search&query={{ request('query') }}&in=all&page=1">Vše</a></p>
            </div>
            <div class="flex-1">
                <p class="text-center"><a
                        class="{{ request('in') == 'author' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                        href="?filter=search&query={{ request('query') }}&in=author&page=1">Autoři</a></p>
            </div>
            <div class="flex-1">
                <p class="text-center"><a
                        class="{{ request('in') == 'work' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                        href="?filter=search&query={{ request('query') }}&in=work&page=1">Tituly</a></p>
            </div>
            <div class="flex-1">
                <p class="text-center"><a
                        class="{{ request('in') == 'book' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                        href="?filter=search&query={{ request('query') }}&in=book&page=1">Knihy</a></p>
            </div>
            @lib
                <div class="flex-1">
                    <p class="text-center"><a
                            class="{{ request('in') == 'user' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                            href="?filter=search&query={{ request('query') }}&in=user&page=1">Uživatelé</a></p>
                </div>
                <div class="flex-1">
                    <p class="text-center"><a
                            class="{{ request('in') == 'booking' ? 'px-5 py-2 bg-sky-100 rounded-lg shadow-sm' : '' }}"
                            href="?filter=search&query={{ request('query') }}&in=booking&page=1">Rezervace</a></p>
                </div>
            @endlib
        </div>
    </div>
    @if (request('in') == 'all')
        {{-- If all results are shown --}}
        @unless(count($results['author']) == 0)
            <h2 class="text-2xl">Autoři</h2>
            <div class="py-3">
                <x-Deck type="author">
                    @foreach ($results['author'] as $author)
                        <x-Card :data=$author :info="['author', $loop->index, 'search', request('query')]" />
                    @endforeach
                </x-Deck>
            </div>
        @endunless
        @unless(count($results['work']) == 0)
            <h2 class="text-2xl">Tituly</h2>
            <div class="py-3">
                <x-Deck type="work">
                    @foreach ($results['work'] as $work)
                        <x-Card :data=$work :info="['work', $loop->index, 'search', request('query')]" />
                    @endforeach
                </x-Deck>
            </div>
        @endunless
        @unless(count($results['book']) == 0)
            <h2 class="text-2xl">Knihy</h2>
            <div class="py-3">
                <x-Deck type="book">
                    @foreach ($results['book'] as $book)
                        <x-Card :data=$book :info="['book', $loop->index, 'search', request('query')]" />
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
                            <x-Card :data=$user :info="['user', $loop->index, 'search', request('query')]" />
                        @endforeach
                    </x-Deck>
                </div>
            @endunless
            @unless(count($results['booking']) == 0)
                <h2 class="text-2xl">Rezervace</h2>
                <div class="py-3">
                    <x-Deck type="booking">
                        @foreach ($results['booking'] as $booking)
                            <x-Card :data=$booking :info="['booking', $loop->index, 'search', request('query')]" />
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
            <p class="text-center text-slate-500">Nebyly nalezeny žádné výsledky</p>
        @endif
    @elseif (request('in') == 'author')
        {{-- If only authors are shown --}}
        @if (count($results['author']) == 0)
            <p class="text-center text-slate-500">Nebyli nalezeni žádní autoři</p>
        @endif
        <x-Deck type="author">
            @foreach ($results['author'] as $author)
                <x-Card :data=$author :info="['author', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $results['author']->appends(request()->input())->links() }}
    @elseif (request('in') == 'work')
        {{-- If only works are shown --}}
        @if (count($results['work']) == 0)
            <p class="text-center text-slate-500">Nebyla nalezeny žádné tituly</p>
        @endif
        <x-Deck type="work">
            @foreach ($results['work'] as $work)
                <x-Card :data=$work :info="['work', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $results['work']->appends(request()->input())->links() }}
    @elseif (request('in') == 'book')
        {{-- If only books are shown --}}
        @if (count($results['book']) == 0)
            <p class="text-center text-slate-500">Nebyly nalezeny žádné knihy</p>
        @endif
        <x-Deck type="book">
            @foreach ($results['book'] as $book)
                <x-Card :data=$book :info="['book', 0, '', '']" />
            @endforeach
        </x-Deck>
        {{ $results['book']->appends(request()->input())->links() }}
    @elseif (request('in') == 'user')
        {{-- If only users are shown --}}
        @if (count($results['user']) == 0 || !auth()->check())
            <p class="text-center text-slate-500">Nebyli nalezeni žádní uživatelé</p>
        @else
            <x-Deck type="user">
                @foreach ($results['user'] as $user)
                    <x-Card :data=$user :info="['user', 0, '', '']" />
                @endforeach
            </x-Deck>
            {{ $results['user']->appends(request()->input())->links() }}
        @endif
    @elseif (request('in') == 'booking')
        {{-- If only bookings are shown --}}
        @if (count($results['booking']) == 0 || !auth()->check())
            <p class="text-center text-slate-500">Nebyly nalezeny žádné rezervace</p>
        @else
            <x-Deck type="booking">
                @foreach ($results['booking'] as $booking)
                    <x-Card :data=$booking :info="['booking', 0, '', '']" />
                @endforeach
            </x-Deck>
            {{ $results['booking']->appends(request()->input())->links() }}
        @endif
    @endif
</x-layout>
