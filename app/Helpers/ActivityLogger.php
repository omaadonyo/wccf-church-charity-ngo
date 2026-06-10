<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogger
{
    public static function log(string $action, ?string $description = null, ?Request $request = null): ActivityLog
    {
        $request ??= request();
        return ActivityLog::create([
            'user_id' => $request?->user()?->id,
            'action' => $action,
            'description' => $description,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);
    }
}
