<?php

namespace App\Livewire\Admin;

use App\Models\Activity;
use Livewire\Component;
use Livewire\Attributes\Layout;

class RegistrationList extends Component
{
    public Activity $activity;

    public function mount(Activity $activity)
    {
        $this->activity = $activity->load('registrations.user');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.registration-list');
    }
}
