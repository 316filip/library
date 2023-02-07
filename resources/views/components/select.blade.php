<div>
    <label for="form-select"
        class="block mb-1 capitalize after:content-['*'] after:ml-0.5 after:text-red-500">{{ $label }}</label>
    <div class="relative">
        <input type="hidden" name="{{ $type }}_id" id="form-select-output" value="{{ $id_value }}"
            autocomplete="off">
        <input type="text" name="{{ $type }}"
            class="p-2 w-full border border-slate-200 rounded-lg cursor-default" id="form-select"
            placeholder="{{ $placeholder }}" onfocus="selectOpen()" readonly value="{{ $name_value }}"
            autocomplete="off">
        <span class="absolute right-3 top-2 text-slate-500 pointer-events-none"><i
                class="fa-solid fa-angle-down"></i></span>
    </div>

    <div class="h-fit w-full max-w-3xl z-50 px-6 py-1" id="form-select-dropdown">
        <div class="h-full w-full rounded-lg shadow-lg backdrop-blur-xl p-3" id="form-select-content"
            style="display: none">
            <input type="text" class="p-2 mb-3 w-full border border-slate-200 rounded-lg" id="form-select-filter"
                placeholder="Prohledat {{ $search }}..." onkeyup="selectFilter()" autocomplete="off">
            <div class="h-60 overflow-auto">
                <div id="form-select-options">
                    @if ($type == 'author')
                        <input type="button"
                            class="block w-full text-left p-2 rounded-lg hover:bg-yellow-200/80 transition italic"
                            value="Neznámý autor" onclick="selectSet(1, 'Neznámý autor')">
                    @endif
                    @foreach ($values as $value)
                        @unless($type == 'author' && $value->id == 1)
                            <input type="button"
                                class="block w-full text-left p-2 rounded-lg hover:bg-yellow-200/80 transition"
                                value="{{ $value->name ?? $value->title }}"
                                onclick="selectSet({{ $value->id }}, '{{ $value->name ?? $value->title }}')">
                        @endunless
                    @endforeach
                </div>
                <div class="grid place-content-center h-full w-full hidden" id="form-select-options-empty">
                    <span>Hledaný {{ $label }} nebyl nalezen</span>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed top-0 left-0 h-full w-full hidden z-40" id="form-select-backdrop" onclick="selectClose()"></div>

    <script>
        $(document)
            .ready(function() {
                $("#form-select-filter")
                    .bind("keydown", "esc", function() {
                        selectClose();
                        return false;
                    })
            })

        Popper.createPopper(document.querySelector('#form-select'), document.querySelector(
            '#form-select-dropdown'), {
            placement: 'bottom',
        });

        /**
         * Shows options to select from
         */
        function selectOpen() {
            $("#form-select-backdrop").removeClass("hidden");
            $("#form-select-content").slideDown("fast");
            $("#form-select").prop("disabled", true)
            $("#form-select-filter").focus();
        }

        /**
         * Closes select dropdown
         */
        function selectClose() {
            $("#form-select-backdrop").addClass("hidden");
            setTimeout(() => {
                $("#form-select").prop("disabled", false);
                $("#form-select-content").slideUp("fast");
            }, 100);
        }

        /**
         * Filters options in select menu
         */
        function selectFilter() {
            let empty = true;
            $("#form-select-options *").filter(function() {
                let compare = $(this).val().toLowerCase().indexOf($("#form-select-filter").val().toLowerCase()) > -
                    1;
                $(this).toggle(compare);
                if (compare == true) {
                    empty = false;
                }
            });

            if (empty) {
                $("#form-select-options-empty").removeClass("hidden");
            } else {
                $("#form-select-options-empty").addClass("hidden");
            }
        }

        /**
         * Sets selected option
         */
        function selectSet(id, name) {
            $("#form-select").val(name);
            $("#form-select-output").val(id);
            selectClose();
        }
    </script>
</div>
