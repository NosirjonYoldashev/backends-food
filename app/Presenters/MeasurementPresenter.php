<?php

namespace App\Presenters;

use App\Transformers\MeasurementTransformer;
use League\Fractal\TransformerAbstract;
use Override;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class .
 *
 * @package namespace App\Presenters;
 */
class MeasurementPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return MeasurementTransformer|TransformerAbstract
     */
    #[Override]
    public function getTransformer(): MeasurementTransformer|TransformerAbstract
    {
        return new MeasurementTransformer();
    }
}
