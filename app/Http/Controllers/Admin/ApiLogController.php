<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiRequestLog;
use Illuminate\Http\Request;

class ApiLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ApiRequestLog::with(['user', 'examination'])->latest();

        if ($request->filled('status')) {
            $query->where('success', $request->status === 'success');
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('endpoint', 'like', "%{$search}%")
                    ->orWhere('error_message', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(20)->withQueryString();

        $summary = [
            'total' => ApiRequestLog::count(),
            'success' => ApiRequestLog::where('success', true)->count(),
            'failed' => ApiRequestLog::where('success', false)->count(),
            'avg_duration' => (int) ApiRequestLog::whereNotNull('duration_ms')->avg('duration_ms'),
        ];

        $filters = $request->only(['status', 'q']);

        return view('admin.api-logs.index', compact('logs', 'summary', 'filters'));
    }

    public function show(ApiRequestLog $apiLog)
    {
        $apiLog->load(['user', 'examination']);

        return view('admin.api-logs.show', compact('apiLog'));
    }
}
