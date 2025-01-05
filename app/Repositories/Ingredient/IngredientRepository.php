<?php

namespace App\Repositories\Ingredient;

use App\Models\Ingredient;
use App\Presenters\IngredientPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class IngredientInvoiceRepository.
 *
 * @package namespace App\Repositories\User;
 */
class IngredientRepository extends BaseRepository implements IngredientRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Ingredient::class;
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function presenter(): string
    {
        return IngredientPresenter::class;
    }


    protected $fieldSearchable = [
        'name' => 'like',
        'id'
    ];
}
