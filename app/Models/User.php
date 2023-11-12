<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatusEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable // implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'user_type',
        'university_id',
        'feature_image_id',
        'status',
        'social_id',
        'social_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => UserStatusEnum::class,
        'user_type' => UserTypeEnum::class,
    ];

    /**
     * Get the feature image associated with the user.
     *
     * @return BelongsTo<University, User>
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Get the feature image associated with the user.
     *
     * @return BelongsTo<Media, User>
     */
    public function featureImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'feature_image_id');
    }

    /**
     * Get the feature image associated with the user.
     *
     * @return BelongsTo<Media, User>
     */
    public function profileImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'profile_image_id');
    }

    /**
     * Get the images associated with the user.
     *
     * @return MorphMany<Media>
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'resource');
    }
}
