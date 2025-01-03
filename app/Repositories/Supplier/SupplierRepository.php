<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;
use App\Presenters\SupplierPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class SupplierRepository.
 *
 * @package namespace App\Repositories\User;
 */
class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Supplier::class;
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
        return SupplierPresenter::class;
    }


    protected $fieldSearchable = [
        'name' => 'like',
        'phone_number' => 'like',
        'id'
    ];
}
