<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-3xl font-bold mb-8">
        Dashboard
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-gray-500">
                Total Forms
            </h2>

            <div class="text-4xl font-bold mt-3">
                {{ $totalForms }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-gray-500">
                Public Forms
            </h2>

            <div class="text-4xl font-bold mt-3">
                {{ $publicForms }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-gray-500">
                Submissions
            </h2>

            <div class="text-4xl font-bold mt-3">
                {{ $totalSubmissions }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-gray-500">
                AI Generated
            </h2>

            <div class="text-4xl font-bold mt-3">
                {{ $totalAIGenerated }}
            </div>
        </div>

    </div>

</div>