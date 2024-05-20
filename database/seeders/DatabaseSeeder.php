<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->departments();
    }

    private function departments() {
        $names = [
            'IT', 'Medicine', 'Engineering'
        ];

        foreach($names as $name) {
            Department::create([
                'name' => $name,
            ]);
        }
    }

}
