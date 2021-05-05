<?php

declare(strict_types=1);

namespace Components\User;

use Common\Models\AuthEntity;
use Components\AccountManager\AccountManager;
use Components\MediaBuyer\MediaBuyer;
use Components\User\Models\Status;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 *
 * @property int id
 * @property int status_id
 * @property int entity_id
 * @property string email
 * @property string password
 *
 * @property Status status
 * @property MediaBuyer|AccountManager entity
 */
class User extends AuthEntity implements JWTSubject, Authenticatable
{
    public $timestamps = false;

    protected $table = 'users.users';

    protected $fillable = [
        'status_id',
        'entity_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function entity(): HasOne
    {
        $entities = config('components.user.entities');

        $entityClass = $entities[$this->entity_id];

        return $this->hasOne($entityClass);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
