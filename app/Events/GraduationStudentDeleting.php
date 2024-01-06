<?php

namespace App\Events;

use App\Models\Student;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GraduationStudentDeleting
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }




    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
