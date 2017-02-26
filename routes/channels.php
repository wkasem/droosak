<?php


Broadcast::channel('video.{videoId}.comments', function ($user, $orderId) {
    return true;
});

Broadcast::channel('notifications.{id}', function ($user , $id) {
    return true;
});


Broadcast::channel('conversation.{roomId}', function ($user, $roomId) {

    return ['id' => $user->id, 'name' => $user->name];
});
