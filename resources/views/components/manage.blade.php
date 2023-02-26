@lib
    <div class="flex gap-3 justify-center mb-5">
        <div class="h-8 w-8">
            <a href="/{{ $link_edit }}/upravit">
                <p class="h-full w-full bg-yellow-400 hover:bg-amber-400 transition rounded-full text-center">
                    <i class="align-middle fa-regular fa-pen-to-square"></i>
                </p>
            </a>
        </div>
        <div class="h-8 w-8">
            <button class="h-full w-full bg-red-500 hover:bg-red-600 transition rounded-full" onclick="openDelete()">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        </div>
    </div>

    <div id="fullscreen-delete" style="display: none"
        class="fixed top-0 left-0 w-full h-full px-3 backdrop-blur bg-yellow-400/70 z-50 grid grid-cols-1 place-content-center">
        <div
            class="grid grid-cols-1 mx-auto py-8 w-full max-w-xl rounded-lg shadow-md place-content-center place-items-center gap-3 bg-slate-50">
            <p class="mb-5 text-center">Opravdu chcete {{ $text }} odstranit?</p>
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-center" onclick="closeDelete()">
                    <button class="px-3 py-2 bg-sky-100 hover:bg-sky-200 transition rounded-lg shadow">Zrušit</button>
                </div>
                <form class="flex justify-center" action="/{{ $link_delete }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-2 bg-red-500 hover:bg-red-600 transition rounded-lg shadow text-white">Odstranit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDelete() {
            $("#fullscreen-delete").fadeIn("fast");
        }

        function closeDelete() {
            $("#fullscreen-delete").fadeOut("fast");
        }
    </script>
@endlib
