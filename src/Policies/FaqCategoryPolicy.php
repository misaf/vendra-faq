<?php

declare(strict_types=1);

namespace Misaf\VendraFaq\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Misaf\VendraFaq\Enums\FaqCategoryPolicyEnum;
use Misaf\VendraFaq\Models\FaqCategory;
use Misaf\VendraUser\Models\User;

final class FaqCategoryPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can(FaqCategoryPolicyEnum::CREATE);
    }

    public function delete(User $user, FaqCategory $faqCategory): bool
    {
        return $user->can(FaqCategoryPolicyEnum::DELETE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(FaqCategoryPolicyEnum::DELETE_ANY);
    }

    public function forceDelete(User $user, FaqCategory $faqCategory): bool
    {
        return $user->can(FaqCategoryPolicyEnum::FORCE_DELETE);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can(FaqCategoryPolicyEnum::FORCE_DELETE_ANY);
    }

    public function reorder(User $user): bool
    {
        return $user->can(FaqCategoryPolicyEnum::REORDER);
    }

    public function replicate(User $user, FaqCategory $faqCategory): bool
    {
        return $user->can(FaqCategoryPolicyEnum::REPLICATE);
    }

    public function restore(User $user, FaqCategory $faqCategory): bool
    {
        return $user->can(FaqCategoryPolicyEnum::RESTORE);
    }

    public function restoreAny(User $user): bool
    {
        return $user->can(FaqCategoryPolicyEnum::RESTORE_ANY);
    }

    public function update(User $user, FaqCategory $faqCategory): bool
    {
        return $user->can(FaqCategoryPolicyEnum::UPDATE);
    }

    public function view(User $user, FaqCategory $faqCategory): bool
    {
        return $user->can(FaqCategoryPolicyEnum::VIEW);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(FaqCategoryPolicyEnum::VIEW_ANY);
    }
}
