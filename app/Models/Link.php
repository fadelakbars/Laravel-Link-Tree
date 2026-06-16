<?php

namespace App\Models;

use Database\Factories\LinkFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    /** @use HasFactory<LinkFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'profile_id',
        'title',
        'url',
        'icon',
        'is_active',
        'sort_order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
