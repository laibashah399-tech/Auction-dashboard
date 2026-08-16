<?php

namespace App\Traits;

use App\Services\AuditLogService;
use Illuminate\Database\Eloquent\Model;

trait Auditable
{
    /**
     * Boot the Auditable trait.
     */
    protected static function bootAuditable(): void
    {
        static::created(function (Model $model) {
            $model->writeAuditLog('created');
        });

        static::updated(function (Model $model) {
            $model->writeAuditLog('updated');
        });

        static::deleted(function (Model $model) {
            $model->writeAuditLog('deleted');
        });
    }


    /**
     * Write audit log through AuditLogService.
     */
    public function writeAuditLog(string $event): void
    {
        try {

            $module = class_basename($this);

            $description = $this->getAuditDescription($event);

            match ($event) {

                'created' => AuditLogService::created(
                    $module,
                    $this,
                    $description
                ),

                'updated' => AuditLogService::updated(
                    $module,
                    $this,
                    $description
                ),

                'deleted' => AuditLogService::deleted(
                    $module,
                    $this,
                    $description
                ),

                default => AuditLogService::log(
                    $event,
                    $module,
                    $description,
                    $this
                ),
            };

        } catch (\Throwable $e) {

            /*
             * Audit logging should never
             * break the main application.
             */

            report($e);
        }
    }


    /**
     * Generate human-readable description.
     */
    protected function getAuditDescription(string $event): string
    {
        $module = class_basename($this);

        $name = $this->getAuditDisplayName();

        return match ($event) {

            'created' => "{$module} {$name} was created.",

            'updated' => "{$module} {$name} was updated.",

            'deleted' => "{$module} {$name} was deleted.",

            default => "{$module} {$name} was {$event}.",
        };
    }


    /**
     * Get a useful display name.
     */
    protected function getAuditDisplayName(): string
    {
        $fields = [
            'name',
            'title',
            'lot_number',
            'auction_number',
            'invoice_number',
            'email',
        ];

        foreach ($fields as $field) {

            if (!empty($this->{$field})) {
                return (string) $this->{$field};
            }
        }

        return '#' . $this->getKey();
    }
}