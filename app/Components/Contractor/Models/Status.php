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
class Status extends BaseModel
{
    protected $table = 'contractors.statuses';

    protected $fillable = [
        'name',
    ];
}
