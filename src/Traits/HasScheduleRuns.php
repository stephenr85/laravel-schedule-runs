<?php
namespace Rushing\ScheduleRuns\Traits;

use Rushing\ScheduleRuns\Models\ScheduleRun;

trait HasScheduleRuns {

    public function getScheduleRunHandle()
    {
        return static::class;
    }

    public function scheduleRuns()
    {
        return ScheduleRun::query()->where('handle', $this->getScheduleRunHandle());
    }

    public function getLastScheduleRun()
    {
        return $this->scheduleRuns()->latest();
    }

    public function setLastScheduleRun($time = null, $taskData = [])
    {
        return ScheduleRun::create([
            'handle' => $this->getScheduleRunHandle(),
            'created_at' => $time ?: now(),
            'task_data' => $taskData,
        ]);
    }

    public function scopeWhereLastScheduleRun($query, $columns = ['created_at', 'updated_at'], $operator = '>=', $override = false)
    {
        $when = $override ?: $this->getLastScheduleRun()->created_at;
        $query->where(function($query) use ($when, $operator, $columns) {
            collect($columns)->each(fn($col) => $query->orWhere($col, $operator, $when));
        });
    }

}
