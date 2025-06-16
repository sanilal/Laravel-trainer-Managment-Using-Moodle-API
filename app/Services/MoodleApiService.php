<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MoodleApiService
{
    protected $apiUrl;
    protected $apiToken;
    protected $apiFormat;

    public function __construct()
    {
        $this->apiUrl = config('services.moodle.api_url');
        $this->apiToken = config('services.moodle.api_token');
        $this->apiFormat = config('services.moodle.api_format');
    }

    /**
     * Make a request to the Moodle API.
     */
    private function request($function, $params = [])
    {
        $params['wstoken'] = $this->apiToken;
        $params['moodlewsrestformat'] = $this->apiFormat;
        $params['wsfunction'] = $function;

        // Measure start time before request
        $startTime = microtime(true);

     //   $response = Http::get($this->apiUrl, $params);

     $response = Http::withOptions([
        'verify' => false, // <<< Add this line
    ])->get($this->apiUrl, $params);

        // Measure end time after request
        $endTime = microtime(true);

        // Calculate the total time taken for the request
        $responseTime = $endTime - $startTime;

        // Log the response time
        Log::info('Moodle API Response Time', ['time' => $responseTime]);

        if ($response->failed()) {
            Log::error("Moodle API Request Failed: $function", [
                'params' => $params,
                'response' => $response->body(),
            ]);
            return null;
        }

        $data = $response->json();

        // Log successful response
        Log::info("Moodle API Response: $function", ['response' => $data]);

        return $data;
    }

    /**
     * Get user details by email.
     */
    public function getUserByEmail($email)
    {
        $data = $this->request('core_user_get_users', [
            'criteria[0][key]' => 'email',
            'criteria[0][value]' => $email,
        ]);

        return $data['users'][0] ?? null;
    }

    /**
     * Get user details by ID.
     */
    public function getUserById($id)
    {
        $data = $this->request('core_user_get_users_by_field', [
            'field' => 'id',
            'values[0]' => $id,
        ]);

        return $data[0] ?? null;
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

    /**
     * Get all users (for debugging or admin purposes).
     */
    public function getUsers($emailPrefix = null)
    {
        $value = $emailPrefix ? $emailPrefix . '%' : 'a%'; // default to 'a%' if no prefix
        return $this->request('core_user_get_users', [
            'criteria[0][key]' => 'email',
            'criteria[0][value]' => $value
        ]);
    }

    public function getUsersByPrefix($emailValue)
{
    return $this->request('core_user_get_users', [
        'criteria[0][key]' => 'email',
        'criteria[0][value]' => $emailValue
    ]);
}

    

  public function getAllUsers()
{
    $allUsers = [];
    $prefixes = array_merge(range('a', 'z'), range('0', '9')); // a-z + 0-9

    foreach ($prefixes as $prefix) {
        $response = $this->request('core_user_get_users', [
            'criteria[0][key]'   => 'email',
            'criteria[0][value]' => $prefix . '%',
        ]);

        $users = $response['users'] ?? [];

        // Optional: Log response size for each prefix
        \Log::info('Fetched users for prefix ' . $prefix, ['count' => count($users)]);

        $allUsers = array_merge($allUsers, $users);
    }

    // Deduplicate users by ID
    $uniqueUsers = collect($allUsers)->unique('id')->values()->all();

    \Log::info('getAllUsers total loaded', ['count' => count($uniqueUsers)]);

    return ['users' => $uniqueUsers];
}



public function getUsersByEmailPrefix($prefix = 'a')
{
    $value = $prefix . '%';
    return $this->request('core_user_get_users', [
        'criteria[0][key]' => 'email',
        'criteria[0][value]' => $value
    ]);
}

    
    
}
