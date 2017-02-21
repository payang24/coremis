<?php

namespace yii2mod\c3\chart;

use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Yii wrapper for D3-based reusable chart library `c3`
 * ~~~
 *      echo \app\widgets\chart\Chart::widget([
 *        'clientOptions' => [
 *              'data' => [
 *                   'columns' => [
 *                      ['data2', 130, 300, 200, 300, 250, 450]
 *                    ]
 *              ]
 *        ]
 *     ])
 * ~~~
 */
class Chart extends Widget
{
    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     */
    public function run()
    {
        echo Html::tag('div', '', ['id' => $this->options['id']]);
        $this->registerAssets();
        parent::run();
    }

    /**
     * Register assets
     */
    protected function registerAssets()
    {
        $id = $this->options['id'];
        $view = $this->getView();
        ChartAsset::register($view);
        $options = Json::encode($this->getClientOptions());
        $view->registerJs("var {$id} = c3.generate({$options});", $view::POS_END);
    }


    /**
     * Get client options
     * @return string
     */
    protected function getClientOptions()
    {
        $id = $this->options['id'];
        $this->clientOptions['bindto'] = '#' . $id;
        return $this->clientOptions;
    }

}
