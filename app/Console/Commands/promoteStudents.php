<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class promoteStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:promoteStudents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'promotes all students one year except sixth year';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
