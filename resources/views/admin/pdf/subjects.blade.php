<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Disciplinas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Lista de Disciplinas</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Código</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->code ?? '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
