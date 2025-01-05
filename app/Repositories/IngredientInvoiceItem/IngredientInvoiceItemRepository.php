<?php

namespace App\Repositories\IngredientInvoiceItem;

use App\Models\IngredientInvoiceItem;
use App\Presenters\IngredientInvoiceItemPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class IngredientInvoiceItemRepository
 *
 * @package namespace App\Repositories\User;
 */
class IngredientInvoiceItemRepository extends BaseRepository implements IngredientInvoiceItemRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return IngredientInvoiceItem::class;
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
        return IngredientInvoiceItemPresenter::class;
    }


    protected $fieldSearchable = [
        'id' => 'like',
    ];
}
