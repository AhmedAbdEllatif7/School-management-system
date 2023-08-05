<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    public $events = '';

    protected $listeners = ['eventAdded' => 'addEvent', 'eventDeleted' => 'deleteEvent', 'eventDropped' => 'eventDrop'];

    public function mount()
    {
        $this->getEvent();
    }

    public function getEvent()
    {
        try {
            $events = Event::select('id', 'title', 'start')->get();
            $this->events = $events->toJson();
        } catch (\Exception $e) {
            // Handle the exception (if any) here
            $this->events = '[]';
        }
    }

    public function addEvent($event)
    {
        try {
            $input['title'] = $event['title'];
            $input['start'] = $event['start'];
            Event::create($input);
            $this->emit('refreshCalendar');
        } catch (\Exception $e) {
            // Handle the exception (if any) here
        }
    }

    public function eventDrop($event)
    {
        try {
            $eventData = Event::find($event['id']);
            $eventData->start = $event['start'];
            $eventData->save();
        } catch (\Exception $e) {
            // Handle the exception (if any) here
        }
    }

    public function deleteEvent($eventId)
    {
        try {
            Event::find($eventId)->delete();
            $this->emit('refreshCalendar');
        } catch (\Exception $e) {
            // Handle the exception (if any) here
        }
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
