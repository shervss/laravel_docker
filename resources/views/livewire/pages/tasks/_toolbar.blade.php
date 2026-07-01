<div class="flex flex-col md:flex-row gap-3 justify-between mb-4">
    <input
        wire:model.live="search"
        type="text"
        placeholder="Search tasks..."
        class="w-full md:w-1/3 rounded-lg bg-slate-800 border-slate-700 text-slate-100"
    >

    <select wire:model.live="statusFilter" class="rounded-lg bg-slate-800 border-slate-700 text-slate-100">
        <option value="">All Status</option>
        <option value="Not Yet Started">Not Yet Started</option>
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
    </select>
</div>