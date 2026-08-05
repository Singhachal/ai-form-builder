<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class AIFormGenerator
{
    public function generate(string $prompt): array
    {
        $response = OpenAI::chat()->create([

            'model' => 'gpt-4.1-mini',

            'messages' => [

                [
                    'role' => 'system',

                    'content' =>
                        'You are a professional form builder.

Return ONLY valid JSON.

JSON format:

{
"title":"",
"description":"",
"fields":[
{
"label":"",
"type":"",
"required":true,
"placeholder":"",
"help_text":"",
"options":[]
}
]
}

Allowed field types:

text
email
number
date
textarea
select
radio
checkbox

No markdown.

No explanation.

Only JSON.'

                ],

                [
                    'role' => 'user',
                    'content' => $prompt,
                ],

            ],

        ]);

        return json_decode(

            $response->choices[0]->message->content,

            true

        );
    }
}