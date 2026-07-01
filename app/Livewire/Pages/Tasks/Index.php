<?php

namespace App\Livewire\Pages\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public bool $showCreateModal = false;

    public string $title = '';
    public ?string $description = null;
    public string $status = 'Not Yet Started';
    public string $priority = 'Medium';
    public ?string $due_date = null;

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:Not Yet Started,Pending,Completed'],
            'priority' => ['required', 'in:Low,Medium,High'],
            'due_date' => ['nullable', 'date'],
        ];
    }

    public function openCreateModal(): void
    {
        $this->resetValidation();

        $this->title = '';
        $this->description = null;
        $this->status = 'Not Yet Started';
        $this->priority = 'Medium';
        $this->due_date = null;

        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
    }

    public function createTask(): void
    {
        $validated = $this->validate();

        Task::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        $this->closeCreateModal();
    }

    public function render()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.pages.tasks.index', [
            'tasks' => $tasks,
            'totalTasks' => $tasks->count(),
            'pendingTasks' => $tasks->where('status', 'Pending')->count(),
            'completedTasks' => $tasks->where('status', 'Completed')->count(),
            'highPriorityTasks' => $tasks->where('priority', 'High')->count(),
        ]);
    }
}