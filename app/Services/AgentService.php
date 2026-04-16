<?php

namespace App\Services;

use OpenAI;

class AgentService
{
    protected $client;
    protected $memory = [];

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.key'));
    }

    public function run($goal)
    {
        $steps = [];

        for ($i = 0; $i < 5; $i++) {

            $prompt = $this->buildPrompt($goal, $steps);

            $response = $this->client->chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
            ]);

            $action = $response->choices[0]->message->content;

            $result = $this->executeAction($action);

            $steps[] = [
                'action' => $action,
                'result' => $result
            ];

            if (str_contains(strtolower($action), 'final')) {
                break;
            }
        }

        return $steps;
    }

    private function buildPrompt($goal, $steps)
    {
        return "
        You are an AI agent.

        Goal: $goal

        Previous steps:
        " . json_encode($steps) . "

        Decide next action:
        - search: <query>
        - write: <content>
        - final: <answer>
        ";
    }

    private function executeAction($action)
    {
        if (str_starts_with($action, 'search:')) {
            return $this->search(trim(str_replace('search:', '', $action)));
        }

        if (str_starts_with($action, 'write:')) {
            return $this->write(trim(str_replace('write:', '', $action)));
        }

        if (str_starts_with($action, 'final:')) {
            return $action;
        }

        return "Unknown action";
    }

    private function search($query)
    {
        // Replace with real API later
        return "Search results for: " . $query;
    }

    private function write($content)
    {
        return "Generated content: " . $content;
    }
}