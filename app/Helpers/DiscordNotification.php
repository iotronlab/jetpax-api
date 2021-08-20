<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class DiscordNotification
{
    public function sendDiscordNotification($data)
    {
        return Http::post('https://discord.com/api/webhooks/873604330559774751/Ew0_1bcPS5Nx9AxwIXrFp_nVCndk8ErI-KVaLfSrJHM8h4lTTfgvHKqbSorKMRLigdve', [
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
