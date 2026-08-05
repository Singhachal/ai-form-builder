<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-3xl font-bold mb-8">
        Form Analytics
    </h1>

    <div class="mb-6">

    <button
        wire:click="export"
        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg">

        Export CSV

    </button>

</div>

    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-gray-500">
                Total Submissions
            </h2>

            <p class="text-4xl font-bold mt-3">
                {{ $totalSubmissions }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-gray-500">
                Mobile Users
            </h2>

            <p class="text-4xl font-bold mt-3">
                {{ $mobile }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-gray-500">
                Desktop Users
            </h2>

            <p class="text-4xl font-bold mt-3">
                {{ $desktop }}
            </p>
        </div>

    </div>

</div>