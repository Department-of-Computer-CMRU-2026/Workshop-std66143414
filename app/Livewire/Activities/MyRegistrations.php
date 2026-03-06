<?php

namespace App\Livewire\Activities;

use App\Models\Registration;
use Livewire\Component;
use Livewire\Attributes\Layout;

class MyRegistrations extends Component
{
    public function cancel(Registration $registration)
    {
        if ($registration->user_id === auth()->id()) {
            $registration->delete();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.activities.my-registrations', [
            'registrations' => auth()->user()->registrations()->with('activity')->get()
        ]);
    }
}
