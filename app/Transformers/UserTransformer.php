<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the User entity.
     *
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model): array
    {
        return [
            'id'         => (int) $model->id,
            'username'  => $model->username,
            'name'  => $model->name,
            'roles' => $this->generateRoles($model->roles)
        ];
    }


    public function generateRoles($items)
    {
        return $items->map(function ($item) {
            return (new RoleTransformer())->transform($item);
        })->toArray();
    }
}
