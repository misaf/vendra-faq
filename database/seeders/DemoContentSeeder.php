<?php

declare(strict_types=1);

namespace Misaf\VendraFaq\Database\Seeders;

use Illuminate\Support\Facades\Validator;
use Misaf\VendraFaq\Database\Factories\FaqCategoryFactory;
use Misaf\VendraFaq\Database\Factories\FaqFactory;
use Misaf\VendraFaq\Models\FaqCategory;
use Misaf\VendraSupport\Database\Seeders\DemoContentSeeder as BaseDemoContentSeeder;
use Misaf\VendraTenant\Concerns\RequiresCurrentTenant;
use Misaf\VendraTenant\Models\Tenant;

final class DemoContentSeeder extends BaseDemoContentSeeder
{
    use RequiresCurrentTenant;

    protected function seedFactories(): void
    {
        $tenant = $this->currentTenant();

        $this->seedFactoryRecords($tenant);
    }

    /**
     * @param list<array<string, mixed>> $records
     */
    protected function seedFixtures(array $records): void
    {
        $tenant = $this->currentTenant();

        foreach ($records as $record) {
            $this->seedFixtureRecord($tenant, $record);
        }
    }

    protected function seedFactoryRecords(Tenant $tenant): void
    {
        FaqCategoryFactory::new()
            ->forTenant($tenant)
            ->enabled()
            ->count(4)
            ->create()
            ->each(fn(FaqCategory $faqCategory): mixed => FaqFactory::new()
                ->forCategory($faqCategory)
                ->enabled()
                ->count(3)
                ->create());
    }

    protected function seedFixtureRecord(Tenant $tenant, array $record): void
    {
        $data = $this->validatedFixtureRecord($record);

        $this->handleSeedFixtureRecord($tenant, $data);
    }

    /**
     * @param array{
     *     name: non-empty-array<string, string>,
     *     description: non-empty-array<string, string>,
     *     slug: non-empty-array<string, string>,
     *     status: bool,
     *     faqs: list<array{
     *         name: non-empty-array<string, string>,
     *         description: non-empty-array<string, string>,
     *         slug: non-empty-array<string, string>,
     *         status: bool
     *     }>
     * } $data
     */
    private function handleSeedFixtureRecord(Tenant $tenant, array $data): void
    {
        $faqCategory = new FaqCategory([
            'name'        => $data['name'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'status'      => $data['status'],
        ]);

        $faqCategory->tenant_id = $tenant->id;
        $faqCategory->save();

        foreach ($data['faqs'] as $faqRecord) {
            $this->handleFaqFixtureRecord($tenant, $faqCategory, $faqRecord);
        }
    }

    /**
     * @param array{
     *     name: non-empty-array<string, string>,
     *     description: non-empty-array<string, string>,
     *     slug: non-empty-array<string, string>,
     *     status: bool
     * } $faqRecord
     */
    private function handleFaqFixtureRecord(Tenant $tenant, FaqCategory $faqCategory, array $faqRecord): void
    {
        $faq = $faqCategory->faqs()->make([
            'name'        => $faqRecord['name'],
            'description' => $faqRecord['description'],
            'slug'        => $faqRecord['slug'],
            'status'      => $faqRecord['status'],
        ]);

        $faq->tenant_id = $tenant->id;
        $faq->save();
    }

    /**
     * @param array<string, mixed> $record
     *
     * @return array{
     *     name: non-empty-array<string, string>,
     *     description: non-empty-array<string, string>,
     *     slug: non-empty-array<string, string>,
     *     status: bool,
     *     faqs: list<array{
     *         name: non-empty-array<string, string>,
     *         description: non-empty-array<string, string>,
     *         slug: non-empty-array<string, string>,
     *         status: bool
     *     }>
     * }
     */
    private function validatedFixtureRecord(array $record): array
    {
        /** @var array{
         *     name: non-empty-array<string, string>,
         *     description: non-empty-array<string, string>,
         *     slug: non-empty-array<string, string>,
         *     status: bool,
         *     faqs: list<array{
         *         name: non-empty-array<string, string>,
         *         description: non-empty-array<string, string>,
         *         slug: non-empty-array<string, string>,
         *         status: bool
         *     }>
         * } $validated
         */
        $validated = Validator::make(
            data: $record,
            rules: [
                'name'                     => ['required', 'array', 'min:1'],
                'name.*'                   => ['required', 'string'],
                'description'              => ['required', 'array', 'min:1'],
                'description.*'            => ['required', 'string'],
                'slug'                     => ['required', 'array', 'min:1'],
                'slug.*'                   => ['required', 'string'],
                'status'                   => ['required', 'boolean'],
                'faqs'                     => ['required', 'array', 'list'],
                'faqs.*'                   => ['required', 'array:name,description,slug,status'],
                'faqs.*.name'              => ['required', 'array', 'min:1'],
                'faqs.*.name.*'            => ['required', 'string'],
                'faqs.*.description'       => ['required', 'array', 'min:1'],
                'faqs.*.description.*'     => ['required', 'string'],
                'faqs.*.slug'              => ['required', 'array', 'min:1'],
                'faqs.*.slug.*'            => ['required', 'string'],
                'faqs.*.status'            => ['required', 'boolean'],
            ],
        )->validate();

        return $validated;
    }

}
