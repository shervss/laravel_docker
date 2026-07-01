<?php

namespace App\Livewire\Pages\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function makeAdmin(int $userId): void
    {
        User::findOrFail($userId)->assignRole('admin');
    }

    public function makeUser(int $userId): void
    {
        $user = User::findOrFail($userId);

        $user->syncRoles(['user']);
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.pages.admin.users.index', [
            'users' => $users,
        ]);
    }
}