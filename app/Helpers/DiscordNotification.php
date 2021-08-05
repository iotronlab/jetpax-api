<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class DiscordNotification
{
    public function sendDiscordNotification($data)
    {
        return Http::post('https://discord.com/api/webhooks/872117447346499616/8uiuhVYDYt6lrR9pTp3bMC6hvzyfAFk3vV716DluRSqEpK0Qnk4nJp6AJ6fiPqaBoQqD', [
            'content' => "You have a new form submission!",
            'embeds' => [
                [
                    'title' => $data->email,
                    'description' => $data->created_at->toDayDateTimeString(),
                    'color' => '7506394',
                ]
            ],
        ]);
    }
}
