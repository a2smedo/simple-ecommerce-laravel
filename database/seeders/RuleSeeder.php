<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = ['superadmin', 'admin', 'user'];

        foreach ($rules as $rule) {
          Rule::create([
            'name' => $rule
          ]);
        }
    }
}
