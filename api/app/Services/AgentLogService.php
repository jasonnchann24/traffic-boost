<?php

namespace App\Services;

use Jenssegers\Agent\Agent;
use Jenssegers\Mongodb\Eloquent\Model;

class AgentLogService
{
    /**
     * Generate logging by agent.
     * Foreign key for specific model name, e.g. blog_id
     *
     * @param  \Jenssegers\Mongodb\Eloquent\Model  $model
     * @param  string $foreignKey
     * @return array
     */
    public static function generateAgentLog(Model $model, string $foreignKey): array
    {
        $agent = new Agent();
        $log = [
            'ip' => request()->ip(),
            'device' => $agent->device(),
            'device_type' => $agent->deviceType(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'robot' => $agent->isRobot() ? $agent->robot() : false
        ];

        $log[$foreignKey] = $model->id;

        return $log;
    }
}
