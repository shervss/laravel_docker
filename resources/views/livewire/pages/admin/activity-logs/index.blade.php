<div class="max-w-7xl mx-auto px-6 py-8 text-white">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold">Activity Logs</h1>
            <p class="text-gray-400">
                Monitor system activities performed by users.
            </p>
        </div>
    </div>

    <div class="mb-6">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Search activity..."
            class="w-full md:w-96 rounded-lg bg-gray-800 border border-gray-700 text-white px-4 py-2"
        >
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">
        <table class="min-w-full">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left">User</th>
                    <th class="px-6 py-3 text-left">Activity</th>
                    <th class="px-6 py-3 text-left">Subject</th>
                    <th class="px-6 py-3 text-left">Date</th>
                </tr>
            </thead>

            <tbody>

                @forelse($activities as $activity)

                    <tr class="border-t border-gray-800">

                        <td class="px-6 py-4">
                            {{ $activity->causer?->name ?? 'System' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $activity->description }}
                        </td>

                        <td class="px-6 py-4">
                            {{ class_basename($activity->subject_type) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $activity->created_at->format('M d, Y h:i A') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                            No activity logs found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

    <div class="mt-6">
        {{ $activities->links() }}
    </div>

</div>