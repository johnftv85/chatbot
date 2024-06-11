<!-- resources/views/pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
</head>
<body>
    <h1>Vista PDF</h1>
    <p>Este es un contenido de prueba para la vista PDF.</p>
    <table>
        <thead>
            <tr>
                <th>
                    Codigo
                </th>
                <th>
                    Descripciòn
                </th>
                <th>
                    Precio
                </th>
                <th>
                    Impuesto
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($responds as $b)
                <tr>
                    <td>
                        {{$b->codproducto}}
                    </td>
                    <td>
                        {{$b->nomproducto}}
                    </td>
                    <td>
                        {{$b->preciomov}}
                    </td>
                    <td>
                        {{$b->ivamov}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>