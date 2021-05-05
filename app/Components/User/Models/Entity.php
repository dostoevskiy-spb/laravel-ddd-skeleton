<?php

declare(strict_types=1);

namespace Components\User\Models;

use Common\Models\BaseModel;

/**
 * Class Entity
 *
 * @property int id
 * @property string name
 */
class Entity extends BaseModel
{
    public const ID_DEVELOPER= 0;
    public const ID_ADMIN = 1;
    public const ID_MASTER = 2;
    public const ID_ORGANIZATION_OWNER = 3;
    public const ID_MANAGER = 4;

    public $timestamps = false;

    protected $table = 'users.entities';

    protected $fillable = [
        'name',
    ];
}
