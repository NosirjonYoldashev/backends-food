<?php

namespace App\Services;


use App\Models\StockMovement;
use App\Repositories\StockMovement\StockMovementRepository;
use App\Repositories\StockMovement\StockMovementRepositoryInterface;
use App\Transformers\StockMovementTransformer;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;

class StockMovementService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, StockMovementRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all(): array
    {
        return $this->formatData($this->repository->paginate(),'stock_movements');
    }


    public function show(StockMovement $stock_movement): array
    {
        $fractal = new Manager();
        $resource = new Item($stock_movement, new StockMovementTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'stock_movement');
    }


    /**
     * @throws ValidatorException
     */
    public function create($data): array
    {

        $stock_movement =  $this->repository->skipPresenter()->create($data);

        $stock_movement->refresh();
        return $this->show($stock_movement);
    }


    /**
     * @throws ValidatorException
     */
    public function update(StockMovement $stock_movement, $data): array
    {
        $updated_data = $this->repository->skipPresenter()->update($data,$stock_movement->id);

        return $this->show($updated_data);
    }

    public function delete(StockMovement $stock_movement)
    {
        return $stock_movement->delete();
    }


}
