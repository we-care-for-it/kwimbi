<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ObjectBuildingType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObjectBuildingTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_object::building::type');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ObjectBuildingType $objectBuildingType): bool
    {
        return $user->can('view_object::building::type');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_object::building::type');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ObjectBuildingType $objectBuildingType): bool
    {
        return $user->can('update_object::building::type');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ObjectBuildingType $objectBuildingType): bool
    {
        return $user->can('delete_object::building::type');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_object::building::type');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, ObjectBuildingType $objectBuildingType): bool
    {
        return $user->can('force_delete_object::building::type');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_object::building::type');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, ObjectBuildingType $objectBuildingType): bool
    {
        return $user->can('restore_object::building::type');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_object::building::type');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, ObjectBuildingType $objectBuildingType): bool
    {
        return $user->can('replicate_object::building::type');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_object::building::type');
    }
}
