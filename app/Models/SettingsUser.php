<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function updateSettings(User $user, Request $request, SettingsUser $settingsUser){
//        SettingsUser::update([
//            'user_id' => $user->id,
//            'setting_id' => $setting->id,
//            'value' => $request
//        ])->where('user_id', $user->id);
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
