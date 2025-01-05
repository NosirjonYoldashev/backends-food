<?php

namespace App\Presenters;

use App\Transformers\IngredientInvoiceItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class IngredientInvoiceItemPresenter.
 *
 * @package namespace App\Presenters;
 */
class IngredientInvoiceItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new IngredientInvoiceItemTransformer();
    }
}
