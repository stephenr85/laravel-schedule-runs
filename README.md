# Laravel Schedule Runs

Inspired by (Tofandel's Stack Overflow response)[https://stackoverflow.com/a/73554077]. Packagaed for reusability.

## Install

```
composer require stephenr85/laravel-schedule-runs
php artisan schedule-runs:install
```

## Usage

Use the trait on one of your commands.

```php
class MyCommand {
    use \Rushing\ScheduleRuns\Traits\HasScheduleRuns;

    protected $signature = 'app:my-command {--since=}';

    public function getScheduleRunHandle()
    {
        // The class name is used by default in the trait, but you can override here.
        return static::class;
    }

    public function handle()
    {
        $query = MyModel::query();

        // Get the last schedule run
        $this->getLastScheduleRun();

        // Modify a query to get items created or updated after the last schedule run. Optionally, pass an override parameter.
        $this->scopeWhereLastScheduleRun($query, ['created_at', 'updated_at'], '>=', $this->option('since'));

        // Clear the history
        $this->scheduleRuns()->delete(); // or each->delete() if you want to fire the model events.

        // Set the last run time, optionally with extra data attached.
        $this->setLastScheduleRun(now(), [
            'whatever' => 'you want'
        ]);
    }
}
```
