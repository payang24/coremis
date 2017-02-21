<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\pn_cms\models\CmsDocument */

$this->title = $model->id;
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'simplecms', 'Cms Documents' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="cms-document-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
        <?= Html::a(Yii::t('simplecms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?=Html::a ( Yii::t ( 'simplecms', 'Delete' ), [ 'delete','id' => $model->id ], [ 'class' => 'btn btn-danger','data' => [ 'confirm' => Yii::t ( 'simplecms', 'Are you sure you want to delete this item?' ),'method' => 'post' ] ] )?>
    </p>

    <?=DetailView::widget ( [ 'model' => $model,'attributes' => [ 'id','language','file_name','file_path','mime_type' ] ] )?>

</div>
