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

    /**
     * Get trainer's enrolled courses.
     */
    public function getTrainerCourses($userId)
    {
        return $this->request('core_enrol_get_users_courses', [
            'userid' => $userId,
        ]);
    }
}
