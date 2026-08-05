<div class="max-w-5xl mx-auto py-10">

    @if(session()->has('success'))

        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 rounded-lg p-4">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

    <div class="bg-white rounded-xl shadow-lg">

        <div class="border-b p-6">

            <h1 class="text-3xl font-bold">
                AI Form Generator
            </h1>

            <p class="text-gray-500 mt-2">
                Describe your form in plain English and AI will generate it automatically.
            </p>

        </div>

        <div class="p-6">

            <form wire:submit="generate">

                <label class="block font-semibold mb-3">

                    Enter Prompt

                </label>

                <textarea
                    wire:model="prompt"
                    rows="8"
                    class="w-full rounded-lg border-gray-300"
                    placeholder="Example:
Create an Employee Registration Form with Name, Email, Phone, Department, Gender and Resume Upload"></textarea>

                @error('prompt')

                    <p class="text-red-500 mt-2">
                        {{ $message }}
                    </p>

                @enderror

                <div class="mt-6">

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">

                        <span wire:loading.remove>

                            Generate Form

                        </span>

                        <span wire:loading>

                            Generating...

                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div class="bg-blue-50 rounded-xl mt-8 p-6">

        <h2 class="font-bold text-xl mb-4">

            Example Prompts

        </h2>

        <ul class="space-y-3 list-disc ml-6 text-gray-700">

            <li>Create an Employee Registration Form.</li>

            <li>Create a Student Admission Form.</li>

            <li>Create a Customer Feedback Form.</li>

            <li>Create a Job Application Form.</li>

            <li>Create an Event Registration Form.</li>

        </ul>

    </div>

</div>