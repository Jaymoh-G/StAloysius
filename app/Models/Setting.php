<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'label',
        'description'
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value, $group = 'general', $type = 'text', $label = null, $description = null)
    {
        $setting = static::where('key', $key)->first();

        if ($setting) {
            $setting->update(['value' => $value]);
        } else {
            static::create([
                'key' => $key,
                'value' => $value,
                'group' => $group,
                'type' => $type,
                'label' => $label ?: ucfirst(str_replace('_', ' ', $key)),
                'description' => $description
            ]);
        }
    }

    public static function getGroup($group)
    {
        return static::where('group', $group)
            ->orderBy('key')
            ->get();
    }

    public static function isApplicationOpen()
    {
        return static::get('student_application_open', '0') === '1';
    }

    public static function getApplicationNote()
    {
        return static::get('student_application_note', '');
    }

    public static function getApplicationDeadline()
    {
        return static::get('student_application_deadline', '');
    }

    public static function getGoogleFormUrl()
    {
        return static::get('student_application_google_form_url', '');
    }
}
