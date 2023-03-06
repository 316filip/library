<x-Layout heading="Kontakt">
    <h1 class="text-4xl text-center font-bold mb-5">Kontakt</h1>
    <div class="grid gap-2 text-center mb-5">
        <p><i class="fa-solid fa-location-dot"></i> <a href="https://mapy.cz/s/holuceture" target="_blank"
                rel="noopener noreferrer">Nad štolou 1510/1, 17000 Praha 7 - Holešovice, Česko</a></p>
        <p><i class="fa-solid fa-envelope"></i> <a href="mailto:podpora@filiprund.cz">podpora@filiprund.cz</a></p>
        <p><i class="fa-solid fa-phone"></i> <a href="tel:+420 xxx xxx xxx">+420 xxx xxx xxx</a></p>
    </div>
    <h2 class="text-2xl text-center font-bold mb-5">Otevírací doba</h2>
    <div class="flex justify-center">
        <div class="w-full max-w-lg p-4 border border-slate-200 rounded-lg">
            <table class="table-auto min-[450px]:table-fixed w-full text-left">
                <tr>
                    <th>Den v týdnu</th>
                    <th>Čas</th>
                </tr>
                <tr>
                    <td>Pondělí</td>
                    <td>{{ $mon[0] == 'false' ? 'Zavřeno' : $mon[0] . (isset($mon[1]) ? ' a ' . $mon[1] : '') }}</td>
                </tr>
                <tr>
                    <td>Úterý</td>
                    <td>{{ $tue[0] == 'false' ? 'Zavřeno' : $tue[0] . (isset($tue[1]) ? ' a ' . $tue[1] : '') }}</td>
                </tr>
                <tr>
                    <td>Středa</td>
                    <td>{{ $wed[0] == 'false' ? 'Zavřeno' : $wed[0] . (isset($wed[1]) ? ' a ' . $wed[1] : '') }}</td>
                </tr>
                <tr>
                    <td>Čtvrtek</td>
                    <td>{{ $thu[0] == 'false' ? 'Zavřeno' : $thu[0] . (isset($thu[1]) ? ' a ' . $thu[1] : '') }}</td>
                </tr>
                <tr>
                    <td>Pátek</td>
                    <td>{{ $fri[0] == 'false' ? 'Zavřeno' : $fri[0] . (isset($fri[1]) ? ' a ' . $fri[1] : '') }}</td>
                </tr>
                <tr>
                    <td>Sobota</td>
                    <td>{{ $sat[0] == 'false' ? 'Zavřeno' : $sat[0] . (isset($sat[1]) ? ' a ' . $sat[1] : '') }}</td>
                </tr>
                <tr>
                    <td>Neděle</td>
                    <td>{{ $sun[0] == 'false' ? 'Zavřeno' : $sun[0] . (isset($sun[1]) ? ' a ' . $sun[1] : '') }}</td>
                </tr>
            </table>
        </div>
    </div>
</x-Layout>
