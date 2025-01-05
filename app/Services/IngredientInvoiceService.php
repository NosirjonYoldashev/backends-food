<?php

namespace App\Services;


use App\Models\IngredientInvoice;
use App\Repositories\IngredientInvoice\IngredientInvoiceRepository;
use App\Transformers\IngredientInvoiceTransformer;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;

class IngredientInvoiceService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, IngredientInvoiceRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all(): array
    {
        return $this->formatData($this->repository->paginate(),'ingredient_invoices');
    }


    public function show(IngredientInvoice $supplier): array
    {
        $fractal = new Manager();
        $resource = new Item($supplier, new IngredientInvoiceTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'ingredient_invoice');
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
    public function update(IngredientInvoice $supplier, $data): array
    {
        $updated_data = $this->repository->skipPresenter()->update($data,$supplier->id);

        return $this->show($updated_data);
    }

    public function delete(IngredientInvoice $supplier)
    {
        return $supplier->delete();
    }


}
