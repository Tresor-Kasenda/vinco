<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'resource_id',
        'resource_type',
        'path'
    ];


    /**
     * Get the resource associated with the media.
     *
     * This method defines a polymorphic relationship between the Media model and the models that can be associated with media.
     * It returns a MorphTo relationship instance, which represents the resource that is associated with the media.
     *
     * @return MorphTo
     */
    public function resource(): MorphTo
    {
        return $this->morphTo();
    }
}
