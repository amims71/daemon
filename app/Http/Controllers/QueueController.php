<?php

namespace App\Http\Controllers;

use App\Jobs\ReadQueueJob;
use App\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function store(Request $request){
        $queue=Queue::create($request->all());
        return $queue;
    }

    public function index(){
        return Queue::all();
    }

}
