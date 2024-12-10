<?php
http_response_code(503);
header('Refresh: ' . 60);
?>

<!DOCTYPE html>
<html lang="cs">
<head class="h-screen">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihovna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen">
    <div class="w-full h-full flex flex-col items-center justify-center">
        <h1 class="font-mono text-4xl text-center">Právě probíhá údržba webu</h1>
        <p class="text-xl text-center">Prosím, zkuste to později.</p>
    </div>
</body>
</html>