<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityService
{
    /**
     * Log an activity
     */
    public static function log(string $action, string $module, string $description, $subject = null, array $properties = []): ?Activity
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        $data = [
            'user_id' => $user->id,
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'properties' => $properties,
        ];

        if ($subject) {
            $data['subject_type'] = get_class($subject);
            $data['subject_id'] = $subject->id;
        }

        return Activity::create($data);
    }

    /**
     * Log a create action
     */
    public static function created($model, string $module, string $description = null): Activity
    {
        $description = $description ?? "Created new {$module}";
        return self::log('create', $module, $description, $model);
    }

    /**
     * Log an update action
     */
    public static function updated($model, string $module, string $description = null): Activity
    {
        $description = $description ?? "Updated {$module}";
        return self::log('update', $module, $description, $model);
    }

    /**
     * Log a delete action
     */
    public static function deleted($model, string $module, string $description = null): Activity
    {
        $description = $description ?? "Deleted {$module}";
        return self::log('delete', $module, $description, $model);
    }

    /**
     * Log a publish action
     */
    public static function published($model, string $module, string $description = null): Activity
    {
        $description = $description ?? "Published {$module}";
        return self::log('publish', $module, $description, $model);
    }

    /**
     * Log an unpublish action
     */
    public static function unpublished($model, string $module, string $description = null): Activity
    {
        $description = $description ?? "Unpublished {$module}";
        return self::log('unpublish', $module, $description, $model);
    }

    /**
     * Log an upload action
     */
    public static function uploaded(string $module, string $description, array $properties = []): Activity
    {
        return self::log('upload', $module, $description, null, $properties);
    }

    /**
     * Log a login action
     */
    public static function login(): Activity
    {
        return self::log('login', 'auth', 'User logged in');
    }

    /**
     * Log a logout action
     */
    public static function logout(): Activity
    {
        return self::log('logout', 'auth', 'User logged out');
    }

    /**
     * Get recent activities for dashboard
     */
    public static function getRecentActivities(int $limit = 10)
    {
        return Activity::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get activities by module
     */
    public static function getActivitiesByModule(string $module, int $limit = 20)
    {
        return Activity::with('user')
            ->where('module', $module)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get activities by user
     */
    public static function getActivitiesByUser(int $userId, int $limit = 20)
    {
        return Activity::with('user')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
