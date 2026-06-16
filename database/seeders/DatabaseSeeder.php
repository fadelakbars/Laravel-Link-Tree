<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $profile = Profile::factory()->for($user)->create([
            'display_name' => 'Test User',
            'slug' => 'test-user',
            'bio' => 'Contoh profil untuk fondasi proyek link tree.',
        ]);

        Link::factory()->for($profile)->create([
            'title' => 'Portfolio',
            'url' => 'https://example.com/portfolio',
            'sort_order' => 1,
        ]);

        Link::factory()->for($profile)->create([
            'title' => 'WhatsApp',
            'url' => 'https://wa.me/6281234567890',
            'sort_order' => 2,
        ]);
    }
}
