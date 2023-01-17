<div>
    <table
        class="table-auto w-full border border-slate-200 rounded-md border-separate border-spacing-x-4 border-spacing-y-3">
        <tr>
            <td colspan="2"><span class="font-bold">{{ $work->title }}</span>
                @unless($work->subtitle == NULL)
                    ({{ $work->subtitle }})
                @endunless
            </td>
        </tr>
        @unless($work->original_title == NULL)
            <tr>
                <td class="align-top">Původní název:</td>
                <td class="align-bottom text-justify">{{ $work->original_title }}</td>
            </tr>
        @endunless
        <tr>
            <td class="align-top">Autor:</td>
            <td class="align-bottom">
                @unless($work->author->id == 1)
                    <a class="underline" href="/autor/{{ $work->author->id }}">
                    @endunless
                    {{ $work->author->name }}
                    @unless($work->author->id == 1)
                    </a>
                @endunless
            </td>
        </tr>
        @unless($work->description == NULL)
            <tr>
                <td class="align-top">Popis:</td>
                <td class="align-bottom text-justify">{{ $work->description }}</td>
            </tr>
        @endunless
        @unless($work->year == NULL)
            <tr>
                <td class="align-top">Rok:</td>
                <td class="align-bottom">{{ $work->year }}</td>
            </tr>
        @endunless
        <tr>
            <td class="align-top">Jazyk:</td>
            <td class="align-bottom">{{ $work->language }}</td>
        </tr>
        <tr>
            <td class="align-top">Literární druh:</td>
            <td class="align-bottom capitalize">{{ $work->class }}</td>
        </tr>
        @unless($work->genre == NULL)
            <tr>
                <td class="align-top">Literární žánr:</td>
                <td class="align-bottom capitalize">{{ $work->genre }}</td>
            </tr>
        @endunless
        @unless($work->number == NULL)
            <tr>
                <td class="align-top">Délka:</td>
                <td class="align-bottom">{{ $work->number }} @if ($work->class === 'lyrika')
                        básní
                    @elseif ($work->class === 'epika')
                        kapitol
                    @else
                        dějství
                    @endif
                </td>
            </tr>
        @endunless
    </table>
</div>
