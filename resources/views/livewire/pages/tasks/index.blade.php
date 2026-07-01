<div class="min-h-screen bg-slate-950 text-slate-100 p-6">
    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Task Manager</h1>
                <p class="text-slate-400">Manage and track your tasks efficiently.</p>
            </div>

            <button class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg font-semibold">
                + New Task
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-slate-900 p-5 rounded-xl border border-slate-800">
                <p class="text-slate-400">Total Tasks</p>
                <h2 class="text-3xl font-bold">12</h2>
            </div>

            <div class="bg-slate-900 p-5 rounded-xl border border-slate-800">
                <p class="text-slate-400">Pending</p>
                <h2 class="text-3xl font-bold text-yellow-400">5</h2>
            </div>

            <div class="bg-slate-900 p-5 rounded-xl border border-slate-800">
                <p class="text-slate-400">Completed</p>
                <h2 class="text-3xl font-bold text-green-400">4</h2>
            </div>

            <div class="bg-slate-900 p-5 rounded-xl border border-slate-800">
                <p class="text-slate-400">High Priority</p>
                <h2 class="text-3xl font-bold text-red-400">3</h2>
            </div>
        </div>

        <div class="bg-slate-900 rounded-xl border border-slate-800 p-4">
            <div class="flex flex-col md:flex-row gap-3 justify-between mb-4">
                <input
                    type="text"
                    placeholder="Search tasks..."
                    class="w-full md:w-1/3 rounded-lg bg-slate-800 border-slate-700 text-slate-100"
                >

                <div class="flex gap-3">
                    <select class="rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                        <option>All Status</option>
                        <option>Not Yet Started</option>
                        <option>Pending</option>
                        <option>Completed</option>
                    </select>

                    <select class="rounded-lg bg-slate-800 border-slate-700 text-slate-100">
                        <option>All Priority</option>
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
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
                        <tr>
                            <td class="py-4">
                                <p class="font-semibold">Learn Laravel Docker</p>
                                <p class="text-sm text-slate-400">Set up Laravel using Docker Compose.</p>
                            </td>
                            <td><span class="px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400 text-sm">Pending</span></td>
                            <td><span class="px-3 py-1 rounded-full bg-red-500/20 text-red-400 text-sm">High</span></td>
                            <td class="text-slate-300">July 10, 2026</td>
                            <td>
                                <div class="w-28 bg-slate-800 rounded-full h-2">
                                    <div class="bg-yellow-400 h-2 rounded-full w-1/2"></div>
                                </div>
                            </td>
                            <td class="text-right space-x-2">
                                <button class="text-indigo-400">Edit</button>
                                <button class="text-red-400">Delete</button>
                            </td>
                        </tr>

                        <tr>
                            <td class="py-4">
                                <p class="font-semibold line-through text-slate-500">Create Task Table</p>
                                <p class="text-sm text-slate-500">Create migration and model relationship.</p>
                            </td>
                            <td><span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400 text-sm">Completed</span></td>
                            <td><span class="px-3 py-1 rounded-full bg-orange-500/20 text-orange-400 text-sm">Medium</span></td>
                            <td class="text-slate-300">July 1, 2026</td>
                            <td>
                                <div class="w-28 bg-slate-800 rounded-full h-2">
                                    <div class="bg-green-400 h-2 rounded-full w-full"></div>
                                </div>
                            </td>
                            <td class="text-right space-x-2">
                                <button class="text-indigo-400">Edit</button>
                                <button class="text-red-400">Delete</button>
                            </td>
                        </tr>

                        <tr>
                            <td class="py-4">
                                <p class="font-semibold">Build Task UI</p>
                                <p class="text-sm text-slate-400">Design horizontal task layout.</p>
                            </td>
                            <td><span class="px-3 py-1 rounded-full bg-slate-500/20 text-slate-300 text-sm">Not Yet Started</span></td>
                            <td><span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-sm">Low</span></td>
                            <td class="text-slate-300">July 5, 2026</td>
                            <td>
                                <div class="w-28 bg-slate-800 rounded-full h-2">
                                    <div class="bg-slate-500 h-2 rounded-full w-0"></div>
                                </div>
                            </td>
                            <td class="text-right space-x-2">
                                <button class="text-indigo-400">Edit</button>
                                <button class="text-red-400">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>