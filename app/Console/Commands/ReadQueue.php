<?php

namespace App\Console\Commands;

use App\Check;
use App\Queue;
use Exception;
use Illuminate\Console\Command;

class ReadQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:queue';

    private $check;
    private $queue;
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

        $this->queue=new Queue();
        $this->check=new Check();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $queues=$this->queue->all();

        if ($queues){
            foreach ($queues as $queue){
                $this->check->create([
                    'queue_id'=>$queue->id,
                    'name'=>$queue->name,
                ]);
                $queue->delete();
                $this->info('deleted');
            }
        }
        else{
            $this->check->create([
                'queue_id'=>-1,
                'name'=>'not found',
            ]);
            $this->info('not found');
        }
    }
}
