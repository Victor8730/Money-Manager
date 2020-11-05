<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsUser extends Model
{
    use HasFactory;

    /**
     * Indicates if the model has update and creation timestamps.
     * @var bool
     */
    public $timestamps = true;

    /**
     * The name of the table in the database
     * @var string
     */
    protected $table = 'settings_users';

    /**
     * The attributes that are mass assignable.
     * Array of fields from the database
     * @var array|string[]
     */
    protected $fillable = [
        'user_id',
        'setting_id',
        'value',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the settings record associated with the setting user.
     */
    public function setting()
    {
        return $this->belongsTo('App\Models\Settings');
    }

    /**
     * Get all settings by user and return in array with key by setting_id
     * Used in setting page
     *
     * @return SettingsUser[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSettingsUserArray(): array
    {
        return $this->all()
            ->where('user_id', Auth::id())
            ->keyBy('setting_id')
            ->toArray();
    }

    /**
     * Get all setting user with key and name
     * @return array
     */
    public function getSettingsUser(): array
    {
        $settingsUser = $this->all()->where('user_id', Auth::id());
        $valueSettings = [];

        foreach ($settingsUser as $settingUser) {
            $setting = $this->find($settingUser->id)->setting;
            $settingArrayValue = json_decode($setting->value, true);
            $valueSettings[$setting->key]['value-text'] = $settingArrayValue[$settingUser->value];
            $valueSettings[$setting->key]['value'] = $settingUser->value;
        }

        return $valueSettings;
    }

    /**
     * Update all settings for user, used in setting page
     *
     * @param Request $request
     */
    public function updateSettingsUser(Request $request)
    {
        foreach ($request['settings'] as $key => $setting) {
            $this->where('user_id', Auth::id())
                ->where('setting_id', $key)
                ->update(['value' => $setting]);
        }
    }

    /**
     * Create settings for the user
     * Usually used when creating a new user
     *
     * @param User $user
     * @param object $settings
     */
    public static function createSettings(User $user, object $settings): void
    {
        foreach ($settings as $setting) {
            SettingsUser::create([
                'user_id' => $user->id,
                'setting_id' => $setting->id,
                'value' => 1
            ]);
        }
    }
}
