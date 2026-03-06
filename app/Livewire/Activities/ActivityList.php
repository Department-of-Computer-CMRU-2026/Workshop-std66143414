<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use App\Models\Registration;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ActivityList extends Component
{
    public function register(Activity $activity)
    {
        $user = auth()->user();

        if (!$activity->canRegister($user)) {
             return;
        }

        Registration::create([
            'user_id' => $user->id,
            'activity_id' => $activity->id,
        ]);

        $this->dispatch('activity-updated');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.activities.activity-list', [
            'activities' => Activity::withCount('registrations')->get()
        ]);
    }
}
