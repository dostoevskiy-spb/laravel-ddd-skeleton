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
    public $timestamps = false;

    protected $table = 'users.entities';

    protected $fillable = [
        'name',
    ];
}
