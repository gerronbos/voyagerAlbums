<?php

namespace Hostingprecisie\VoyagerForm\Policies;

use TCG\Voyager\Contracts\User;
use TCG\Voyager\Policies\BasePolicy;
use Auth;

class FormPolicy extends BasePolicy
{
    /**
     * Determine if the given model can be edited by the user.
     *
     * @param \TCG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */

    public function browse($user)
    {
        return $user->hasPermission('browse_form');
    }
    public function add()
    {
        return Auth::user()->hasPermission('add_form');
    }
    public function edit($user,$model)
    {
        if($user->id == $model->author){
            return true;
        }
        return Auth::user()->hasPermission('add_form');
    }
    public function delete(User $user, $model)
    {
        if($user->id == $model->author){
            return true;
        }
        return Auth::user()->hasPermission('delete_form');
    }
    public function read(User $user, $model)
    {
        if($user->id == $model->author){
            return true;
        }
        return Auth::user()->hasPermission('read_form');
    }
}
