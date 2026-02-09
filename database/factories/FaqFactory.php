<?php

declare(strict_types=1);

namespace Misaf\VendraFaq\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Misaf\VendraFaq\Models\Faq;
use Misaf\VendraFaq\Models\FaqCategory;
use Misaf\VendraTenant\Models\Tenant;

/**
 * @extends Factory<Faq>
 */
final class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition(): array
    {
        return [
            'tenant_id'       => Tenant::factory(),
            'faq_category_id' => fn(array $attributes) => FaqCategory::factory()->forTenant($attributes['tenant_id']),
            'name'            => ['en' => fake()->sentences(1, true)],
            'description'     => ['en' => fake()->realTextBetween(100, 200)],
            'slug'            => ['en' => fn(array $attributes) => Str::slug($attributes['name']['en'])],
            'status'          => fake()->boolean(80),
        ];
    }

    public function forTenant(Tenant $tenant): static
    {
        return $this->state(fn(): array => ['tenant_id' => $tenant->id]);
    }

    public function forCategory(FaqCategory $faqCategory): static
    {
        return $this->state(fn(): array => [
            'tenant_id'       => $faqCategory->tenant_id,
            'faq_category_id' => $faqCategory->id,
        ]);
    }

    public function enabled(): static
    {
        return $this->state(fn(): array => ['status' => true]);
    }

    public function disabled(): static
    {
        return $this->state(fn(): array => ['status' => false]);
    }
}
