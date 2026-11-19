<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EateryCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_eatery_can_be_created_with_permit_and_features(): void
    {
        $district = District::create(['name' => 'Poblacion']);
        $feature = Feature::create(['name' => 'Budget Meal']);

        $response = $this->post(route('eateries.store'), [
            'name' => 'Test Eatery',
            'district_id' => $district->id,
            'address' => 'Test Address',
            'price_range' => 'budget',
            'specialty' => 'Test Dish',
            'is_open' => true,
            'features' => [$feature->id],
            'permit_no' => 'DVO-2026-12345',
            'expires_on' => now()->addYear()->format('Y-m-d'),
        ]);

        $eatery = Eatery::where('name', 'Test Eatery')->firstOrFail();

        $response->assertRedirect(route('eateries.show', $eatery));
        $response->assertSessionHas('success', 'Eatery added.');
        $this->assertDatabaseHas('permits', [
            'eatery_id' => $eatery->id,
            'permit_no' => 'DVO-2026-12345',
        ]);
        $this->assertTrue($eatery->features->contains($feature));
    }

    public function test_an_eatery_can_be_updated_and_deleted(): void
    {
        $district = District::create(['name' => 'Poblacion']);
        $feature = Feature::create(['name' => 'Budget Meal']);
        $eatery = Eatery::create([
            'district_id' => $district->id,
            'name' => 'Test Eatery',
            'slug' => 'test-eatery',
            'address' => 'Test Address',
            'price_range' => 'budget',
            'specialty' => 'Test Dish',
            'is_open' => true,
        ]);
        $eatery->permit()->create([
            'permit_no' => 'DVO-2026-11111',
            'expires_on' => now()->addYear(),
        ]);

        $eatery->features()->sync([$feature->id]);

        $update = $this->put(route('eateries.update', $eatery), [
            'name' => 'Updated Eatery',
            'district_id' => $district->id,
            'address' => 'Updated Address',
            'price_range' => 'mid',
            'specialty' => 'Updated Dish',
            'is_open' => false,
            'features' => [$feature->id],
            'permit_no' => 'DVO-2026-11111',
            'expires_on' => now()->addYear()->format('Y-m-d'),
        ]);

        $update->assertRedirect();
        $update->assertSessionHas('success', 'Eatery updated.');
        $this->assertDatabaseHas('eateries', [
            'id' => $eatery->id,
            'name' => 'Updated Eatery',
            'slug' => 'updated-eatery',
            'is_open' => false,
        ]);

        $eatery->refresh();
        $delete = $this->delete(route('eateries.destroy', $eatery));
        $delete->assertRedirect(route('eateries.index'));
        $delete->assertSessionHas('success', 'Eatery deleted.');
        $this->assertDatabaseMissing('eateries', ['id' => $eatery->id]);
    }
}
