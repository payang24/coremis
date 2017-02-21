<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\pn_cms\models\CmsMenuItem */

$this->title = Yii::t ( 'simplecms', 'Create {modelClass}', [ 
		'modelClass' => 'Cms Menu Item' 
] );
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'simplecms', 'Cms Menu Items' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="cms-menu-item-create">

	<h1><?= Html::encode($this->title) ?></h1>

    <?=$this->render ( '_form', [ 'model' => $model ] )?>

</div>
