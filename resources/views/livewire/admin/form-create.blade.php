<div class="max-w-4xl mx-auto py-8">

    <div class="bg-white shadow rounded-xl">

        <div class="border-b p-6">

            <h2 class="text-2xl font-bold">

                Create New Form

            </h2>

            <p class="text-gray-500 mt-1">

                Fill basic information before adding fields.

            </p>

        </div>

        <form wire:submit="save">

            <div class="p-6 space-y-6">

                <div>

                    <label class="block font-medium mb-2">

                        Form Title

                    </label>

                    <input
                        type="text"
                        wire:model.blur="title"
                        class="w-full rounded-lg border-gray-300">

                    @error('title')

                        <p class="text-red-600 text-sm mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <div>

                    <label class="block font-medium mb-2">

                        Description

                    </label>

                    <textarea
                        rows="5"
                        wire:model.blur="description"
                        class="w-full rounded-lg border-gray-300"></textarea>

                    @error('description')

                        <p class="text-red-600 text-sm mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <div class="grid grid-cols-2 gap-5">

                    <label class="flex items-center">

                        <input
                            type="checkbox"
                            wire:model="is_active">

                        <span class="ml-2">

                            Active

                        </span>

                    </label>

                    <label class="flex items-center">

                        <input
                            type="checkbox"
                            wire:model="is_public">

                        <span class="ml-2">

                            Public

                        </span>

                    </label>

                </div>

            </div>

            <div class="border-t bg-gray-50 px-6 py-4 flex justify-end gap-3">

                <a
                    href="{{ route('forms.index') }}"
                    class="px-5 py-2 rounded bg-gray-200">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded">

                    Save Form

                </button>

            </div>

        </form>

    </div>

</div>