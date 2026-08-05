<div class="max-w-4xl mx-auto py-10">

    <div class="bg-white rounded-xl shadow">
@if(session()->has('success'))

<div class="mb-5 bg-green-100 border border-green-300 rounded-lg p-4">

{{ session('success') }}

</div>

@endif
    <form wire:submit="submit">
        <div class="border-b p-6">

            <h1 class="text-3xl font-bold">

                {{ $form->title }}

            </h1>

            <p class="text-gray-500 mt-2">

                {{ $form->description }}

            </p>

        </div>

        <div class="p-6">

            @forelse($form->fields as $field)

            <div class="mb-6">

                <label class="block font-semibold mb-2">

                    {{ $field->label }}

                    @if($field->required)

                        <span class="text-red-500">*</span>

                    @endif

                </label>

                @switch($field->type)

                    @case('textarea')

                        <textarea

                            wire:model="answers.{{ $field->name }}"

                            class="w-full rounded border"

                            placeholder="{{ $field->placeholder }}">

                        </textarea>

                    @break

                    @case('select')

                        <select

                            wire:model="answers.{{ $field->name }}"

                            class="w-full rounded border">

                            <option value="">Choose</option>

                            @foreach($field->options ?? [] as $option)

                                <option value="{{ $option }}">

                                    {{ $option }}

                                </option>

                            @endforeach

                        </select>

                    @break

                    @case('radio')

                        @foreach($field->options ?? [] as $option)

                            <label class="block">

                                <input

                                    type="radio"

                                    value="{{ $option }}"

                                    wire:model="answers.{{ $field->name }}">

                                {{ $option }}

                            </label>

                        @endforeach

                    @break

                    @case('checkbox')

                        @foreach($field->options ?? [] as $option)

                            <label class="block">

                                <input

                                    type="checkbox"

                                    value="{{ $option }}">

                                {{ $option }}

                            </label>

                        @endforeach

                    @break

                    @default

                        <input

                            type="{{ $field->type }}"

                            wire:model="answers.{{ $field->name }}"

                            placeholder="{{ $field->placeholder }}"

                            class="w-full rounded border">

                @endswitch

                @if($field->help_text)

                    <p class="text-sm text-gray-500 mt-1">

                        {{ $field->help_text }}

                    </p>

                @endif

            </div>

            @empty

                <div class="text-center text-gray-500">

                    No fields available.

                </div>

            @endforelse

            <button
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded">

                Submit Form

                </button>

        </div>
        </form>

    </div>

</div>