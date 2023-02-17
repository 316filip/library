<html style="background-color: #e0f2fe;">

<head>
    <meta http-equiv="content-type" content="text/html; charset=">
</head>

<body
    style='padding: 1rem 0 1rem 0; background-color: #e0f2fe; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";'>
    <center>
        <table
            style='background-color: white; width: 30rem; border-spacing: 1rem; text-align: center; border-radius: .5rem;'>
            <tr>
                <td>
                    <h1 style="margin: 0;">Vaše rezervace byla zrušena</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Dobrý den,<br>Vaše rezervace knihy {{ $booking->book->title }}, vytvořená před pěti dny,
                        byla dnes zrušena, aniž by byla kniha vyzvednuta. Pokud jste o knihu neztratili zájem, můžete si
                        ji rezervovat znovu, nebo nás rovnou navštívit osobně.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <a href="{{ url('/kniha/' . $booking->book->id) }}"
                            style='display: inline-block; padding: .5rem 1rem; background-color: #facc15; border-radius: .5rem; box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1); color: black; text-decoration: none;'>Zobrazit
                            knihu</a>
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <p>S pozdravem,<br>Vaše knihovna</p>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
