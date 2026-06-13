<?php

namespace App\Services;

use App\Models\ApiRequestLog;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PredictionApiService
{
    public function predict(array $payload, ?int $userId = null): array
    {
        $endpoint = rtrim(config('services.ml_api.url'), '/') . '/predict';
        $startedAt = microtime(true);

        try {
            $response = Http::timeout((int) config('services.ml_api.timeout', 30))
                ->post($endpoint, $payload);

            $durationMs = (int) round((microtime(true) - $startedAt) * 1000);

            $log = $this->createLog([
                'user_id' => $userId,
                'endpoint' => $endpoint,
                'request_payload' => $payload,
                'response_status' => $response->status(),
                'response_body' => $response->body(),
                'duration_ms' => $durationMs,
                'success' => $response->successful(),
                'error_message' => $response->successful() ? null : 'API response tidak sukses.',
            ]);

            return [
                'success' => $response->successful(),
                'data' => $response->successful() ? $response->json() : null,
                'log' => $log,
            ];
        } catch (\Throwable $e) {
            $durationMs = (int) round((microtime(true) - $startedAt) * 1000);

            $log = $this->createLog([
                'user_id' => $userId,
                'endpoint' => $endpoint,
                'request_payload' => $payload,
                'duration_ms' => $durationMs,
                'success' => false,
                'error_message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'data' => null,
                'log' => $log,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function attachExamination(ApiRequestLog $log, int $examinationId): void
    {
        $log->update(['examination_id' => $examinationId]);
    }

    private function createLog(array $attributes): ApiRequestLog
    {
        return ApiRequestLog::create($attributes);
    }
}
