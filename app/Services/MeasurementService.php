<?php

namespace App\Services;


use App\Models\Measurement;
use App\Repositories\Measurement\MeasurementRepository;
use App\Transformers\MeasurementTransformer;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;

class MeasurementService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, MeasurementRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all(): array
    {
        return $this->formatData($this->repository->paginate(),'measurements');
    }


    public function show(Measurement $measurement): array
    {
        $fractal = new Manager();
        $resource = new Item($measurement, new MeasurementTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'MeasurementRequest');
    }


    /**
     * @throws ValidatorException
     */
    public function create($data): array
    {

        $measurement =  $this->repository->skipPresenter()->create($data);

        $measurement->refresh();
        return $this->show($measurement);
    }


    /**
     * @throws ValidatorException
     */
    public function update(Measurement $measurement, $data): array
    {
        $updated_data = $this->repository->skipPresenter()->update($data,$measurement->id);

        return $this->show($updated_data);
    }

    public function delete(Measurement $measurement)
    {
        return $measurement->delete();
    }


}
