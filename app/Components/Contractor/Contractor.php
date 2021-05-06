<?php

declare(strict_types=1);

namespace Components\Contractor;

use Common\Models\BaseModel;
use Components\Contractor\Models\Status;
use Components\Contractor\Models\Type;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class User
 *
 * @property int    $id
 * @property int    $status_id
 * @property int    $type_id
 * @property string $name
 * @property string $code
 * @property string $address
 * @property string $inn
 * @property string $ogrn
 *
 * @property Status $status
 * @property Type   $type
 */
class Contractor extends BaseModel
{
    protected $table = 'contractors.contractors';

    protected $fillable = [
        'status_id',
        'type_id',
        'name',
        'address',
        'inn',
        'ogrn',
    ];


    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
