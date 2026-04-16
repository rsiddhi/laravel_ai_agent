<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AgentService;

class AgentController extends Controller
{
    protected $agent;

    public function __construct(AgentService $agent)
    {
        $this->agent = $agent;
    }

    public function run(Request $request)
    {
        $goal = $request->input('goal');

        $result = $this->agent->run($goal);

        return response()->json($result);
    }
}