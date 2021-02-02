<?php

declare(strict_types=1);

namespace Components\User\Common\Models;

use Common\Models\BaseModel;

/**
 * Class Status
 *
 * @property int id
 * @property string name
 */
class Status extends BaseModel
{
    public const ID_BLOCKED = 10;
    public const ID_ACTIVE = 20;

    public $timestamps = false;

    protected $table = 'users.statuses';

    protected $fillable = [
        'name',
    ];
}
