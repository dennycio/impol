<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Professores</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Lista de Professores</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
