<div class="max-w-7xl mx-auto p-6">

@if(session()->has('success'))

    <div class="mb-5 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">

        {{ session('success') }}

    </div>

@endif
    <!-- Heading -->

    <div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold">
            AI Form Builder
        </h1>

        <p class="text-gray-500">
            Manage all forms from one place
        </p>
    </div>

    <!-- Buttons -->
    <div class="flex items-center gap-3">

        <a href="{{ route('forms.import') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm">
            📥 Import
        </a>

        <a href="{{ route('forms.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg text-sm">
            + Create
        </a>

    </div>

</div>

    <!-- Statistics -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">

        <div class="bg-white rounded-xl shadow p-6">

            <h3 class="text-gray-500">

                Total Forms

            </h3>

            <p class="text-3xl font-bold mt-2">

                {{ $totalForms }}

            </p>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <h3 class="text-gray-500">

                Active

            </h3>

            <p class="text-3xl font-bold text-green-600 mt-2">

                {{ $activeForms }}

            </p>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <h3 class="text-gray-500">

                Public

            </h3>

            <p class="text-3xl font-bold text-blue-600 mt-2">

                {{ $publicForms }}

            </p>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <h3 class="text-gray-500">

                Total Submissions

            </h3>

            <p class="text-3xl font-bold text-purple-600 mt-2">

                {{ $totalSubmissions }}

            </p>

        </div>

    </div>

    <!-- Search -->

    <div class="bg-white rounded-xl shadow p-5 mb-6">

        <input
            wire:model.live.debounce.500ms="search"
            type="text"
            placeholder="Search by title or description..."
            class="w-full rounded-lg border-gray-300">

    </div>

    <!-- Loading -->

    <div
        wire:loading
        class="mb-4 text-blue-600">

        Searching...

    </div>

    <!-- Table -->

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-5 py-4 text-left">

                        Title

                    </th>

                    <th class="px-5 py-4">

                        Status

                    </th>

                    <th class="px-5 py-4">

                        Public

                    </th>

                    <th class="px-5 py-4">

                        Fields

                    </th>

                    <th class="px-5 py-4">

                        Submissions

                    </th>

                    <th class="px-5 py-4">

                        Action

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($forms as $form)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-5 py-4">

                            <div class="font-semibold">

                                {{ $form->title }}

                            </div>

                            <div class="text-gray-500 text-sm">

                                {{ \Illuminate\Support\Str::limit($form->description,60) }}

                            </div>

                        </td>

                        <td class="text-center">

                            @if($form->is_active)

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">

                                    Active

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">

                                    Inactive

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            @if($form->is_public)

                                🌍

                            @else

                                🔒

                            @endif

                        </td>

                        <td class="text-center">

                            {{ $form->fields_count }}

                        </td>

                        <td class="text-center">

                            {{ $form->submissions_count }}

                        </td>

                        <td>

                            <div class="flex justify-center gap-2">

                                <a
                                    href="{{ route('forms.edit',$form) }}"
                                    class="bg-blue-600 text-white px-3 py-1 rounded">

                                    Edit

                                </a>

                                <a
                                    href="{{ route('forms.preview',$form) }}"
                                    target="_blank"
                                    class="bg-green-600 text-white px-3 py-1 rounded">

                                    Preview

                                </a>

                                <a href="{{ route('forms.analytics', $form) }}"
                                class="bg-purple-600 text-white px-4 py-2 rounded">
                                    Analytics
                                </a>
                                <a href="{{ route('responses.index', $form->id) }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg">
                                    Responses
                                </a>

                               <button
                                wire:click="delete({{ $form->id }})"
                                wire:confirm="Are you sure you want to delete this form?"
                                class="bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-10 text-gray-500">

                            No Forms Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $forms->links() }}

    </div>

</div>