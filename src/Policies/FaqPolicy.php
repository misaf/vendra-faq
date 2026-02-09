<?php

declare(strict_types=1);

namespace Misaf\VendraFaq\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Misaf\VendraFaq\Enums\FaqPolicyEnum;
use Misaf\VendraFaq\Models\Faq;
use Misaf\VendraUser\Models\User;

final class FaqPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can(FaqPolicyEnum::CREATE);
    }

    public function delete(User $user, Faq $faq): bool
    {
        return $user->can(FaqPolicyEnum::DELETE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(FaqPolicyEnum::DELETE_ANY);
    }

    public function forceDelete(User $user, Faq $faq): bool
    {
        return $user->can(FaqPolicyEnum::FORCE_DELETE);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can(FaqPolicyEnum::FORCE_DELETE_ANY);
    }

    public function reorder(User $user): bool
    {
        return $user->can(FaqPolicyEnum::REORDER);
    }

    public function replicate(User $user, Faq $faq): bool
    {
        return $user->can(FaqPolicyEnum::REPLICATE);
    }

    public function restore(User $user, Faq $faq): bool
    {
        return $user->can(FaqPolicyEnum::RESTORE);
    }

    public function restoreAny(User $user): bool
    {
        return $user->can(FaqPolicyEnum::RESTORE_ANY);
    }

    public function update(User $user, Faq $faq): bool
    {
        return $user->can(FaqPolicyEnum::UPDATE);
    }

    public function view(User $user, Faq $faq): bool
    {
        return $user->can(FaqPolicyEnum::VIEW);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(FaqPolicyEnum::VIEW_ANY);
    }
}
