<?php

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new quertion bigger than 255 chars', function () {
    // Arrange
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert
    $request->assertRedirect(route('dashboard'));

    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
    ]);

});

it('should check if ends with question mark', function () {
    // Arrange
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    // Assert
    $request->assertSessionHasErrors([
        'question' => 'Are you sure that is a question? It is missing the quertion mark in the end.',
    ]);

    assertDatabaseCount('questions', 0);
});

it('should have at least 10 charracteres', function () {
    // Arrange
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    // Assert
    $request->assertSessionHasErrors(
        ['question' => __('validation.min.string', ['attribute' => 'question', 'min' => 10])]
    );

    assertDatabaseCount('questions', 0);
});
