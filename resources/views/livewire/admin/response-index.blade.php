<div class="max-w-7xl mx-auto py-8">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold">Form Responses</h1>
            <p class="text-gray-500">View all submitted form responses.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-5 mb-6">

            <div class="grid md:grid-cols-4 gap-4">

                <input type="text" wire:model.live="search" placeholder="Search..." class="rounded-lg border-gray-300">

                <select wire:model.live="form" class="rounded-lg border-gray-300">

                    <option value="">All Forms</option>

                    @foreach($forms as $form)

                    <option value="{{ $form->id }}">
                        {{ $form->title }}
                    </option>

                    @endforeach

                </select>

                <input type="date" wire:model.live="date" class="rounded-lg border-gray-300">

                <select wire:model.live="sort" class="rounded-lg border-gray-300">

                    <option value="latest">
                        Latest First
                    </option>

                    <option value="oldest">
                        Oldest First
                    </option>

                </select>

            </div>

            <div class="mt-4">

                <button wire:click="resetFilters" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">

                    Reset Filters

                </button>

            </div>

        </div>
    </div>


    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="text-left px-6 py-4">#</th>

                    <th class="text-left px-6 py-4">Form</th>

                    <th class="text-left px-6 py-4">Submitted At</th>

                    <th class="text-center px-6 py-4">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($responses as $response)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-6 py-4">
                        {{ $response->id }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $response->form->title ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $response->created_at->format('d M Y h:i A') }}
                    </td>

                    <td class="px-6 py-4 text-center">

                        <a href="{{ route('responses.show', $response) }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">

                            View

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center py-8 text-gray-500">

                        No responses found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $responses->links() }}

    </div>

</div>