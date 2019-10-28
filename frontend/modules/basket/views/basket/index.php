<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\basket\models\BasketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'attribute' => 'title',
            ],
            [
                'attribute' => 'photo',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',
                'buttons' => [
                    'myButton' => function($url, $model, $key) {
                        return Html::a('Удалить', Url::toRoute(['/basket/basket/del', 'product_id' => $model->id]));
                    }
                ]
            ]

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
