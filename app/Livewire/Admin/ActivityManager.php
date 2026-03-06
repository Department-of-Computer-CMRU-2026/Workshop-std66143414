<?php

namespace App\Livewire\Admin;

use App\Models\Activity;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ActivityManager extends Component
{
    public $activities = [];
    public $name, $speaker, $location, $total_seats, $editingActivityId;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'speaker' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'total_seats' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $this->loadActivities();
    }

    public function loadActivities()
    {
        $this->activities = Activity::withCount('registrations')->get();
    }

    public function create()
    {
        $this->reset(['name', 'speaker', 'location', 'total_seats', 'editingActivityId']);
        $this->showModal = true;
    }

    public function edit(Activity $activity)
    {
        $this->editingActivityId = $activity->id;
        $this->name = $activity->name;
        $this->speaker = $activity->speaker;
        $this->location = $activity->location;
        $this->total_seats = $activity->total_seats;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editingActivityId) {
            $activity = Activity::find($this->editingActivityId);
            $activity->update([
                'name' => $this->name,
                'speaker' => $this->speaker,
                'location' => $this->location,
                'total_seats' => $this->total_seats,
            ]);
        } else {
            Activity::create([
                'name' => $this->name,
                'speaker' => $this->speaker,
                'location' => $this->location,
                'total_seats' => $this->total_seats,
            ]);
        }

        $this->showModal = false;
        $this->loadActivities();
    }

    public function delete(Activity $activity)
    {
        $activity->delete();
        $this->loadActivities();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.activity-manager');
    }
}
