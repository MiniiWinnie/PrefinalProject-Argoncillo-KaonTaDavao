<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_open_eatery_accepts_a_review_and_closed_eatery_is_forbidden(): void
    {
        $district = District::create(['name' => 'Poblacion']);
        $user = User::factory()->create();
        $openEatery = Eatery::create([
            'district_id' => $district->id,
            'name' => 'Open Eatery',
            'slug' => 'open-eatery',
            'address' => 'Test Address',
            'price_range' => 'budget',
            'specialty' => 'Test Dish',
            'is_open' => true,
        ]);

        $post = $this->post(route('eateries.reviews.store', $openEatery), [
            'user_id' => $user->id,
            'rating' => 5,
            'body' => 'This is a good meal and a friendly place.',
        ]);

        $post->assertRedirect(route('eateries.show', $openEatery));
        $post->assertSessionHas('success', 'Salamat! Review posted.');
        $this->assertDatabaseHas('reviews', [
            'eatery_id' => $openEatery->id,
            'user_id' => $user->id,
            'rating' => 5,
        ]);

        $closedEatery = Eatery::create([
            'district_id' => $district->id,
            'name' => 'Closed Eatery',
            'slug' => 'closed-eatery',
            'address' => 'Test Address',
            'price_range' => 'budget',
            'specialty' => 'Test Dish',
            'is_open' => false,
        ]);

        $closedPost = $this->post(route('eateries.reviews.store', $closedEatery), [
            'user_id' => $user->id,
            'rating' => 5,
            'body' => 'This should not be saved.',
        ]);

        $closedPost->assertForbidden();
        $this->assertDatabaseMissing('reviews', ['eatery_id' => $closedEatery->id]);
    }

    public function test_review_validation_and_delete_work(): void
    {
        $district = District::create(['name' => 'Poblacion']);
        $user = User::factory()->create();
        $eatery = Eatery::create([
            'district_id' => $district->id,
            'name' => 'Open Eatery',
            'slug' => 'open-eatery',
            'address' => 'Test Address',
            'price_range' => 'budget',
            'specialty' => 'Test Dish',
            'is_open' => true,
        ]);

        $invalid = $this->post(route('eateries.reviews.store', $eatery), [
            'rating' => 8,
            'body' => 'short',
        ]);

        $invalid->assertSessionHasErrors([
            'user_id' => 'Choose who is writing this review.',
            'rating' => 'Ratings go from 1 to 5 stars only.',
            'body' => 'Kaon Ta Argoncillo: reviews need at least 10 characters.',
        ]);

        $review = Review::create([
            'eatery_id' => $eatery->id,
            'user_id' => $user->id,
            'rating' => 4,
            'body' => 'A valid review body for testing.',
        ]);

        $delete = $this->delete(route('reviews.destroy', $review));
        $delete->assertRedirect(route('eateries.show', $eatery));
        $delete->assertSessionHas('success', 'Review deleted.');
        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
    }
}
