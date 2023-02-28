<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stránka nenalezena</title>
    <link rel="shortcut icon" href="{{ asset('/img/icon.svg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .err404 {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 100%;
            transform: translateX(-50%) translateY(-50%) perspective(20em) rotateX(-20deg) rotateY(-9deg);
        }
    </style>
</head>

<body>
    <img class="fixed -translate-x-1/2 bottom-0 left-1/2 h-2/5" src="{{ asset('/img/404.svg') }}"
        alt="Ilustrační obrázek">
    <div class="err404">
        <h1 class="text-center text-9xl font-mono oldstyle-nums slashed-zero">419</h1>
        <p class="text-center font-mono">Platnost stránky vypršela.</p>
    </div>
</body>

</html>
