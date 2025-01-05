<?php

namespace App\Services;


use App\Models\Stock;
use App\Repositories\Stock\StockRepository;
use App\Transformers\StockTransformer;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;

class StockService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, StockRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all(): array
    {
        return $this->formatData($this->repository->paginate(),'stocks');
    }


    public function show(Stock $stock): array
    {
        $fractal = new Manager();
        $resource = new Item($stock, new StockTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'stock');
    }


    /**
     * @throws ValidatorException
     */
    public function create($data): array
    {

        $stock =  $this->repository->skipPresenter()->create($data);

        $stock->refresh();
        return $this->show($stock);
    }


    /**
     * @throws ValidatorException
     */
    public function update(Stock $stock, $data): array
    {
        $updated_data = $this->repository->skipPresenter()->update($data,$stock->id);

        return $this->show($updated_data);
    }

    public function delete(Stock $stock)
    {
        return $stock->delete();
    }


}
