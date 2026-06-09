<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogService
{
    public static function log(string $action, object $model, string $description, array $changes = []): void
    {
        ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => $action,
            'model_type' => class_basename($model),
            'model_id'   => $model->id,
            'description' => $description,
            'changes'    => empty($changes) ? null : $changes,
        ]);
    }
}
