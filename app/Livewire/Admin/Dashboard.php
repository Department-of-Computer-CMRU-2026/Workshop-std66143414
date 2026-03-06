<?php

namespace App\Livewire\Admin;

use App\Models\Activity;
use App\Models\Registration;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    public function getStats()
    {
        $activities = Activity::withCount('registrations')->get();
        
        return [
            'total_activities' => $activities->count(),
            'total_registrations' => Registration::count(),
            'total_seats' => $activities->sum('total_seats'),
            'full_activities' => $activities->filter(fn($a) => $a->is_full)->count(),
            'activities' => $activities
        ];
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'stats' => $this->getStats()
        ]);
    }
}
