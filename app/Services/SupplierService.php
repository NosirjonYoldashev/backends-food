<?php

namespace App\Services;


use App\Models\Supplier;
use App\Repositories\Supplier\SupplierRepository;
use App\Transformers\SupplierTransformer;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;

class SupplierService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, SupplierRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all(): array
    {
        return $this->formatData($this->repository->paginate(),'suppliers');
    }


    public function show(Supplier $supplier): array
    {
        $fractal = new Manager();
        $resource = new Item($supplier, new SupplierTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'supplier');
    }


    /**
     * @throws ValidatorException
     */
    public function create($data): array
    {

        $supplier =  $this->repository->skipPresenter()->create($data);

        $supplier->refresh();
       return $this->show($supplier);
    }


    /**
     * @throws ValidatorException
     */
    public function update(Supplier $supplier, $data): array
    {
        $updated_data = $this->repository->skipPresenter()->update($data,$supplier->id);

        return $this->show($updated_data);
    }

    public function delete(Supplier $supplier)
    {
        return $supplier->delete();
    }


}
