<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    /**
     * The name of the table in the database
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     * Array of fields from the database
     * @var array|string[]
     */
    protected $fillable = [
        'key',
        'name',
        'notice',
        'value',
        'created_at',
        'updated_at'
    ];

    /**
     * Indicates if the model has update and creation timestamps.
     * @var bool
     */
    public $timestamps = true;

    /**
     * Parse the json representation into an array
     *
     * @param string $val
     * @return array
     */
    private function getSettingsValue(string $val): array
    {
        return json_decode($val, true);
    }

    /**
     * Get all settings and return array
     *
     * @return array
     */
    public function getSettingsArray(): array
    {
        $arraySettings = [];
        $settings = $this->all();

        foreach ($settings as $setting) {
            $arraySettings[$setting->id] = [
                'key' => $setting->key,
                'name' => $setting->name,
                'data' => $this->getSettingsValue($setting->value)
            ];
        }

        return $arraySettings;
    }

    /**
     * Get all exist settings
     *
     * @return Settings[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getSettings()
    {
        return parent::all();
    }
}
