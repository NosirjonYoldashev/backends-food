<?php

namespace App\Repositories\Measurement;

use App\Models\Measurement;
use App\Presenters\MeasurementPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class IngredientInvoiceRepository.
 *
 * @package namespace App\Repositories\User;
 */
class MeasurementRepository extends BaseRepository implements MeasurmentRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Measurement::class;
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
        return MeasurementPresenter::class;
    }


    protected $fieldSearchable = [
        'name' => 'like',
        'id'
    ];
}
