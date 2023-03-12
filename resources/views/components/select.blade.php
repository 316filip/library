<div class="relative">
    <label for="form-select"
        class="block mb-1 {{ $type == 'category' ? '' : 'after:content-[\'*\'] after:ml-0.5 after:text-red-500' }}">{{ ucfirst($label) }}</label>
    <div class="relative">
        <input type="hidden" name="{{ $type }}_id" id="form-select-output-{{ $id }}"
            value="{{ $id_value }}" autocomplete="off">
        <input type="text" name="{{ $type }}"
            class="p-2 w-full border border-slate-200 rounded-lg cursor-default" id="form-select-{{ $id }}"
            placeholder="{{ $placeholder }}" onfocus="selectOpen{{ $id }}()" readonly
            value="{{ $name_value }}" autocomplete="off">
        <span class="absolute right-3 top-2 text-slate-500 pointer-events-none"><i
                class="fa-solid fa-angle-down"></i></span>
    </div>

    <div class="h-fit z-50 !inset-x-0 py-1" id="form-select-dropdown-{{ $id }}">
        <div class="h-full w-full rounded-lg shadow-lg backdrop-blur-xl bg-sky-100/30 p-3"
            id="form-select-content-{{ $id }}" style="display: none">
            <input type="text" class="p-2 mb-3 w-full border border-slate-200 rounded-lg"
                id="form-select-filter-{{ $id }}" placeholder="Prohledat {{ $search }}..."
                onkeyup="selectFilter{{ $id }}()" autocomplete="off">
            <div class="h-60 overflow-auto">
                <div id="form-select-options-{{ $id }}">
                    @if ($type == 'author')
                        <input type="button"
                            class="block w-full text-left p-2 rounded-lg hover:bg-yellow-200/80 transition italic"
                            value="Neznámý autor" onclick="selectSet{{ $id }}(1, 'Neznámý autor')">
                    @endif
                    @foreach ($values as $value)
                        @if ($type == 'category')
                            <div class="block w-full text-left p-2 rounded-lg">
                                <input type="checkbox" id="form-select-{{ $id }}-option-{{ $value->id }}"
                                    class="border border-slate-200 rounded-lg mb-0.5 mr-1"
                                    name="category_option_{{ $value->id }}"
                                    onchange="selectCheck{{ $id }}({{ $value->id }}, '{{ $value->name }}')"
                                    autocomplete="off"
                                    {{ old('category_option_' . $value->id) ? 'checked' : (in_array($value->id, explode(', ', $id_value)) ? 'checked' : '') }}>
                                <label for="form-select-{{ $id }}-option-{{ $value->id }}">
                                    {{ $value->name }}
                                </label>
                            </div>
                        @else
                            @unless($type == 'author' && $value->id == 1)
                                <input type="button"
                                    class="block w-full text-left p-2 rounded-lg hover:bg-yellow-200/80 transition"
                                    value="{{ $value->label ?? ($value->name ?? $value->title) }}"
                                    onclick="selectSet{{ $id }}({{ $value->id }}, '{{ $value->label ?? ($value->name ?? $value->title) }}')">
                            @endunless
                        @endif
                    @endforeach
                </div>
                <div class="grid place-content-center h-full w-full hidden"
                    id="form-select-options-empty-{{ $id }}">
                    <span>{{ $not_found }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed top-0 left-0 h-full w-full hidden z-40" id="form-select-backdrop-{{ $id }}"
        onclick="selectClose{{ $id }}()"></div>

    <script>
        $(document)
            .ready(function() {
                $("#form-select-filter-{{ $id }}")
                    .bind("keydown", "esc", function() {
                        selectClose{{ $id }}();
                        return false;
                    })

                placeDropdown{{ $id }}();
            })

        sameWidth = {
            name: "sameWidth",
            enabled: true,
            phase: "beforeWrite",
            requires: ["computeStyles"],
            fn: ({
                state
            }) => {
                state.styles.popper.width = `${state.rects.reference.width}px`;
            },
            effect: ({
                state
            }) => {
                state.elements.popper.style.width = `${state.elements.reference.offsetWidth}px`;
            }
        };

        function placeDropdown{{ $id }}() {
            Popper.createPopper(document.querySelector('#form-select-{{ $id }}'), document.querySelector(
                '#form-select-dropdown-{{ $id }}'), {
                placement: 'bottom',
                strategy: 'fixed',
                modifiers: [sameWidth],
            });
        }

        /**
         * Shows options to select from
         */
        function selectOpen{{ $id }}() {
            $("#form-select-backdrop-{{ $id }}").removeClass("hidden");
            $("#form-select-{{ $id }}").prop("disabled", true)
            $("#form-select-content-{{ $id }}").slideDown("fast", function() {
                placeDropdown{{ $id }}();
            });
            $("#form-select-filter-{{ $id }}").focus();
        }

        /**
         * Closes select dropdown
         */
        function selectClose{{ $id }}() {
            $("#form-select-backdrop-{{ $id }}").addClass("hidden");
            setTimeout(() => {
                $("#form-select-{{ $id }}").prop("disabled", false);
                $("#form-select-content-{{ $id }}").slideUp("fast");
            }, 150);
        }

        /**
         * Filters options in select menu
         */
        function selectFilter{{ $id }}() {
            let empty = true;
            @if ($type == 'category')
                $("#form-select-options-{{ $id }} div").filter(function() {
                    let compare = $(this).children('label').text().toLowerCase().indexOf($(
                                "#form-select-filter-{{ $id }}")
                            .val().toLowerCase()) > -
                        1;
                    $(this).toggle(compare);
                    if (compare == true) {
                        empty = false;
                    }
                });
            @else
                $("#form-select-options-{{ $id }} *").filter(function() {
                    let compare = $(this).val().toLowerCase().indexOf($("#form-select-filter-{{ $id }}")
                            .val().toLowerCase()) > -
                        1;
                    $(this).toggle(compare);
                    if (compare == true) {
                        empty = false;
                    }
                });
            @endif

            if (empty) {
                $("#form-select-options-empty-{{ $id }}").removeClass("hidden");
            } else {
                $("#form-select-options-empty-{{ $id }}").addClass("hidden");
            }
        }

        @if ($type == 'category')
            /**
             * Adds checked option
             */
            function selectCheck{{ $id }}(id, name) {
                let input = $("#form-select-{{ $id }}-option-" + id);
                let preview = $("#form-select-{{ $id }}");
                let output = $("#form-select-output-{{ $id }}");
                if (input.is(":checked")) {
                    if (preview.val() == "") {
                        preview.val(name);
                        output.val(id);
                    } else {
                        preview.val(preview.val() + ", " + name);
                        output.val(output.val() + ", " + id);
                    }
                } else {
                    preview.val(jQuery.grep(preview.val().split(", "), function(value) {
                        return value != name;
                    }).join(", "));
                    output.val(jQuery.grep(output.val().split(", "), function(value) {
                        return value != id;
                    }).join(", "));
                }
            }
        @else
            /**
             * Sets selected option
             */
            function selectSet{{ $id }}(id, name) {
                $("#form-select-{{ $id }}").val(name);
                $("#form-select-output-{{ $id }}").val(id);
                selectClose{{ $id }}();
            }
        @endif
    </script>
</div>
