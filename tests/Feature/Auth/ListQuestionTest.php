<?php

use App\Models\Question;

use function Pest\Laravel\{actingAs, get};

it('should list all the questions', function () {
    // Arrange
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    $questions = Question::factory()->count(5)->create();

    // Act
    $response = get(route('dashboard'));

    // Assert
    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
