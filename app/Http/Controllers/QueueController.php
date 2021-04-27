<?php

namespace App\Http\Controllers;

use App\Jobs\ReadQueueJob;
use App\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function store(Request $request){
        $queue=Queue::create($request->all());
        ReadQueueJob::dispatch()->delay(now()->addMinutes(1));
        return $queue;
    }

    public function index(){
        return Queue::all();
    }

}
