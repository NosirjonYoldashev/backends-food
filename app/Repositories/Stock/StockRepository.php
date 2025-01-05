<?php

namespace App\Repositories\Stock;

use App\Models\Stock;
use App\Presenters\StockPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class StockRepository.
 *
 * @package namespace App\Repositories\User;
 */
class StockRepository extends BaseRepository implements StockRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Stock::class;
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
        return StockPresenter::class;
    }


    protected $fieldSearchable = [
        'id' => 'like',
    ];
}
