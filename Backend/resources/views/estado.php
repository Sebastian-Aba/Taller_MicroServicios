<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tareas por Estado</title>
    <style>
        .impediment { color: red; }
        .status-group { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Tareas por estado</h1>
    @foreach ($tareas as $estado => $grupotarea)
        <div class="status-group">
            <h2>{{ ucfirst($estado) }}</h2>
            <ul>
                @foreach ($grupotarea as $tareas)
                    <li class="{{ $tarea->estado == 'impediment' ? 'impediment' : '' }}">
                        {{ $tarea->titulo }} - {{ $tarea->descripcion }} - {{ $tarea->idEmpleado }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</body>
<script src="/Fronted/JS/estadoTarea.js"></script>
</html>
