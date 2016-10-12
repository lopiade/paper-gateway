<?php

namespace App\Events;

use App\Events\Event;
use App\Models\PaperResource;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ServerWasNotFound extends Event
{
    /**
     * @var PaperResource
     */
    public $paperResource;

    /**
     * Create a new event instance.
     *
     * @param PaperResource $paperResource
     */
    public function __construct(PaperResource $paperResource)
    {
        $this->paperResource = $paperResource;
    }
    
}
