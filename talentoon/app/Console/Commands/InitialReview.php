<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\InitialReviewController;

class InitialReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InitialReview:initialreviewcalculations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to determine talent\'s level and give him talent role';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $initial_review=new InitialReviewController();
        $calculation=$initial_review->calculate_level_talent_status();
    }
}
