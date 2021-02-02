<?php

declare(strict_types=1);

namespace Common\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method Builder update(array $values)
 */
class BaseModel extends Model
{
    public $timestamps = false;
}
