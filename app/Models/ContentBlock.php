<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    protected $fillable = [
        'group',
        'type',
        'key',
        'title',
        'body',
        'meta',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeGroup($query, string $group)
    {
        return $query->where('group', $group);
    }

    public function metaValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->meta, $key, $default);
    }
}
