<?php

namespace App\Presenters;

use App\Transformers\SupplierTransformer;
use League\Fractal\TransformerAbstract;
use Override;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class .
 *
 * @package namespace App\Presenters;
 */
class SupplierPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return SupplierTransformer|TransformerAbstract
     */
    #[Override]
    public function getTransformer(): SupplierTransformer|TransformerAbstract
    {
        return new SupplierTransformer();
    }
}
