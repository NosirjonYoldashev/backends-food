<?php

namespace App\Services;


use App\Models\Ingredient;
use App\Repositories\Ingredient\IngredientRepository;
use App\Transformers\IngredientTransformer;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;

class IngredientService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, IngredientRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all(): array
    {
        return $this->formatData($this->repository->paginate(),'ingredients');
    }


    public function show(Ingredient $ingredient): array
    {
        $fractal = new Manager();
        $resource = new Item($ingredient, new IngredientTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'ingredient');
    }


    /**
     * @throws ValidatorException
     */
    public function create($data): array
    {

        $ingredient =  $this->repository->skipPresenter()->create($data);

        $ingredient->refresh();
        return $this->show($ingredient);
    }


    /**
     * @throws ValidatorException
     */
    public function update(Ingredient $ingredient, $data): array
    {
        $updated_data = $this->repository->skipPresenter()->update($data,$ingredient->id);

        return $this->show($updated_data);
    }

    public function delete(Ingredient $ingredient)
    {
        return $ingredient->delete();
    }


}
