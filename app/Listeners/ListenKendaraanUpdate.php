<?php

namespace App\Listeners;

use App\Events\OnKendaraanUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class ListenKendaraanUpdate
{
    public $users_id;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users_id = User::select('id')->where('role', 'Petugas-Ruang')->get();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OnKendaraanUpdate $event)
    {
        // Make Cache Event for all user
        foreach ($this->users_id as $user) 
        {
            $instance_key = 'UpdateKendaraan_' . $user->id;
            Cache::forget($instance_key);
            Cache::put($instance_key, now(), now()->addMinutes(5));
        }
    }
}
