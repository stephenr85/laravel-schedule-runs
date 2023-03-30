<?php

namespace Rushing\ScheduleRuns\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

/**
 * @property string $task
 */
class ScheduleRun extends Model
{
    use SchemalessAttributesTrait;

    public const UPDATED_AT = null;

    public $timestamps = true;

    protected $fillable = [
        'handle',
        'created_at',
        'task_data',
    ];

    protected $schemalessAttributes = [
        'task_data',
    ];

    public function scopeWithTaskData(): Builder
    {
        return $this->task_data->modelScope();
    }
}
