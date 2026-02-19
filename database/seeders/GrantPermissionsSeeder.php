<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Groups;
use App\Models\Modules;

class GrantPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Grant full permissions to Group Administrator
        $group = Groups::where('name', 'Administrator')->first();
        if ($group) {
            $modules = Modules::all();
            $permissions = [];
            foreach ($modules as $module) {
                $permissions[$module->name] = ['view', 'add', 'edit', 'delete','permission'];
            }
            $group->permissions = json_encode($permissions);
            $group->save();
            $this->command->info('Granted full permissions to Group Administrator.');
        } else {
            $this->command->error('Group Administrator not found.');
        }
    }
}
