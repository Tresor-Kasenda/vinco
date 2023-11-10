<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class University extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'initials',
        'name',
        'address',
        'email',
        'phone',
        'code'
    ];

    /**
     * Get the user associated with the university.
     *
     * @return HasOne<User>
     */
    public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
