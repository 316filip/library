<div id="fullscreen-delete" style="display: none"
    class="fixed top-0 left-0 w-full h-full px-3 backdrop-blur bg-yellow-400/70 z-50 grid grid-cols-1 place-content-center">
    <div
        class="grid grid-cols-1 mx-auto py-8 w-full max-w-xl rounded-md shadow-md place-content-center place-items-center gap-3 bg-slate-50">
        <p class="mb-5 text-center">Opravdu chcete {{ $text }} odstranit?</p>
        <div class="grid grid-cols-2 w-full">
            <div class="flex justify-center" onclick="closeDelete()">
                <button class="px-3 py-2 bg-sky-100 rounded-lg border border-slate-200">Zrušit</button>
            </div>
            <form class="flex justify-center" action="/{{ $link }}/{{ $id }}" method="post">
                @csrf
                @method('DELETE')
                <button class="px-3 py-2 bg-red-500 rounded-lg border border-slate-200">Odstranit</button>
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
