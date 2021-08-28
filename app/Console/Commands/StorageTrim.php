<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Orchid\Attachment\Models\Attachment;

class StorageTrim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:trim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $files = Attachment::doesntHave('relationships')->get();
        $files->each->delete();

        // $bar = $this->output->createProgressBar(count($files));

        // $bar->start();

        // foreach ($users as $user) {
        //     $this->performTask($user);

        //     $bar->advance();
        // }

        // $bar->finish();
    }
}
