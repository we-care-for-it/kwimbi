<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Solutions;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolutionsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_solutions');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Solutions $solutions): bool
    {
        return $user->can('view_solutions');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_solutions');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Solutions $solutions): bool
    {
        return $user->can('update_solutions');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Solutions $solutions): bool
    {
        return $user->can('delete_solutions');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_solutions');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Solutions $solutions): bool
    {
        return $user->can('force_delete_solutions');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_solutions');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Solutions $solutions): bool
    {
        return $user->can('restore_solutions');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_solutions');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Solutions $solutions): bool
    {
        return $user->can('replicate_solutions');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_solutions');
    }
}
