<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\pn_cms\models\CmsMenuItem */

$this->title = Yii::t ( 'simplecms', 'Update {modelClass}: ', [ 
		'modelClass' => 'Cms Menu Item' 
] ) . ' ' . $model->name;
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'simplecms', 'Cms Menu Items' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = [ 
		'label' => $model->name,
		'url' => [ 
				'view',
				'id' => $model->id 
		] 
];
$this->params ['breadcrumbs'] [] = Yii::t ( 'simplecms', 'Update' );
?>
<div class="cms-menu-item-update">

	<h1><?= Html::encode($this->title) ?></h1>

    <?=$this->render ( '_form', [ 'model' => $model ] )?>

</div>
