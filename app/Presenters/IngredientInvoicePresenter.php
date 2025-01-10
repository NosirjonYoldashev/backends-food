<?php

namespace App\Presenters;

use App\Transformers\IngredientInvoice\IngredientInvoiceTransformer;
use League\Fractal\TransformerAbstract;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class .
 *
 * @package namespace App\Presenters;
 */
class IngredientInvoicePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return IngredientInvoiceTransformer|TransformerAbstract
     */
    public function getTransformer(): IngredientInvoiceTransformer|TransformerAbstract
    {
        return new IngredientInvoiceTransformer();
    }
}
