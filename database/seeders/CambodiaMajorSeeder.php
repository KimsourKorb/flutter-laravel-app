<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Major, University, Category};

class CambodiaMajorSeeder extends Seeder
{
    public function run(): void
    {
        // ── Categories ───────────────────────────────────────────────────────
        $engineering = Category::firstOrCreate(['slug' => 'engineering'],
            ['name' => 'Engineering', 'description' => 'Engineering and technology']);

        $science = Category::firstOrCreate(['slug' => 'science'],
            ['name' => 'Science', 'description' => 'Natural and physical sciences']);

        $business = Category::firstOrCreate(['slug' => 'business'],
            ['name' => 'Business', 'description' => 'Business and management']);

        $arts = Category::firstOrCreate(['slug' => 'arts'],
            ['name' => 'Arts', 'description' => 'Arts and humanities']);

        $law = Category::firstOrCreate(['slug' => 'law'],
            ['name' => 'Law', 'description' => 'Law and legal studies']);

        $health = Category::firstOrCreate(['slug' => 'health'],
            ['name' => 'Health Sciences', 'description' => 'Medicine and health']);

        $education = Category::firstOrCreate(['slug' => 'education'],
            ['name' => 'Education', 'description' => 'Teaching and education']);

        $it = Category::firstOrCreate(['slug' => 'information-technology'],
            ['name' => 'Information Technology', 'description' => 'IT and computer systems']);

        // ── University shortcuts ─────────────────────────────────────────────
        $rupp    = University::where('name', 'like', '%Royal University of Phnom Penh%')->first();
        $rule    = University::where('name', 'like', '%Royal University of Law%')->first();
        $itc     = University::where('name', 'like', '%Institute of Technology of Cambodia%')->first();
        $num     = University::where('name', 'like', '%National University of Management%')->first();
        $rua     = University::where('name', 'like', '%Royal University of Agriculture%')->first();
        $uhs     = University::where('name', 'like', '%University of Health Sciences%')->first();
        $ubb     = University::where('name', 'like', '%University of Battambang%')->first();
        $rufa    = University::where('name', 'like', '%Royal University of Fine Arts%')->first();
        $puc     = University::where('name', 'like', '%Paññāsāstra%')->first();
        $aupp    = University::where('name', 'like', '%American University%')->first();
        $bbu     = University::where('name', 'like', '%Build Bright%')->first();
        $norton  = University::where('name', 'like', '%Norton University%')->first();
        $ppiu    = University::where('name', 'like', '%Phnom Penh International%')->first();
        $kit     = University::where('name', 'like', '%Kirirom%')->first();
        $paragon = University::where('name', 'like', '%Paragon%')->first();
        $western = University::where('name', 'like', '%Western University%')->first();
        $aeu     = University::where('name', 'like', '%Asia Euro%')->first();
        $beltei  = University::where('name', 'like', '%Beltei%')->first();

        // ── Majors with university links ─────────────────────────────────────
        $majors = [
            [
                'name' => 'Computer Science',
                'description' => 'Study of computation, algorithms, data structures, software engineering, and artificial intelligence. Graduates work in software development, AI, and data science.',
                'category_id' => $it->id,
                'duration_years' => 4,
                'universities' => array_filter([$rupp, $itc, $puc, $aupp, $bbu, $kit, $paragon, $norton, $ppiu]),
            ],
            [
                'name' => 'Information Technology',
                'description' => 'Covers network infrastructure, cybersecurity, database management, and enterprise systems. Practical focus on deploying and managing IT systems.',
                'category_id' => $it->id,
                'duration_years' => 4,
                'universities' => array_filter([$rupp, $itc, $bbu, $ubb, $norton, $ppiu, $aeu, $western]),
            ],
            [
                'name' => 'Software Engineering',
                'description' => 'Systematic approach to software design, development, testing, and maintenance. Emphasises engineering principles and team-based development practices.',
                'category_id' => $engineering->id,
                'duration_years' => 4,
                'universities' => array_filter([$itc, $kit, $paragon, $aupp]),
            ],
            [
                'name' => 'Civil Engineering',
                'description' => 'Design and construction of infrastructure including roads, bridges, buildings, and water systems. Core to Cambodia\'s rapid development.',
                'category_id' => $engineering->id,
                'duration_years' => 5,
                'universities' => array_filter([$itc, $bbu, $paragon]),
            ],
            [
                'name' => 'Electrical Engineering',
                'description' => 'Study of electrical systems, electronics, power generation, and telecommunications. Graduates work in energy, manufacturing, and technology sectors.',
                'category_id' => $engineering->id,
                'duration_years' => 5,
                'universities' => array_filter([$itc, $paragon]),
            ],
            [
                'name' => 'Business Administration',
                'description' => 'Comprehensive study of management, marketing, finance, operations, and strategy. One of the most popular programmes in Cambodia.',
                'category_id' => $business->id,
                'duration_years' => 4,
                'universities' => array_filter([$num, $puc, $aupp, $bbu, $norton, $ppiu, $western, $aeu, $ubb]),
            ],
            [
                'name' => 'Accounting & Finance',
                'description' => 'Financial reporting, auditing, taxation, and corporate finance. High demand in Cambodia\'s growing banking and business sectors.',
                'category_id' => $business->id,
                'duration_years' => 4,
                'universities' => array_filter([$num, $rule, $bbu, $western, $norton, $ppiu, $aeu]),
            ],
            [
                'name' => 'Economics',
                'description' => 'Microeconomics, macroeconomics, development economics, and quantitative methods. Prepares graduates for roles in government, banking, and research.',
                'category_id' => $business->id,
                'duration_years' => 4,
                'universities' => array_filter([$rule, $num, $rupp, $puc, $aupp, $aeu]),
            ],
            [
                'name' => 'International Relations',
                'description' => 'Diplomacy, foreign policy, international law, and ASEAN studies. Particularly relevant given Cambodia\'s active role in regional affairs.',
                'category_id' => $arts->id,
                'duration_years' => 4,
                'universities' => array_filter([$rupp, $rule, $puc, $aupp]),
            ],
            [
                'name' => 'Law',
                'description' => 'Cambodian civil law, criminal law, commercial law, and international law. RULE is the premier institution for legal education in Cambodia.',
                'category_id' => $law->id,
                'duration_years' => 4,
                'universities' => array_filter([$rule, $rupp, $bbu, $ppiu, $aeu, $ubb]),
            ],
            [
                'name' => 'Medicine',
                'description' => 'Six-year programme covering pre-clinical and clinical training. Graduates serve as medical doctors across Cambodia\'s public and private healthcare system.',
                'category_id' => $health->id,
                'duration_years' => 6,
                'universities' => array_filter([$uhs]),
            ],
            [
                'name' => 'Pharmacy',
                'description' => 'Drug development, pharmacology, clinical pharmacy, and pharmaceutical sciences. UHS is the primary provider of pharmacy education in Cambodia.',
                'category_id' => $health->id,
                'duration_years' => 5,
                'universities' => array_filter([$uhs]),
            ],
            [
                'name' => 'Nursing',
                'description' => 'Clinical nursing practice, patient care, and community health. Addresses Cambodia\'s critical need for trained healthcare workers.',
                'category_id' => $health->id,
                'duration_years' => 4,
                'universities' => array_filter([$uhs, $bbu, $ppiu]),
            ],
            [
                'name' => 'Education',
                'description' => 'Pedagogy, curriculum development, educational psychology, and classroom management. Graduates become teachers and education administrators.',
                'category_id' => $education->id,
                'duration_years' => 4,
                'universities' => array_filter([$rupp, $bbu, $ubb, $norton, $beltei, $ppiu]),
            ],
            [
                'name' => 'English Language & Literature',
                'description' => 'English linguistics, literature, translation, and communication. High demand given English\'s role as Cambodia\'s primary language for business and tourism.',
                'category_id' => $arts->id,
                'duration_years' => 4,
                'universities' => array_filter([$rupp, $puc, $aupp, $bbu, $norton, $beltei]),
            ],
            [
                'name' => 'Tourism & Hospitality Management',
                'description' => 'Hotel management, tour operations, event planning, and sustainable tourism. Central to Cambodia\'s economy anchored by Angkor Wat and growing eco-tourism.',
                'category_id' => $business->id,
                'duration_years' => 4,
                'universities' => array_filter([$rupp, $puc, $bbu, $ppiu, $aeu]),
            ],
            [
                'name' => 'Agriculture',
                'description' => 'Crop science, animal husbandry, agribusiness, and sustainable farming practices. Essential to Cambodia\'s largely agrarian economy.',
                'category_id' => $science->id,
                'duration_years' => 4,
                'universities' => array_filter([$rua]),
            ],
            [
                'name' => 'Environmental Science',
                'description' => 'Environmental management, ecology, climate change, and natural resource conservation. Growing importance given Cambodia\'s deforestation and climate challenges.',
                'category_id' => $science->id,
                'duration_years' => 4,
                'universities' => array_filter([$rupp, $rua, $itc]),
            ],
            [
                'name' => 'Architecture',
                'description' => 'Architectural design, urban planning, and construction management with a focus on integrating modern design with Khmer cultural heritage.',
                'category_id' => $engineering->id,
                'duration_years' => 5,
                'universities' => array_filter([$rufa, $itc]),
            ],
            [
                'name' => 'Fine Arts & Visual Arts',
                'description' => 'Traditional Khmer painting, sculpture, and contemporary visual arts. RUFA is the leading institution preserving and advancing Cambodian artistic heritage.',
                'category_id' => $arts->id,
                'duration_years' => 4,
                'universities' => array_filter([$rufa]),
            ],
        ];

        foreach ($majors as $data) {
            $universities = $data['universities'];
            unset($data['universities']);

            $major = Major::updateOrCreate(['name' => $data['name']], array_merge($data, ['is_active' => true]));

            // Sync university relationships
            $ids = array_map(fn($u) => $u->id, $universities);
            $major->universities()->syncWithoutDetaching($ids);
        }

        $this->command->info('✅ Cambodia majors seeded: ' . count($majors) . ' majors with university links.');
    }
}