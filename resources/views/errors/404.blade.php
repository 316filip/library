<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stránka nenalezena</title>
    <link rel="shortcut icon" href="{{ asset('/img/icon.svg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <img class="fixed -translate-x-1/2 bottom-0 left-1/2 h-2/5" src="{{ asset('/img/404.svg') }}" alt="Ilustrační obrázek">
    <div class="fixed w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <h1 class="text-center text-8xl font-mono oldstyle-nums slashed-zero">404</h1>
        <p class="text-center font-mono">Stránka nebyla nalezena.</p>
    </div>
</body>
</html>