<div>
    <h2 class="text-2xl mb-5"><a href="javascript:void(0)" onclick="{{ $type }}Details()">{{ $slot }} <i
                class="fa-solid fa-caret-right transition {{ $placement == 'home' ? 'rotate-90' : '' }}"
                id="{{ $type }}-details-toggle"></i></a></h2>
    <div id="{{ $type }}-details-table" class="mb-5" style="{{ $placement == 'home' ? '' : 'display: none' }}">
        <table
            class="table-auto w-full border border-slate-200 rounded-lg border-separate border-spacing-x-4 border-spacing-y-3">
            @if ($heading != null && $placement == 'away')
                <tr>
                    <td colspan="2">
                        <a class="underline" href="/titul/{{ $id }}">
                            <span class="font-bold">{{ $heading }}</span>
                            @unless($subheading == null)
                                ({{ $subheading }})
                            @endunless
                        </a>
                    </td>
                </tr>
            @endif
            @foreach ($rows as $title => $value)
                @unless($value[0] == null)
                    <tr>
                        <td class="align-top">{{ $title }}:</td>
                        <td class="align-bottom text-justify">
                            @if (isset($value[1]) && !is_null($value[1]))
                                <a class="underline" href="{{ $value[1] }}">
                            @endif
                            {{ $value[0] }}
                            @if (isset($value[1]) && !is_null($value[1]))
                                </a>
                            @endif
                        </td>
                    </tr>
                @endunless
            @endforeach
        </table>
    </div>
</div>

<script>
    /**
     * Toggles details table
     */
    function {{ $type }}Details() {
        $("#{{ $type }}-details-table").slideToggle();
        $("#{{ $type }}-details-toggle").toggleClass("rotate-90");
    }
</script>
