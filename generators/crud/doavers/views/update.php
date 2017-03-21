<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Update {modelClass}: ', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?> . ' ' . $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Update') ?>;
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-update">
	<div class="box box-default">
	    <div class="box-header with-border">
	        <h3 class="box-title">Actions</h3>
	        <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	        </div>
	    </div>
	    <div class="box-body text-right">
	        <?= "<?=" ?> Html::a('<i class="fa fa-tasks"></i> Manage', ['index'], ['class' => 'btn bg-navy']) ?>
	    </div>
	</div>

	<div class="row">
	    <div class="col-lg-8 col-lg-offset-2">
	        <div class="box">
	            <div class="box-body">
	               	<?= "<?= " ?>$this->render('_form', [
				        'model' => $model,
				    ]) ?>
	            </div>
	        </div>
	    </div>
	</div>
</div>
