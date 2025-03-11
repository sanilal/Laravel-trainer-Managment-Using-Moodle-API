<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoodleApiService
{
    protected $apiUrl;
    protected $apiToken;

    public function __construct()
    {
        $this->apiUrl = config('services.moodle.api_url');
        $this->apiToken = config('services.moodle.api_token');
    }

    /**
     * Make a request to the Moodle API.
     */
    private function request($function, $params = [])
    {
        $params['wstoken'] = $this->apiToken;
        $params['moodlewsrestformat'] = config('services.moodle.api_format');
        $params['wsfunction'] = $function;

        $response = Http::get($this->apiUrl, $params);

        return $response->json();
    }

    /**
     * Get user details by email.
     */
    public function getUserByEmail($email)
    {
        return $this->request('core_user_get_users', [
            'criteria[0][key]' => 'email',
            'criteria[0][value]' => $email,
        ]);
    }

    public function getUserById($id)
    {
        $endpoint = "/webservice/rest/server.php"; 
        $params = [
            'wstoken' => $this->apiToken,
            'wsfunction' => 'core_user_get_users_by_field',
            'moodlewsrestformat' => 'json',
            'field' => 'id',
            'values[0]' => $id
        ];
    
        $response = Http::get($this->apiUrl . $endpoint, $params);
    
        // Debugging - Log the full response
        \Log::info('Moodle API Response:', ['response' => $response->body()]);
    
        return $response->json();
    }


    /**
     * Get trainer's enrolled courses.
     */
    public function getTrainerCourses($userId)
    {
        return $this->request('core_enrol_get_users_courses', [
            'userid' => $userId,
        ]);
    }

    public function getUsers()
    {
        return $this->request('core_user_get_users', [
            'criteria[0][key]' => 'email',
            'criteria[0][value]' => '%'
        ]);
    }

}
