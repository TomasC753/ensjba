<?php

namespace App\Console\Commands;

use App\Models\Period;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class addPhase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:addPhase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add a phase to the year';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pre_periods = Period::all();
        $period = new Period;

        if($pre_periods->count() != 0)
        {
            $last_period = $pre_periods->last();
            if ($last_period->name == 'Primer Trimestre') $period->name = 'Segundo Trimestre';
            if ($last_period->name == 'Segundo Trimestre') $period->name = 'Tercer Trimestre';
            if ($last_period->name == 'Tercer Trimestre') {
                $res = $this->confirm('¿Desea promover a todos los estudiantes aprobados?', false);
                if($res) 
                {

                } else {}

                $period->name ='Primer Trimestre';
                $period->start = Carbon::parse($last_period->end)->addDays(88);
                $period->end = Carbon::parse($last_period->end)->addDays(88)->addMonths(3);
                $period->save();
                $this->info('Periodo Creado exitosamente!');

                return Command::SUCCESS;
            }
            $period->start = Carbon::parse($last_period->end)->addDay();
            $period->end = Carbon::parse($last_period->end)->addDay()->addMonths(3);
            $period->save();

        } else {
            $period->name ='Primer Trimestre';
            $period->start = new Carbon("1-3-".Carbon::now()->year);
            $period->end = new Carbon("1-6-".Carbon::now()->year);
            $period->save();
        }

        $this->info('Periodo Creado exitosamente!');
        return Command::SUCCESS;
    }
}
