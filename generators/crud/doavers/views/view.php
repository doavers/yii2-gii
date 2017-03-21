<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Actions</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body text-right">
        <?= "<?= " ?>Html::a('<i class="fa fa-plus"></i> Create', ['create'], ['class' => 'btn btn-success']) ?>
        <?= "<?= " ?>Html::a('<i class="fa fa-edit"></i> Update', ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::a('<i class="fa fa-trash"></i> Delete', ['delete', <?= $urlParams ?>], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= "<?= " ?>Html::a('<i class="fa fa-tasks"></i> Manage', ['index'], ['class' => 'btn bg-navy']) ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <?= "<?= " ?>DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table table-hover'],
                    'attributes' => [
            <?php
            $count = 0;
            if (($tableSchema = $generator->getTableSchema()) === false) 
            {
                foreach ($generator->getColumnNames() as $name) 
                {
                    $count++;
                    if ($count == 1) 
                        echo "\t\t\t'" . $name . "',\n";
                    else
                        echo "\t\t\t\t\t\t'" . $name . "',\n";

                }
            } 
            else 
            {
                foreach ($generator->getTableSchema()->columns as $column) 
                {
                    $count++;
                    $format = $generator->generateColumnFormat($column);
                    if ($count == 1) 
                        echo "\t\t\t'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                    else
                        echo "\t\t\t\t\t\t'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                }
            }
            ?>
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>