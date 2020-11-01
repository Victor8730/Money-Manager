<?php

namespace App\Actions\Jetstream;

use App\Models\SettingsUser;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * First, we delete the settings associated with the user from the setting_user table
     * and then delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        SettingsUser::where('user_id',$user->id)->delete();
        $user->delete();
    }
}
