<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Estudantes</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        h1 { text-align: center; margin-bottom: 10px; }
        .logo { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    {{-- Logo no topo --}}
    <div class="logo">
        <img src="{{ public_path('images/impol.jpg') }}" alt="Logo IMPOL" style="width:100px; height:auto;">
    </div>

    <h1>Lista de Estudantes</h1>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Curso</th>
            </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->course ? $student->course->name : '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
