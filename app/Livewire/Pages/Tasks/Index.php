<?php

namespace App\Livewire\Pages\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public bool $showCreateModal = false;

    public string $title = '';
    public ?string $description = null;
    public ?string $due_date = null;

    public string $search = '';
    public string $statusFilter = '';

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
    }

    public function createTask(): void
    {
        $validated = $this->validate();

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'status' => 'Not Yet Started',
            'priority' => 'Medium',
            'is_starred' => false,
        ]);

        activity()
            ->performedOn($task)
            ->causedBy(Auth::user())
            ->log('Created task');

        $this->closeCreateModal();
        $this->resetForm();
    }

    public function toggleStar(int $taskId): void
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);

        $task->update([
            'is_starred' => ! $task->is_starred,
        ]);

        activity()
            ->performedOn($task)
            ->causedBy(Auth::user())
            ->log($task->is_starred ? 'Starred task' : 'Unstarred task');
    }

    public function updateStatus(int $taskId, string $status): void
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);

        $task->update([
            'status' => $status,
        ]);

        activity()
            ->performedOn($task)
            ->causedBy(Auth::user())
            ->log("Changed task status to {$status}");
    }

    public function deleteTask(int $taskId): void
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($taskId);

        activity()
            ->performedOn($task)
            ->causedBy(Auth::user())
            ->log('Deleted task');

        $task->delete();
    }

    private function resetForm(): void
    {
        $this->resetValidation();

        $this->title = '';
        $this->description = null;
        $this->due_date = null;
    }

    public function render()
    {
        $baseQuery = Task::where('user_id', Auth::id());

        $totalTasks = (clone $baseQuery)->count();
        $pendingTasks = (clone $baseQuery)->where('status', 'Pending')->count();
        $completedTasks = (clone $baseQuery)->where('status', 'Completed')->count();
        $starredTasks = (clone $baseQuery)->where('is_starred', true)->count();

        $tasks = $baseQuery
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, fn ($query) => $query->where('status', $this->statusFilter))
            ->orderByDesc('is_starred')
            ->latest()
            ->paginate(10);

        return view('livewire.pages.tasks.index', [
            'tasks' => $tasks,
            'totalTasks' => $totalTasks,
            'pendingTasks' => $pendingTasks,
            'completedTasks' => $completedTasks,
            'starredTasks' => $starredTasks,
        ]);
    }
}