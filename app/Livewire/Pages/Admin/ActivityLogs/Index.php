<?php

namespace App\Livewire\Pages\Admin\ActivityLogs;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $activities = Activity::with(['causer', 'subject'])
            ->when($this->search, function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.pages.admin.activity-logs.index', [
            'activities' => $activities,
        ]);
    }
}