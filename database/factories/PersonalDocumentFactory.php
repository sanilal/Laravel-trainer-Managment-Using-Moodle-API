<?php


namespace Database\Factories;

use App\Models\PersonalDocument;
use App\Models\TrainerProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalDocumentFactory extends Factory
{
    protected $model = PersonalDocument::class;

    public function definition(): array
    {
        return [
            'profile_id' => TrainerProfile::factory(), // Assuming TrainerProfileFactory exists
            'user_id' => 1, // Replace with dynamic user ID if needed
            'your_id' => 'uploads/your_id_sample.pdf',
            'your_passport' => 'uploads/passport_sample.pdf',
            'other_document' => 'uploads/other_doc_sample.pdf',
            'other_document2' => 'uploads/other_doc2_sample.pdf',
        ];
    }
}
