<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use MustafaAzmi\Checkin\Traits\HasCheckins;

#[Fillable(['name', 'description', 'single_use', 'ttl_minutes'])]
class Event extends Model
{
    use HasCheckins;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'single_use' => 'boolean',
            'ttl_minutes' => 'integer',
        ];
    }
}
