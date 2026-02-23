<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Category, University, Major, CareerPath, User};
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create categories
        $science = Category::create([
            'name' => 'Science',
            'slug' => 'science',
            'description' => 'Natural and physical sciences',
        ]);

        $engineering = Category::create([
            'name' => 'Engineering',
            'slug' => 'engineering',
            'description' => 'Engineering and technology',
        ]);

        $arts = Category::create([
            'name' => 'Arts',
            'slug' => 'arts',
            'description' => 'Arts and humanities',
        ]);

        $business = Category::create([
            'name' => 'Business',
            'slug' => 'business',
            'description' => 'Business and management',
        ]);

        // Create universities
        $harvard = University::create([
            'name' => 'Harvard University',
            'description' => 'Harvard University is a private Ivy League research university in Cambridge, Massachusetts. Established in 1636, Harvard is the oldest institution of higher learning in the United States.',
            'location' => 'Cambridge, Massachusetts',
            'type' => 'private',
            'ranking' => 1.00,
            'country' => 'USA',
            'city' => 'Cambridge',
            'website' => 'https://www.harvard.edu',
            'admission_requirements' => 'SAT/ACT scores, transcripts, essays, recommendation letters',
        ]);

        $mit = University::create([
            'name' => 'Massachusetts Institute of Technology',
            'description' => 'MIT is a private research university in Cambridge, Massachusetts. Established in 1861, MIT has since then been at the center of the development of modern technology and science.',
            'location' => 'Cambridge, Massachusetts',
            'type' => 'private',
            'ranking' => 2.00,
            'country' => 'USA',
            'city' => 'Cambridge',
            'website' => 'https://www.mit.edu',
            'admission_requirements' => 'SAT/ACT scores, transcripts, essays, recommendation letters',
        ]);

        $stanford = University::create([
            'name' => 'Stanford University',
            'description' => 'Stanford University is a private research university in Stanford, California. Founded in 1885, it is one of the world\'s leading research and teaching institutions.',
            'location' => 'Stanford, California',
            'type' => 'private',
            'ranking' => 3.00,
            'country' => 'USA',
            'city' => 'Stanford',
            'website' => 'https://www.stanford.edu',
            'admission_requirements' => 'SAT/ACT scores, transcripts, essays, recommendation letters',
        ]);

        $oxford = University::create([
            'name' => 'University of Oxford',
            'description' => 'The University of Oxford is a collegiate research university in Oxford, England. There is evidence of teaching as early as 1096.',
            'location' => 'Oxford, England',
            'type' => 'public',
            'ranking' => 4.00,
            'country' => 'UK',
            'city' => 'Oxford',
            'website' => 'https://www.ox.ac.uk',
            'admission_requirements' => 'A-levels, essays, interview',
        ]);

        $cambridge = University::create([
            'name' => 'University of Cambridge',
            'description' => 'The University of Cambridge is a collegiate research university in Cambridge, England. Founded in 1209, it is the second-oldest university in the English-speaking world.',
            'location' => 'Cambridge, England',
            'type' => 'public',
            'ranking' => 5.00,
            'country' => 'UK',
            'city' => 'Cambridge',
            'website' => 'https://www.cam.ac.uk',
            'admission_requirements' => 'A-levels, essays, interview',
        ]);

        // Create majors
        $cs = Major::create([
            'name' => 'Computer Science',
            'description' => 'Computer Science is the study of computation, information, and automation. It includes both theoretical and practical disciplines.',
            'category_id' => $engineering->id,
            'duration_years' => 4,
            'subjects' => json_encode([
                'Programming',
                'Data Structures',
                'Algorithms',
                'Computer Architecture',
                'Operating Systems',
                'Artificial Intelligence',
                'Machine Learning',
                'Networks'
            ]),
        ]);

        $biology = Major::create([
            'name' => 'Biology',
            'description' => 'Biology is the scientific study of life and living organisms, including their structure, function, growth, evolution, and distribution.',
            'category_id' => $science->id,
            'duration_years' => 4,
            'subjects' => json_encode([
                'Cell Biology',
                'Genetics',
                'Ecology',
                'Evolution',
                'Microbiology',
                'Molecular Biology'
            ]),
        ]);

        $businessAdmin = Major::create([
            'name' => 'Business Administration',
            'description' => 'Business Administration covers the performance or management of business operations and decision-making.',
            'category_id' => $business->id,
            'duration_years' => 4,
            'subjects' => json_encode([
                'Management',
                'Marketing',
                'Finance',
                'Economics',
                'Accounting',
                'Business Law'
            ]),
        ]);

        $psychology = Major::create([
            'name' => 'Psychology',
            'description' => 'Psychology is the scientific study of mind and behavior, including conscious and unconscious phenomena.',
            'category_id' => $science->id,
            'duration_years' => 4,
            'subjects' => json_encode([
                'Cognitive Psychology',
                'Developmental Psychology',
                'Social Psychology',
                'Clinical Psychology',
                'Research Methods'
            ]),
        ]);

        $mecEngineering = Major::create([
            'name' => 'Mechanical Engineering',
            'description' => 'Mechanical Engineering is the study of physical machines that may involve force and movement.',
            'category_id' => $engineering->id,
            'duration_years' => 4,
            'subjects' => json_encode([
                'Thermodynamics',
                'Mechanics',
                'Materials Science',
                'Fluid Dynamics',
                'CAD/CAM'
            ]),
        ]);

        // Attach majors to universities
        $cs->universities()->attach([$harvard->id, $mit->id, $stanford->id, $oxford->id, $cambridge->id]);
        $biology->universities()->attach([$harvard->id, $stanford->id, $oxford->id, $cambridge->id]);
        $businessAdmin->universities()->attach([$harvard->id, $stanford->id, $oxford->id]);
        $psychology->universities()->attach([$harvard->id, $stanford->id, $oxford->id, $cambridge->id]);
        $mecEngineering->universities()->attach([$mit->id, $stanford->id, $cambridge->id]);

        // Create career paths
        CareerPath::create([
            'major_id' => $cs->id,
            'title' => 'Software Engineer',
            'description' => 'Design, develop, and maintain software applications and systems.',
            'average_salary' => '$120,000 - $180,000',
            'demand_level' => 'very_high',
        ]);

        CareerPath::create([
            'major_id' => $cs->id,
            'title' => 'Data Scientist',
            'description' => 'Analyze complex data to help organizations make better decisions.',
            'average_salary' => '$110,000 - $160,000',
            'demand_level' => 'very_high',
        ]);

        CareerPath::create([
            'major_id' => $biology->id,
            'title' => 'Research Scientist',
            'description' => 'Conduct research in biological sciences and publish findings.',
            'average_salary' => '$70,000 - $100,000',
            'demand_level' => 'high',
        ]);

        CareerPath::create([
            'major_id' => $businessAdmin->id,
            'title' => 'Business Manager',
            'description' => 'Oversee business operations and manage teams.',
            'average_salary' => '$80,000 - $130,000',
            'demand_level' => 'high',
        ]);

        CareerPath::create([
            'major_id' => $psychology->id,
            'title' => 'Clinical Psychologist',
            'description' => 'Assess and treat mental, emotional, and behavioral disorders.',
            'average_salary' => '$75,000 - $110,000',
            'demand_level' => 'medium',
        ]);

        CareerPath::create([
            'major_id' => $mecEngineering->id,
            'title' => 'Mechanical Engineer',
            'description' => 'Design and build mechanical systems and devices.',
            'average_salary' => '$85,000 - $120,000',
            'demand_level' => 'high',
        ]);
    }
}