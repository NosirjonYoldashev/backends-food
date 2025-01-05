<?php

namespace App\Presenters;

use App\Transformers\StockMovementTransformer;
use App\Transformers\SupplierTransformer;
use League\Fractal\TransformerAbstract;
use Override;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class .
 *
 * @package namespace App\Presenters;
 */
class StockMovementPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return StockMovementTransformer|TransformerAbstract
     */
    #[Override]
    public function getTransformer(): StockMovementTransformer|TransformerAbstract
    {
        return new StockMovementTransformer();
    }
}
