<?php

use App\Models\Link;
use App\Models\Profile;

test('public profile page shows active links in order', function () {
    $profile = Profile::factory()->create([
        'display_name' => 'Demo Creator',
        'slug' => 'demo-creator',
        'bio' => 'Creator bio',
    ]);

    Link::factory()->for($profile)->create([
        'title' => 'Second Link',
        'url' => 'https://example.com/second',
        'sort_order' => 2,
        'is_active' => true,
    ]);

    Link::factory()->for($profile)->create([
        'title' => 'Hidden Link',
        'url' => 'https://example.com/hidden',
        'sort_order' => 1,
        'is_active' => false,
    ]);

    Link::factory()->for($profile)->create([
        'title' => 'First Link',
        'url' => 'https://example.com/first',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $response = $this->get(route('profiles.show', $profile));

    $response->assertSuccessful();
    $response->assertSeeInOrder(['First Link', 'Second Link']);
    $response->assertDontSee('Hidden Link');
});

test('missing profile slug returns not found', function () {
    $this->get('/unknown-profile')->assertNotFound();
});
