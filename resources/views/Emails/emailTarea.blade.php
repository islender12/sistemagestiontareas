<!DOCTYPE html>
<html lang="es">
{{-- Vista del Correo --}}

<head>
    <title>Email</title>
    <style>
        /* Estilos para el contenido del correo */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        /* Estilos para el footer del correo */
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #777;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <h1>Asignacion de Tarea</h1>
    @foreach ($data as $key => $value)
        @if ($key === 'tarea')
            <p>Se te Ha Asignado una Nueva Tarea Perteneciente al Proyecto: <strong>{{ $value['proyecto']['nombre'] }}</strong></p>
            <p><strong>ID:</strong> {{ $value['id'] }}</p>
            <p><strong>Nombre:</strong> {{ $value['nombre'] }}</p>
            <p><strong>Descripción:</strong> {{ $value['descripcion'] }}</p>
            <p><strong>Fecha de Asignación:</strong> {{ $value['fecha_asignacion'] }}</p>
            <p><strong>Fecha de Vencimiento:</strong> {{ $value['fecha_vencimiento'] }}</p>
        @endif
    @endforeach

    <div class="footer">
        <p>Este correo electrónico fue generado automáticamente. Por favor no responda a este mensaje.</p>
    </div>
</body>

</html>
