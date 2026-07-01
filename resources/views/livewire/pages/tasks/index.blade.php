<div class="min-h-screen bg-slate-950 text-slate-100 p-6">
    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Task Manager</h1>
                <p class="text-slate-400">Manage and track your tasks efficiently.</p>
            </div>

            <button wire:click="openCreateModal" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg font-semibold">
                + New Task
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-slate-900 p-5 rounded-xl border border-slate-800">
                <p class="text-slate-400">Total Tasks</p>
                <h2 class="text-3xl font-bold">{{ $totalTasks }}</h2>
            </div>

            <div class="bg-slate-900 p-5 rounded-xl border border-slate-800">
                <p class="text-slate-400">Pending</p>
                <h2 class="text-3xl font-bold text-yellow-400">{{ $pendingTasks }}</h2>
            </div>

            <div class="bg-slate-900 p-5 rounded-xl border border-slate-800">
                <p class="text-slate-400">Completed</p>
                <h2 class="text-3xl font-bold text-green-400">{{ $completedTasks }}</h2>
            </div>

            <div class="bg-slate-900 p-5 rounded-xl border border-slate-800">
                <p class="text-slate-400">High Priority</p>
                <h2 class="text-3xl font-bold text-red-400">{{ $highPriorityTasks }}</h2>
            </div>
        </div>

        <div class="bg-slate-900 rounded-xl border border-slate-800 p-4 overflow-x-auto">
            <table class="w-full text-left">
                <thead class="text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="py-3">Task</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Progress</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-800">
                    @forelse ($tasks as $task)
                        <tr>
                            <td class="py-4">
                                <p class="font-semibold {{ $task->status === 'Completed' ? 'line-through text-slate-500' : '' }}">
                                    {{ $task->title }}
                                </p>
                                <p class="text-sm text-slate-400">{{ $task->description }}</p>
                            </td>

                            <td>
                                <span class="px-3 py-1 rounded-full text-sm
                                    {{ $task->status === 'Completed' ? 'bg-green-500/20 text-green-400' : '' }}
                                    {{ $task->status === 'Pending' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                    {{ $task->status === 'Not Yet Started' ? 'bg-slate-500/20 text-slate-300' : '' }}">
                                    {{ $task->status }}
                                </span>
                            </td>

                            <td>
                                <span class="px-3 py-1 rounded-full text-sm
                                    {{ $task->priority === 'High' ? 'bg-red-500/20 text-red-400' : '' }}
                                    {{ $task->priority === 'Medium' ? 'bg-orange-500/20 text-orange-400' : '' }}
                                    {{ $task->priority === 'Low' ? 'bg-blue-500/20 text-blue-400' : '' }}">
                                    {{ $task->priority }}
                                </span>
                            </td>

                            <td class="text-slate-300">
                                {{ $task->due_date ? $task->due_date->format('F j, Y') : 'No due date' }}
                            </td>

                            <td>
                                @php
                                    $progress = $task->status === 'Completed' ? 100 : ($task->status === 'Pending' ? 50 : 0);
                                @endphp

                                <div class="w-28 bg-slate-800 rounded-full h-2">
                                    <div class="h-2 rounded-full
                                        {{ $progress === 100 ? 'bg-green-400' : '' }}
                                        {{ $progress === 50 ? 'bg-yellow-400' : '' }}
                                        {{ $progress === 0 ? 'bg-slate-500' : '' }}"
                                        style="width: {{ $progress }}%">
                                    </div>
                                </div>
                            </td>

                            <td class="text-right space-x-2">
                                <button wire:click="openEditModal({{ $task->id }})" class="text-indigo-400">
                                    Edit
                                </button>

                                <button
                                    wire:click="deleteTask({{ $task->id }})"
                                    wire:confirm="Are you sure you want to delete this task?"
                                    class="text-red-400"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-slate-400">
                                No tasks yet. Click <span class="text-indigo-400">+ New Task</span> to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($showCreateModal)
            <div class="fixed inset-0 bg-black/70 flex items-center justify-center z-50">
                <div class="bg-slate-900 border border-slate-800 rounded-xl w-full max-w-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">New Task</h2>

                    <form wire:submit="createTask" class="space-y-4">
                        <div>
                            <label class="block text-sm text-slate-400 mb-1">Title</label>
                            <input wire:model="title" type="text" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                            @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-slate-400 mb-1">Description</label>
                            <textarea wire:model="description" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-sm text-slate-400 mb-1">Status</label>
                                <select wire:model="status" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                                    <option>Not Yet Started</option>
                                    <option>Pending</option>
                                    <option>Completed</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-slate-400 mb-1">Priority</label>
                                <select wire:model="priority" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                                    <option>Low</option>
                                    <option>Medium</option>
                                    <option>High</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-slate-400 mb-1">Due Date</label>
                                <input wire:model="due_date" type="date" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" wire:click="closeCreateModal" class="px-4 py-2 rounded-lg border border-slate-700 text-slate-300">
                                Cancel
                            </button>

                            <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 font-semibold">
                                Create Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        @if ($showEditModal)
            <div class="fixed inset-0 bg-black/70 flex items-center justify-center z-50">
                <div class="bg-slate-900 border border-slate-800 rounded-xl w-full max-w-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">Edit Task</h2>

                    <form wire:submit="updateTask" class="space-y-4">
                        <div>
                            <label class="block text-sm text-slate-400 mb-1">Title</label>
                            <input wire:model="title" type="text" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                            @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-slate-400 mb-1">Description</label>
                            <textarea wire:model="description" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-sm text-slate-400 mb-1">Status</label>
                                <select wire:model="status" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                                    <option>Not Yet Started</option>
                                    <option>Pending</option>
                                    <option>Completed</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-slate-400 mb-1">Priority</label>
                                <select wire:model="priority" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                                    <option>Low</option>
                                    <option>Medium</option>
                                    <option>High</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-slate-400 mb-1">Due Date</label>
                                <input wire:model="due_date" type="date" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" wire:click="closeEditModal" class="px-4 py-2 rounded-lg border border-slate-700 text-slate-300">
                                Cancel
                            </button>

                            <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 font-semibold">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>