<?php

namespace Rushing\ScheduleRuns\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

/**
 * @property string $task
 */
class ScheduleRun extends Model
{
    use SchemalessAttributesTrait;

    public const UPDATED_AT = false;

    public $timestamps = true;

    protected $fillable = [
        'handle',
        'created_at',
        'task_data',
    ];

    protected $schemalessAttributes = [
        'task_data',
    ];
}
