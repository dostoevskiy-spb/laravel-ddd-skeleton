<?php

declare(strict_types=1);

namespace Components\Contractor\Models;

use Common\Models\BaseModel;

/**
 * Class Status
 *
 * @property int id
 * @property string name
 */
class Type extends BaseModel
{
    public const ID_BLOCKED = 1;
    public const ID_ACTIVE = 2;

    public $timestamps = false;

    protected $table = 'contractors.statuses';

    protected $fillable = [
        'name',
    ];
}
