<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiRequestLog extends Model
{
    protected $fillable = [
        'user_id',
        'examination_id',
        'endpoint',
        'method',
        'request_payload',
        'response_status',
        'response_body',
        'duration_ms',
        'success',
        'error_message',
    ];

    protected $casts = [
        'request_payload' => 'array',
        'success' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function examination(): BelongsTo
    {
        return $this->belongsTo(Examinations::class, 'examination_id');
    }

    public function decodedResponse(): ?array
    {
        if (blank($this->response_body)) {
            return null;
        }

        $decoded = json_decode($this->response_body, true);

        return is_array($decoded) ? $decoded : null;
    }
}
