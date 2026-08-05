<div class="max-w-7xl mx-auto py-8">

    @if(session()->has('success'))
        <div class="mb-5 bg-green-100 border border-green-300 text-green-700 rounded-lg p-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold">
                {{ $form->title }}
            </h1>

            <p class="text-gray-500">
                Dynamic Form Builder
            </p>
        </div>

        <div class="flex gap-3">

            <button
                wire:click="addField"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg">

                + Add Field

            </button>

            <button
                wire:click="saveFields"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg">

                Save Fields

            </button>

        </div>

    </div>

    @forelse($fields as $index => $field)

    <!-- Field Card -->

    <div class="bg-white rounded-xl shadow-lg border mb-6">

        <!-- Card Header -->

        <div class="flex justify-between items-center bg-gray-100 p-4 rounded-t-xl">

            <div>

                <h3 class="font-bold text-lg">

                    {{ $field['label'] ?: 'Untitled Field' }}

                </h3>

                <small class="text-gray-500">

                    {{ strtoupper($field['type']) }}

                </small>

            </div>

            <div class="flex gap-2">

                <button
                    wire:click="moveUp({{ $index }})"
                    class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">

                    ↑

                </button>

                <button
                    wire:click="moveDown({{ $index }})"
                    class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">

                    ↓

                </button>

                <button
                    wire:click="duplicateField({{ $index }})"
                    class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">

                    Copy

                </button>

                <button
                    wire:click="toggleCollapse({{ $index }})"
                    class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">

                    {{ ($collapsed[$index] ?? false) ? 'Expand' : 'Collapse' }}

                </button>

                <button
                    wire:click="removeField({{ $index }})"
                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">

                    Delete

                </button>

            </div>

        </div>

        @if(!$collapsed[$index])

        <!-- Card Body -->

        <div class="p-6">

            <div class="grid grid-cols-2 gap-5">

                <div>

                    <label class="block mb-2 font-medium">

                        Label

                    </label>

                    <input
                        type="text"
                       wire:model.blur="fields.{{ $index }}.label"
                        class="w-full rounded border-gray-300">

                </div>

                <div>

                    <label class="block mb-2 font-medium">

                        Name

                    </label>

                    <input
                        type="text"
                        wire:model="fields.{{ $index }}.name"
                        readonly
                        class="w-full rounded border-gray-300 bg-gray-100">

                </div>

                <div>

                    <label class="block mb-2 font-medium">

                        Type

                    </label>

                    <select
                       wire:model.defer="fields.{{ $index }}.type"
                        class="w-full rounded border-gray-300">

                        <option value="text">Text</option>
                        <option value="email">Email</option>
                        <option value="number">Number</option>
                        <option value="textarea">Textarea</option>
                        <option value="date">Date</option>
                        <option value="select">Select</option>
                        <option value="radio">Radio</option>
                        <option value="checkbox">Checkbox</option>

                    </select>

                </div>

                <div>

                    <label class="block mb-2 font-medium">

                        Placeholder

                    </label>

                    <input
                        type="text"
                        wire:model.defer="fields.{{ $index }}.placeholder"
                        class="w-full rounded border-gray-300">

                </div>

            </div>

            <div class="mt-5">

                <label class="flex items-center">

                    <input
                        type="checkbox"
                        wire:model.defer="fields.{{ $index }}.required">

                    <span class="ml-2">

                        Required

                    </span>

                </label>

            </div>

            @if(in_array($field['type'], ['select','radio','checkbox']))

            <div class="mt-5">

                <label class="block mb-2 font-medium">

                    Options

                </label>

                <textarea
                    rows="4"
                    wire:model.defer="fields.{{ $index }}.options"
                    class="w-full rounded border-gray-300"
                    placeholder="One option per line"></textarea>

            </div>

            @endif

            <div class="mt-5">

                <label class="block mb-2 font-medium">

                    Help Text

                </label>

                <input
                    type="text"
                    wire:model.defer="fields.{{ $index }}.help_text"
                    class="w-full rounded border-gray-300">

            </div>

        </div>

        @endif

    </div>

    @empty

    <div class="bg-white rounded-xl shadow p-10 text-center text-gray-500">

        No fields added.

    </div>

    @endforelse

    @if(count($fields))

    <!-- Live Preview -->

    <div class="bg-blue-50 rounded-xl p-6 mt-8">

        <h2 class="font-bold text-xl mb-6">

            Live Preview

        </h2>

        @foreach($fields as $field)

        <div class="mb-6">

            <label class="block font-medium mb-2">

                {{ $field['label'] ?: 'Untitled Field' }}

                @if($field['required'])

                    <span class="text-red-500">*</span>

                @endif

            </label>

            @switch($field['type'])

                @case('textarea')

                    <textarea
                        class="w-full rounded border-gray-300"
                        placeholder="{{ $field['placeholder'] }}"></textarea>

                @break

                @case('select')

                    <select class="w-full rounded border-gray-300">

                        <option>Select</option>

                        @foreach(explode("\n",$field['options']) as $option)

                            @if(trim($option)!='')

                                <option>{{ $option }}</option>

                            @endif

                        @endforeach

                    </select>

                @break

                @case('checkbox')

                    <input type="checkbox">

                @break

                @case('radio')

                    @foreach(explode("\n",$field['options']) as $option)

                        @if(trim($option)!='')

                            <label class="block">

                                <input type="radio">

                                {{ $option }}

                            </label>

                        @endif

                    @endforeach

                @break

                @default

                    <input
                        type="{{ $field['type'] }}"
                        placeholder="{{ $field['placeholder'] }}"
                        class="w-full rounded border-gray-300">

            @endswitch

            @if($field['help_text'])

                <p class="text-gray-500 text-sm mt-2">

                    {{ $field['help_text'] }}

                </p>

            @endif

        </div>

        @endforeach

    </div>

    @endif

</div>