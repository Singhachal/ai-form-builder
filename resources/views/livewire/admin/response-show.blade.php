<div class="max-w-5xl mx-auto py-8">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold">
                Response Details
            </h1>

            <p class="text-gray-500 mt-1">
                {{ $response->form->title }}
            </p>

        </div>

        <a
            href="{{ route('responses.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">

            ← Back

        </a>

    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">

        <div class="grid grid-cols-2 gap-6 mb-8">

            <div>
                <p class="text-gray-500">Submission ID</p>
                <p class="font-semibold">{{ $response->id }}</p>
            </div>

            <div>
                <p class="text-gray-500">Submitted At</p>
                <p class="font-semibold">
                    {{ $response->created_at->format('d M Y h:i A') }}
                </p>
            </div>

        </div>

        <hr class="mb-6">

        @foreach($response->values as $value)

            <div class="mb-6">

                <label class="block font-semibold text-gray-700 mb-2">

                    {{ $value->field->label }}

                </label>

                <div class="bg-gray-100 rounded-lg px-4 py-3">

                    {{ $value->value ?: '-' }}

                </div>

            </div>

        @endforeach

    </div>

</div>