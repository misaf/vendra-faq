<?php

declare(strict_types=1);

namespace Misaf\VendraFaq\Database\Seeders;

use Misaf\VendraFaq\Enums\FaqCategoryPolicyEnum;
use Misaf\VendraFaq\Enums\FaqPolicyEnum;
use Misaf\VendraFaq\FaqPlugin;
use Misaf\VendraSupport\Database\Seeders\PermissionPolicySeeder as BasePermissionPolicySeeder;
use Misaf\VendraTenant\Concerns\RequiresCurrentTenant;

final class PermissionPolicySeeder extends BasePermissionPolicySeeder
{
    use RequiresCurrentTenant;

    protected const string MODULE_NAME = FaqPlugin::ID;

    public function run(): void
    {
        $tenant = $this->currentTenant();

        $this->seedPermissionPolicies($tenant->getKey());
    }

    /**
     * @return list<string>
     */
    protected function policies(): array
    {
        return [
            ...array_column(FaqCategoryPolicyEnum::cases(), 'value'),
            ...array_column(FaqPolicyEnum::cases(), 'value'),
        ];
    }
}
