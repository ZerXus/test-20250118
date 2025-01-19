<?php

use App\Modules\Core\Controllers\Controller;
use App\Models\Dictionary;

test('create dictionary', function () {
    $this->actingAs($this->user)
        ->postJson(route('dictionaries.store'), [
            'name' => 'Lorem',
        ])
        ->assertSuccessful()
        ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

    $this->assertDatabaseHas('dictionaries', [
        'name' => 'Lorem',
    ]);
});

test('update dictionary', function () {
    $dictionary = Dictionary::factory()->create();

    $this->actingAs($this->user)
        ->putJson(route('dictionaries.update', $dictionary->id), [
            'name' => 'Updated dictionary',
        ])
        ->assertSuccessful()
        ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

    $this->assertDatabaseHas('dictionaries', [
        'id' => $dictionary->id,
        'name' => 'Updated dictionary',
    ]);
});

test('show dictionary', function () {
    $dictionary = Dictionary::factory()->create();

    $this->actingAs($this->user)
        ->getJson(route('dictionaries.show', $dictionary->id))
        ->assertSuccessful()
        ->assertJson([
            'data' => [
                'name' => $dictionary->name,
            ],
        ]);
});

test('list dictionary', function () {
    $dictionaries = Dictionary::factory()->count(2)->create()->map(function ($dictionary) {
        return $dictionary->only(['id', 'name']);
    });

    $this->actingAs($this->user)
        ->getJson(route('dictionaries.index'))
        ->assertSuccessful()
        ->assertJson([
            'data' => $dictionaries->toArray(),
        ])
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name'],
            ],
            'links',
            'meta',
        ]);
});

test('delete dictionary', function () {
    $dictionary = Dictionary::factory()->create([
        'name' => 'Dictionary for delete',
    ]);

    $this->actingAs($this->user)
        ->deleteJson(route('dictionaries.update', $dictionary->id))
        ->assertSuccessful()
        ->assertJson(['type' => Controller::RESPONSE_TYPE_SUCCESS]);

    $this->assertDatabaseMissing('dictionaries', [
        'id' => $dictionary->id,
        'name' => 'Dictionary for delete',
    ]);
});
