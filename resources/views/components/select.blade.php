<div>
    <label for="form-select" class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Autor</label>
    <div class="relative">
        <input type="hidden" name="{{ $name }}" id="form-select-output" value="{{ old($name) }}" autocomplete="off">
        <input type="text" name="{{$type}}" class="p-2 w-full border border-slate-200 rounded-lg cursor-default" id="form-select"
            placeholder="Neznámý" onfocus="selectOpen()" readonly  value="{{ old($type) }}" autocomplete="off">
        <span class="absolute right-3 top-2 text-slate-500 pointer-events-none"><i
                class="fa-solid fa-angle-down"></i></span>
    </div>

    <div class="h-fit w-full max-w-2xl 2xl:max-w-3xl z-40 p-2" id="form-select-dropdown">
        <div class="h-full w-full rounded-md shadow-lg backdrop-blur-xl p-3" id="form-select-content"
            style="display: none">
            <input type="text" class="p-2 mb-3 w-full border border-slate-200 rounded-lg" id="form-select-filter"
                placeholder="Prohledat autory..." onkeyup="selectFilter()" onblur="selectClose()" autocomplete="off">
            <div class="h-60 overflow-auto">
                <div id="form-select-options">
                    <input type="button" class="block w-full text-left p-2 rounded-md hover:bg-yellow-200/80 transition"
                        value="Neznámý" onclick="selectSet(1, 'Neznámý')">
                    @foreach ($values as $value)
                        <input type="button" class="block w-full text-left p-2 rounded-md hover:bg-yellow-200/80 transition"
                            value="{{ $value->name }}" onclick="selectSet({{ $value->id }}, '{{ $value->name }}')">
                    @endforeach
                </div>
                <div class="grid place-content-center h-full w-full hidden" id="form-select-options-empty">
                    <span>Hledaný autor nebyl nalezen</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        Popper.createPopper(document.querySelector('#form-select'), document.querySelector(
            '#form-select-dropdown'), {
            placement: 'bottom',
        });

        function selectOpen() {
            $("#form-select-content").slideDown("fast");
            $("#form-select").prop("disabled", true)
            $("#form-select-filter").focus();
        }

        function selectClose() {
            setTimeout(() => {
                $("#form-select").prop("disabled", false);
                $("#form-select-content").slideUp("fast");
            }, 100);
        }

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

        function selectSet(id, name) {
            $("#form-select").val(name);
            $("#form-select-output").val(id);
        }
    </script>
</div>
