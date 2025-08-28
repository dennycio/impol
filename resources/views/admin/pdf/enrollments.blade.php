<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Matrículas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        h1, h2 { text-align: center; margin: 5px 0; }
        .logo { width: 100px; margin: 0 auto; display: block; }
    </style>
</head>
<body>
    <!-- Logo -->
    <div>
        <img src="{{ public_path('images/impol.jpg') }}" alt="Logo" class="logo">
    </div>

    <h1>Instituto Médio Politécnico Limpopo</h1>
    <h2>Lista de Matrículas</h2>

    <table>
        <thead>
            <tr>
                <th>Estudante</th>
                <th>Email</th>
                <th>Curso</th>
                <th>Ano</th>
            </tr>
        </thead>
        <tbody>
        @foreach($enrollments as $enrollment)
            <tr>
                <td>{{ $enrollment->user->name }}</td>
                <td>{{ $enrollment->user->email }}</td>
                <td>{{ $enrollment->course->name }}</td>
                <td>{{ $enrollment->year }}º Ano</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
