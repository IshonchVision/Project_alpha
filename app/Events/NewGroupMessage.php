<?php

namespace App\Events;

use App\Models\GroupMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewGroupMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(GroupMessage $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     * We'll use a public channel named `group.{id}` for simplicity.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('group.' . $this->message->group_id);
    }

    public function broadcastWith()
    {
        $msg = $this->message->fresh(['user']);

        // Foydalanuvchi role ga qarab to'g'ri partial tanlash
        $viewPath = 'student.sections.partials.message'; // default
        
        return [
            'id' => $msg->id,
            'group_id' => $msg->group_id,
            'user_id' => $msg->user_id,
            'user_name' => $msg->user->name ?? 'Unknown',
            'user_role' => $msg->user->role ?? 'user',
            'message' => $msg->message,
            'created_at' => $msg->created_at->toDateTimeString(),
            // Rendered HTML so frontend can append easily
            'html' => view($viewPath, ['msg' => $msg])->render(),
        ];
    }

    public function broadcastAs()
    {
        return 'NewGroupMessage';
    }
}
