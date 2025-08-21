<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Cast value to array if it contains JSON.
     * If it’s a simple string, it will remain a string.
     */
    protected $casts = [
        'value' => 'array', 
    ];

    /**
     * Retrieve a setting value by key.
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        if (!$setting) return $default;

        // If value is an array (JSON), return as is; else return string
        return is_array($setting->value) ? $setting->value : $setting->value;
    }

    /**
     * Set a setting value by key (insert or update)
     */
    public static function set($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
