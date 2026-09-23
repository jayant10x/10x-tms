<?php

namespace App\Services;

use App\Models\ProjectAndTaskActivityLog;

class ProjectWithTaskActivityLog
{
    protected ?string $slug = null;

    protected ?int $proId = null;

    protected ?int $taskId = null;
    protected $performed_by = null;

    protected array $data = [];

    public static function init(): self
    {
        return new self();
    }

    public function slug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function project(int $proId): self
    {
        $this->proId = $proId;

        return $this;
    }

    public function task(int $taskId): self
    {
        $this->taskId = $taskId;

        return $this;
    }

    public function data(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function log(): ProjectAndTaskActivityLog
    {
        $activities = config('ProjectTaskActivity');

        $activity = $activities[$this->slug] ?? null;

        if (!$activity) {
            throw new \InvalidArgumentException(
                "Activity slug [{$this->slug}] does not exist."
            );
        }

        $description = $this->replacePlaceholders(
            $activity['activity_desc']
        );

        return ProjectAndTaskActivityLog::create([
            'pal_pro_id' => $this->proId,
            'pal_prt_id' => $this->taskId,
            'pal_activity_slug' => $this->slug,
            'pal_activity_data' => $this->data,
            'pal_activity_desc' => $description,
            'pal_performed_by' => $this->performed_by,
            'pal_created_by' => setCreatedUpdatedBy(),
            'pal_created_on' => now(),
        ]);
    }

    protected function replacePlaceholders(string $description): string
    {
        foreach ($this->data as $key => $value) {
            $description = str_replace(
                "[{$key}]",
                $value,
                $description
            );
        }

        return $description;
    }

    public function performedBy($userId): self
    {
        $this->performed_by = $userId;

        return $this;
    }
}
