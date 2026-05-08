<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);

        $super = User::factory()->create([
            'name' => 'Super',
            'email' => 'super@test.com',
            'password' => bcrypt('12345678'),
        ]);
        $super->assignRole('super-admin');

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');

        $writer = User::factory()->create([
            'name' => 'Writer',
            'email' => 'writer@test.com',
            'password' => bcrypt('12345678'),
        ]);
        $writer->assignRole('writer');

        $this->call([
            ApproachSeeder::class,
            PostSeeder::class,
            VrtoolSeeder::class,
        ]);

        Page::create([
            'slug' => 'about',
            'title' => 'SimSkillApp — Flight Simulation & VR',
            'body' => '<p>SimSkillApp is your go-to resource for flight simulation enthusiasts. We provide detailed approach charts, in-depth articles on flight techniques, VR hardware guides, and a community-driven platform for sharing knowledge about Microsoft Flight Simulator, X-Plane, and virtual reality in aviation.</p><p>Whether you are a seasoned virtual pilot or just starting your journey, our curated content helps you master approaches, optimize your VR setup, and stay up to date with the latest in flight simulation.</p><p>Join our community and take your flight simulation skills to the next level.</p>',
            'image' => asset('images/sim_skill_app_logo.svg'),
        ]);
    }
}
