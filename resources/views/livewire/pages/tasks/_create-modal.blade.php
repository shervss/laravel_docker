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

                <div>
                    <label class="block text-sm text-slate-400 mb-1">Due Date</label>
                    <input wire:model="due_date" type="date" class="w-full rounded-lg bg-slate-800 border-slate-700 text-slate-100">
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