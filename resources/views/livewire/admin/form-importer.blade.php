<div class="max-w-3xl mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6">
        Import Form
    </h1>

    @if(session()->has('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">

        <input
            type="file"
            wire:model="file"
            class="mb-5">

        @error('file')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        <button
            wire:click="import"
            class="bg-indigo-600 text-white px-5 py-3 rounded-lg">

            Import Form

        </button>

    </div>

</div>