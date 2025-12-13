<?php

use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Broadcast;

// For now allow authenticated users to listen to group channels
Broadcast::channel('group.{groupId}', function ($user, $groupId) {
    // Optionally check if $user belongs to the group or is admin
    return (bool) $user;
});
