<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
use yii\widgets\Pjax;
use <?= $generator->indexWidgetType === 'grid' ? "common\\widgets\\DoGridView" : "" ?>;
use common\widgets\DoPjax;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
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
    </div>
</div>

<?= "<?php" ?> DoPjax::begin(['id'=>'gridview-pjax', 'timeout' => false, 'enablePushState' => true]); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of <?= "<?= " ?>Html::encode($this->title) ?></h3>
                <div class="box-tools">
                    <?= "<?=" ?> DoGridView::widget([
                        'id'            => 'gridview-summary',
                        'dataProvider'  => $dataProvider,
                        'filterModel'   => $searchModel,
                        'layout'        => "{summary}",
                    ]); ?>
                </div>
            </div>

            <?php if(!empty($generator->searchModelClass)): ?>
            <?= "<?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php endif; ?>

            <div class="box-body table-responsive no-padding">
            <?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?= " ?>DoGridView::widget([
                    'id'            => 'gridview-items',
                    'dataProvider'  => $dataProvider,
                    <?= !empty($generator->searchModelClass) ? "'filterModel'   => \$searchModel,\n\t\t\t\t\t'layout'\t\t=> \"{items}\",\n\t\t\t\t\t'columns'   \t=> [\n" : "'columns'\t\t=> [\n"; ?>
                        ['class' => 'yii\grid\SerialColumn'],

            <?php
            $count = 0;
            if (($tableSchema = $generator->getTableSchema()) === false) 
            {
                foreach ($generator->getColumnNames() as $name) 
                {
                    if (++$count < 6) 
                    {
                        if($count == 1)
                            echo "\t\t\t//'" . $name . "',\n";
                        else
                            echo "\t\t\t\t\t\t'" . $name . "',\n";
                    }
                    else 
                    {
                        echo "\t\t\t\t\t\t// '" . $name . "',\n";
                    }
                }
            } 
            else 
            {
                foreach ($tableSchema->columns as $column) 
                {
                    $format = $generator->generateColumnFormat($column);
                    if (++$count < 6) 
                    {
                        if($count == 1)
                            echo "\t\t\t//'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        else
                            echo "\t\t\t\t\t\t'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                    } 
                    else 
                    {
                        echo "\t\t\t\t\t\t// '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                    }
                }
            }
            ?>

                        [
                            'class'     => 'yii\grid\ActionColumn',
                            'header'    => '<center>Action</center>',
                            'template'  => '<center>{view} &nbsp;&nbsp; {update} &nbsp;&nbsp; {delete}</center>',
                            'contentOptions' => ['style'=>'min-width: 90px;'],
                        ],
                    ],
                ]); ?>
            <?php else: ?>
                <?= "<?= " ?>ListView::widget([
                    'id'            => 'listview',
                    'dataProvider'  => $dataProvider,
                    'itemOptions'   => ['class' => 'item'],
                    'itemView'      => function ($model, $key, $index, $widget) {
                        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                    },
                ]) ?>
            <?php endif; ?>
            
            </div>

            <div class="box-footer clearfix">
                <?= "<?= " ?>DoGridView::widget([
                    'id'            => 'gridview-pager',
                    'dataProvider'  => $dataProvider,
                    'filterModel'   => $searchModel,
                    'layout'        => "{pager}",
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?= "<?php" ?> DoPjax::end(); ?>