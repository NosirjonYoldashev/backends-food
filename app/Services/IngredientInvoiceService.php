<?php

namespace App\Services;


use App\Enums\InvoiceEnum;
use App\Enums\MovementProductType;
use App\Models\IngredientInvoice;
use App\Models\IngredientInvoiceItem;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Presenters\IngredientInvoicePresenter;
use App\Repositories\IngredientInvoice\IngredientInvoiceRepository;
use App\Transformers\IngredientInvoice\IngredientInvoiceTransformer;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;
use RuntimeException;
use Throwable;

class IngredientInvoiceService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, IngredientInvoiceRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all(): array
    {
        return $this->formatData($this->repository->setPresenter(IngredientInvoicePresenter::class)->paginate(),'ingredient_invoices');
    }


    public function show(IngredientInvoice $color): array
    {
        $fractal = new Manager();
        $resource = new Item($color, new IngredientInvoiceTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'ingredient_invoice');
    }


    /**
     * @throws ValidatorException
     */
    public function create($data): array
    {
        try{
            $this->beginTransaction();

            $ingredient_invoice =  $this->repository->create([
                'user_id' => auth('api')->user()?->id,
                'status' => 'draft'
            ]);

            $ingredient_invoice = $this->updateItems($ingredient_invoice, $data);

            $this->commit();

            return $this->show($ingredient_invoice);


        }catch (Throwable $e){
            throw new RuntimeException($e->getMessage());
        }
    }


    /**
     */
    public function update(IngredientInvoice $ingredient_invoice, $data): array
    {

        try{
            $this->beginTransaction();

            $ingredient_invoice->IngredientInvoiceItems()->delete();

            $updated_data = $this->updateItems($ingredient_invoice, $data);

            $this->commit();

            return $this->show($updated_data);


        }catch (Throwable $e){
            throw new RuntimeException($e->getMessage());
        }



    }


    public function reject(IngredientInvoice $ingredient_invoice): array
    {
        $ingredient_invoice->update([
            'status' => InvoiceEnum::REJECTED
        ]);

        return $this->show($ingredient_invoice);
    }

    /**
     * @throws Exception|Throwable
     */
    public function confirm(IngredientInvoice $ingredient_invoice): array
    {

        try{
            $this->beginTransaction();

            $ingredient_invoice->update([
                'status' => InvoiceEnum::CONFIRMED
            ]);


            foreach ($ingredient_invoice->items as $item) {
                $stock = Stock::createOrFirst([
                    'ingredient_id' => $item->ingredient_id,
                    'arrival_price' => $item->arrival_price,
                    'price' => $item->price,
                    'date_expire' => $item->date_expire,
                ]);

                $stock->update([
                    'quantity' => $stock->quantity + $item->quantity
                ]);

                StockMovement::create([
                    'stock_id' => $stock->id,
                    'ingredient_invoice_id' => $ingredient_invoice->id,
                    'user_id' => auth('api')->user()?->id,
                    'type' => MovementProductType::ARRIVAL,
                    'quantity' => $item->quantity,
                    'date_expire' => $item->date_expire,
                    'description' => $item->description,
                ]);
            }


            $this->commit();

            return $this->show($ingredient_invoice);
        }catch (Throwable $e){
            throw new RuntimeException($e->getMessage());
        }
    }

    protected function updateItems(IngredientInvoice $ingredient_invoice, $data):IngredientInvoice
    {
        $sum = 0;

        foreach ( $data['items']  as  $item) {
            $sum += $item['price'] * $item['quantity'];
            IngredientInvoiceItem::create([
                'ingredient_invoice_id' => $ingredient_invoice->id,
                'ingredient_id' => $item['ingredient_id'],
                'quantity' => $item['quantity'],
                'arrival_price' => $item['arrival_price'],
                'price' => $item['price'],
                'date_expire' => Carbon::create($item['date_expire'])?->format('Y-m-d'),
            ]);
        }

        $ingredient_invoice->update([
            'total_amount' => $sum
        ]);

        return $ingredient_invoice;
    }


    protected function checkStatus(IngredientInvoice $ingredient_invoice)
    {

    }



}
