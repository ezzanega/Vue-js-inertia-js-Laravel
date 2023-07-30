<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TaskProService
{

    public $baseUrl;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->baseUrl = env('TASKPRO_API');
    }


    public function login($email, $password)
    {
        $response = Http::post($this->baseUrl . '/user/login', [
            'email' => $email,
            'password' => $password,
        ]);
        return $response->json();
    }


    public function register($firstName, $lastName, $email,  $password)
    {
        $response = Http::post($this->baseUrl . '/user', [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password,
        ]);
        return $response->json();
    }

    public function addMember($projectId, $user)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $user->taskpro_token,
        ])->post($this->baseUrl . "/project/$projectId/member", [
            'userId' =>  $user->taskpro_user_id,
            'email' => $user->email,
        ]);

        $invitationId = $response->json()['invitationId'];

        $result = Http::withHeaders([
            'Authorization' => 'Token ' . $user->taskpro_token,
        ])->post($this->baseUrl . '/user/invitation/accept', [
            'invitationId' => $invitationId
        ]);

        return $result->json();
    }

    public function createOrganization($name, $user)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $user->taskpro_token,
        ])->post($this->baseUrl . '/project', [
            'name' => $name,
        ]);

        return $response->json();
    }


    public function createTask($title, $projectId)
    {

        $response = Http::withHeaders([
            'Authorization' => 'Token ' . auth()->user()->taskpro_token,
        ])->post($this->baseUrl . '/task', [
            'title' => $title,
            'project' => $projectId,
            'board' => 1,
            'order' => 0
        ]);

        return $response->json();
    }
}
