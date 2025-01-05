<?php

namespace App\Presenters;

use App\Transformers\StockTransformer;
use League\Fractal\TransformerAbstract;
use Override;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class .
 *
 * @package namespace App\Presenters;
 */
class StockPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return StockTransformer|TransformerAbstract
     */
    #[Override]
    public function getTransformer(): StockTransformer|TransformerAbstract
    {
        return new StockTransformer();
    }
}
