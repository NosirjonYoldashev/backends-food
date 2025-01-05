<?php

namespace App\Services;


use App\Models\IngredientInvoiceItem;
use App\Repositories\IngredientInvoiceItem\IngredientInvoiceItemRepository;
use App\Transformers\IngredientInvoiceItemTransformer;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;

class IngredientInvoiceItemService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, IngredientInvoiceItemRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all(): array
    {
        return $this->formatData($this->repository->paginate(),'ingredient_invoice_items');
    }


    public function show(IngredientInvoiceItem $supplier): array
    {
        $fractal = new Manager();
        $resource = new Item($supplier, new IngredientInvoiceItemTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'ingredient_invoice_item');
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
    public function update(IngredientInvoiceItem $supplier, $data): array
    {
        $updated_data = $this->repository->skipPresenter()->update($data,$supplier->id);

        return $this->show($updated_data);
    }

    public function delete(IngredientInvoiceItem $supplier)
    {
        return $supplier->delete();
    }


}
