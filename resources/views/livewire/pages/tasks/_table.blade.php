<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead class="text-slate-400 border-b border-slate-800">
            <tr>
                <th class="w-12 text-center">★</th>
                <th class="py-3">Task</th>
                <th>Status</th>
                <th>Due Date</th>
                <th class="text-center w-20">Delete</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-800">
            @forelse ($tasks as $task)
                <tr class="hover:bg-slate-800/40 transition">
                    <td class="text-center">
                        <button wire:click="toggleStar({{ $task->id }})" class="text-2xl">
                            @if($task->is_starred)
                                <span class="text-yellow-400">★</span>
                            @else
                                <span class="text-slate-500 hover:text-yellow-400">☆</span>
                            @endif
                        </button>
                    </td>

                    <td class="py-4">
                        <p class="font-semibold {{ $task->status === 'Completed' ? 'line-through text-slate-500' : '' }}">
                            {{ $task->title }}
                        </p>

                        @if($task->description)
                            <p class="text-sm text-slate-400 mt-1">
                                {{ $task->description }}
                            </p>
                        @endif
                    </td>

                    <td>
                        <select
                            wire:change="updateStatus({{ $task->id }}, $event.target.value)"
                            class="rounded-lg bg-slate-800 border-slate-700 text-slate-100"
                        >
                            <option value="Not Yet Started" @selected($task->status === 'Not Yet Started')>Not Yet Started</option>
                            <option value="Pending" @selected($task->status === 'Pending')>Pending</option>
                            <option value="Completed" @selected($task->status === 'Completed')>Completed</option>
                        </select>
                    </td>

                    <td>
                        @if (!$task->due_date)
                            <span class="text-slate-500">—</span>
                        @elseif ($task->status !== 'Completed' && $task->due_date->isPast())
                            <span class="px-3 py-1 rounded-full bg-red-500/20 text-red-400 text-sm">
                                Overdue
                            </span>
                        @elseif ($task->status !== 'Completed' && $task->due_date->isToday())
                            <span class="px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400 text-sm">
                                Due Today
                            </span>
                        @else
                            <span class="text-slate-300">
                                {{ $task->due_date->format('M d, Y') }}
                            </span>
                        @endif
                    </td>

                    <td class="text-center">
                        <button
                            wire:click="deleteTask({{ $task->id }})"
                            wire:confirm="Delete this task?"
                            class="text-red-400 hover:text-red-300 text-xl"
                        >
                            🗑️
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-slate-400">
                        No tasks found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
</div>