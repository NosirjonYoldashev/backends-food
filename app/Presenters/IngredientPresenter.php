<?php

namespace App\Presenters;

use App\Transformers\IngredientInvoice\IngredientInvoiceAllTransformer;
use App\Transformers\IngredientTransformer;
use League\Fractal\TransformerAbstract;
use Override;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class .
 *
 * @package namespace App\Presenters;
 */
class IngredientPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return IngredientInvoiceAllTransformer|TransformerAbstract
     */
    #[Override]
    public function getTransformer(): IngredientTransformer|TransformerAbstract
    {
        return new IngredientTransformer();
    }
}
