<?php

namespace App\Policies;

use App\Models\User;
use App\Models\external;
use Illuminate\Auth\Access\HandlesAuthorization;

class externalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_external');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, external $external): bool
    {
        return $user->can('view_external');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_external');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, external $external): bool
    {
        return $user->can('update_external');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, external $external): bool
    {
        return $user->can('delete_external');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_external');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, external $external): bool
    {
        return $user->can('force_delete_external');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_external');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, external $external): bool
    {
        return $user->can('restore_external');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_external');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, external $external): bool
    {
        return $user->can('replicate_external');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_external');
    }
}
