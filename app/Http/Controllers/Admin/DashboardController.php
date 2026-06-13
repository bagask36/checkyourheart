<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiRequestLog;
use App\Models\ContentBlock;
use App\Models\Examinations;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'examinations' => Examinations::count(),
            'content_blocks' => ContentBlock::count(),
            'api_logs' => ApiRequestLog::count(),
            'api_success' => ApiRequestLog::where('success', true)->count(),
            'api_failed' => ApiRequestLog::where('success', false)->count(),
        ];

        $recentLogs = ApiRequestLog::with('user')
            ->latest()
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentLogs'));
    }
}
