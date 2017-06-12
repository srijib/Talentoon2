<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Http\Controllers\CompetitionPostPointsController;
use App\Services\CompetitionPostPointsService;
use App\Http\Controllers\CompetitionPostController;
use App\Services\CompetitionPostService;

class MentorApprovePosts extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MentorApprovePosts:mentorapproves';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mentor approve qulified talents';

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

        $service =new CompetitionPostService();
        $competition_calculations=new CompetitionPostController($service);
        $competition_calculations->check();

    }
}
