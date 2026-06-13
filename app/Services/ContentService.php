<?php

namespace App\Services;

use App\Models\ContentBlock;
use Illuminate\Support\Collection;

class ContentService
{
    public function getBlock(string $group, string $key): ?ContentBlock
    {
        return ContentBlock::active()->group($group)->where('key', $key)->first();
    }

    public function getByType(string $group, string $type): Collection
    {
        return ContentBlock::active()
            ->group($group)
            ->where('type', $type)
            ->orderBy('sort_order')
            ->get();
    }

    public function getGrouped(string $group): Collection
    {
        return ContentBlock::active()
            ->group($group)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('type');
    }

    public function getLandingContent(): array
    {
        $grouped = $this->getGrouped('landing');

        return [
            'hero' => $grouped->get('hero')?->first(),
            'stats' => $grouped->get('stat') ?? collect(),
            'features' => $grouped->get('feature') ?? collect(),
            'steps' => $grouped->get('step') ?? collect(),
            'cta' => $grouped->get('cta')?->first(),
        ];
    }

    public function getEducationContent(): array
    {
        $grouped = $this->getGrouped('education');

        return [
            'hero' => $grouped->get('hero')?->first(),
            'facts' => $grouped->get('fact') ?? collect(),
            'intro' => $grouped->get('intro')?->first(),
            'warnings' => $grouped->get('warning') ?? collect(),
            'tips' => $grouped->get('tip') ?? collect(),
            'cta' => $grouped->get('cta')?->first(),
        ];
    }

    public function getAuthContent(string $page): array
    {
        $grouped = $this->getGrouped('auth');

        return [
            'brand' => $grouped->get('brand')?->firstWhere('key', $page),
            'features' => $grouped->get('feature') ?? collect(),
        ];
    }
}
