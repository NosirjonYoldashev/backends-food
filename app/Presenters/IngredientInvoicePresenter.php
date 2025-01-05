<?php

namespace App\Presenters;

use App\Transformers\IngredientInvoiceTransformer;
use League\Fractal\TransformerAbstract;
use Override;
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
    #[Override]
    public function getTransformer(): IngredientInvoiceTransformer|TransformerAbstract
    {
        return new IngredientInvoiceTransformer();
    }
}
