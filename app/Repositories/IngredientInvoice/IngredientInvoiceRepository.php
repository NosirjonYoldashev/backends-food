<?php

namespace App\Repositories\IngredientInvoice;

use App\Models\IngredientInvoice;
use App\Presenters\IngredientInvoicePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class IngredientInvoiceRepository.
 *
 * @package namespace App\Repositories\User;
 */
class IngredientInvoiceRepository extends BaseRepository implements IngredientInvoiceRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return IngredientInvoice::class;
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
        return IngredientInvoicePresenter::class;
    }


    protected $fieldSearchable = [
        'name' => 'like',
        'id'
    ];
}
