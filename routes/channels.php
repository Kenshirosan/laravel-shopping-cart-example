<?php

use App\Order;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('order-tracker.{id}', function ($user, $id) {
    return (int) $user->id === (int) Order::where(['id' => $id, 'user_id' => $user->id])->firstOrFail()->user_id;
});

Broadcast::channel('user_ordered', function ($user) {
    return $user->isAdmin() || $user->isEmployee();
});
