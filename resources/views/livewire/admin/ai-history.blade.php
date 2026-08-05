<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6">
        AI Generation History
    </h1>

    <div class="bg-white rounded-lg shadow">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-left">Prompt</th>

                    <th class="p-3">Form</th>

                    <th class="p-3">Date</th>

                </tr>

            </thead>

            <tbody>

            @foreach($histories as $history)

                <tr class="border-t">

                    <td class="p-3">
                        {{ $history->prompt }}
                    </td>

                    <td class="p-3">

                        @if($history->form)

                            {{ $history->form->title }}

                        @else

                            Deleted

                        @endif

                    </td>

                    <td class="p-3">

                        {{ $history->created_at->diffForHumans() }}

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    <div class="mt-5">

        {{ $histories->links() }}

    </div>

</div>