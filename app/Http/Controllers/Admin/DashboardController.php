<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}


public function exportarRelatorioEstudantes()
{
    // Filtrar usuários apenas com a role "student"
    $estudantes = User::where('role', 'student') // Verifica apenas os estudantes
                     ->with('curso') // Carrega o curso (assumindo que há um relacionamento)
                     ->get();

    // Cabeçalho do CSV
    $csvData = "ID,Nome,Email,Curso\n";

    // Adiciona os dados dos estudantes no CSV
    foreach ($estudantes as $estudante) {
        $csvData .= "{$estudante->id},{$estudante->name},{$estudante->email}," . ($estudante->curso->nome ?? 'Sem curso') . "\n";
    }

    // Define o nome do arquivo
    $fileName = 'relatorio_estudantes_' . now()->format('Ymd_His') . '.csv';

    // Retorna o arquivo CSV para download
    return Response::make($csvData, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$fileName}",
    ]);
}
