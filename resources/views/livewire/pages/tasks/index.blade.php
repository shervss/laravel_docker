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
                <p class="text-slate-400">Starred Tasks</p>
                <h2 class="text-3xl font-bold text-red-400">{{ $starredTasks }}</h2>
            </div>
        </div>

        <div class="bg-slate-900 rounded-xl border border-slate-800 p-4">
            @include('livewire.pages.tasks._toolbar')
            @include('livewire.pages.tasks._table')
        </div>

        @include('livewire.pages.tasks._create-modal')
        @include('livewire.pages.tasks._edit-modal')

    </div>
</div>