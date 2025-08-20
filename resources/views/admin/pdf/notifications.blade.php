<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notificações</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Lista de Notificações</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Mensagem</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->title }}</td>
                <td>{{ $notification->message }}</td>
                <td>{{ $notification->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
