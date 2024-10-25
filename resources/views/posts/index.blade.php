<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1>Aqui se mostrara una lista con todos los post</h1>
    <p>{{ $prueba }}</p>
    <p>{{ $prueba2 }}</p>

    {{--  @unless (true)

    @endunless  --}}
    <div class="container mx-auto py-20">
        <x-alert type='dangr'>
            <x-slot name="title">
                Titulo de prueba
            </x-slot>
            Hola mundo
        </x-alert>

       </div>
</body>
</html>
