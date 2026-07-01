<div class="max-w-7xl mx-auto px-6 py-8 text-white">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold">User Management</h1>
            <p class="text-slate-400">Manage user roles and access.</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="text-indigo-400 hover:text-indigo-300">
            Back to Admin Dashboard
        </a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4">
        <input
            wire:model.live="search"
            type="text"
            placeholder="Search users..."
            class="w-full md:w-1/3 mb-4 rounded-lg bg-slate-800 border-slate-700 text-slate-100"
        >

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="py-3">Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Joined</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-800">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-800/40">
                            <td class="py-4 font-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->getRoleNames() as $role)
                                    <span class="px-3 py-1 rounded-full bg-indigo-500/20 text-indigo-400 text-sm">
                                        {{ $role }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="text-right space-x-2">
                                <button wire:click="makeAdmin({{ $user->id }})" class="text-green-400">
                                    Make Admin
                                </button>

                                <button wire:click="makeUser({{ $user->id }})" class="text-yellow-400">
                                    Make User
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>