<?php

namespace App\Repositories\StockMovement;

use App\Models\StockMovement;
use App\Presenters\StockMovementPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class IngredientInvoiceRepository.
 *
 * @package namespace App\Repositories\User;
 */
class StockMovementRepository extends BaseRepository implements StockMovementRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return StockMovement::class;
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
        return StockMovementPresenter::class;
    }


    protected $fieldSearchable = [
        'name' => 'like',
        'id'
    ];
}
