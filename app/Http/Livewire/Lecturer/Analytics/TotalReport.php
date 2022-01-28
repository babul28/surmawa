<?php

namespace App\Http\Livewire\Lecturer\Analytics;

use Livewire\Component;

class TotalReport extends Component
{
    use WithSelectedMonthState;
    
    public function render()
    {
        return view('livewire.lecturer.analytics.total-report');
    }
}
