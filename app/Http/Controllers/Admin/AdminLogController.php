<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminLog;

class AdminLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AdminLog::with('admin')->orderBy('created_at', 'desc');

        // Filtrar por período
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $logs = $query->paginate(20);

        return view('admin.logs.index', compact('logs'));
    }
}
