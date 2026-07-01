<div class="max-w-7xl mx-auto px-6 py-8 text-white">
    <h1 class="text-4xl font-bold mb-2">
        Admin Dashboard
    </h1>

    <p class="text-gray-400 mb-8">
        Welcome, {{ auth()->user()->name }}.
    </p>

    <div class="grid grid-cols-3 gap-6">

        <div class="bg-gray-800 rounded-xl p-6">
            <h2 class="text-lg font-semibold">
                Users
            </h2>

            <p class="text-4xl mt-3">
                {{ \App\Models\User::count() }}
            </p>
        </div>

        <div class="bg-gray-800 rounded-xl p-6">
            <h2 class="text-lg font-semibold">
                Tasks
            </h2>

            <p class="text-4xl mt-3">
                {{ \App\Models\Task::count() }}
            </p>
        </div>

        <div class="bg-gray-800 rounded-xl p-6">
            <h2 class="text-lg font-semibold">
                Admins
            </h2>

            <p class="text-4xl mt-3">
                {{ \App\Models\User::role('admin')->count() }}
            </p>
        </div>

    </div>
</div>