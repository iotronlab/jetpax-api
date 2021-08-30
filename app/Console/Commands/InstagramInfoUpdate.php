<?php

namespace App\Console\Commands;

use App\Models\Creator\CreatorSocial;
use Illuminate\Console\Command;
use App\Helpers\Social\InstagramApi;

class InstagramInfoUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Instagram information from Instagram API to our database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $instagram_users = CreatorSocial::where('type', 'Instagram')->get();

        $instagram = new InstagramApi();
        foreach ($instagram_users as $user) {
            $instaInfo = $instagram->instagramApiFn($user->url);

            CreatorSocial::where($user->url, $instaInfo->url)->update([
                "media_count" => $instaInfo->media_count,
                "followers" => $instaInfo->followers,
            ]);
        }
    }
}
