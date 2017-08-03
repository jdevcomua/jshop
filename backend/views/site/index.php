<?php

use common\models\Item;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
/* @var $salesDays array */
/* @var $salesValues array */
/* @var $newOrdersCount int */
/* @var $salesCount int */
/* @var $newVotesCount int */
/* @var $salesValuesMoney array */
/* @var $latestItems Item[] */
/* @var $usersCount integer */

$this->title = 'Home Page';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-12">
            <h4>В этом месяце:</h4>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-bag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Новые заказы</span>
                    <span class="info-box-number"><?= $newOrdersCount; ?></span>
                    <a href="<?= Yii::$app->urlHelper->to(['orders/index', 'OrdersSearch[order_status]' => 'Новый']) ?>"
                       type="button" class="btn btn-block btn-success btn-flat">Показать</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Продажи</span>
                    <span class="info-box-number"><?= $salesCount; ?></span>
                    <a href="<?= Yii::$app->urlHelper->to(['orders/index', 'OrdersSearch[payment_status]' => 'Оплачен']) ?>"
                       type="button" class="btn btn-block btn-info btn-flat">Показать</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-comments-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Отзывы</span>
                    <span class="info-box-number"><?= $newVotesCount; ?></span>
                    <a href="<?= Yii::$app->urlHelper->to(['vote/index', 'VoteSearch[checked]' => '0']) ?>"
                       type="button" class="btn btn-block btn-warning btn-flat">Показать</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Учасники</span>
                    <span class="info-box-number"><?= $usersCount; ?></span>
                    <a href="<?= Yii::$app->urlHelper->to(['user/index', 'sort' => '-created']) ?>"
                       type="button" class="btn btn-block btn-danger btn-flat">Показать</a>
                </div>
            </div>
        </div>
    </div>
    <?php if ($salesCount > 0) { ?>
        <div class="row">

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Продажи в этом месяце</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <?= ChartJs::widget([
                                'type' => 'line',
                                'clientOptions' => [
                                    'scales' => [
                                        'yAxes' => [
                                            [
                                                'ticks' => [
                                                    'min' => 0.0
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                'data' => [
                                    'labels' => $salesDays,
                                    'datasets' => [
                                        [
                                            'label' => "Продано товаров (шт.)",
                                            'fill' => true,
                                            'lineTension' => 0.1,
                                            'backgroundColor' => "rgba(75,192,192,0.4)",
                                            'borderColor' => "rgba(75,192,192,1)",
                                            'borderCapStyle' => 'butt',
                                            'borderDash' => [],
                                            'borderDashOffset' => 0.0,
                                            'borderJoinStyle' => 'miter',
                                            'pointBorderColor' => "rgba(75,192,192,1)",
                                            'pointBackgroundColor' => "#fff",
                                            'pointBorderWidth' => 1,
                                            'pointHoverRadius' => 5,
                                            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
                                            'pointHoverBorderColor' => "rgba(220,220,220,1)",
                                            'pointHoverBorderWidth' => 2,
                                            'pointRadius' => 1,
                                            'pointHitRadius' => 10,
                                            'data' => $salesValues,
                                            'spanGaps' => false
                                        ],
                                    ]
                                ]
                            ]); ?>
                        </div>
                        <p>Всего: <?= array_sum($salesValues) ?> шт.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Продажи в этом месяце</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <?= ChartJs::widget([
                                'type' => 'line',
                                'clientOptions' => [
                                    'scales' => [
                                        'yAxes' => [
                                            [
                                                'ticks' => [
                                                    'min' => 0.0
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                'data' => [
                                    'labels' => $salesDays,
                                    'datasets' => [
                                        [
                                            'label' => "Продано товаров (грн.)",
                                            'fill' => true,
                                            'lineTension' => 0.1,
                                            'backgroundColor' => "rgba(75,192,192,0.4)",
                                            'borderColor' => "rgba(75,192,192,1)",
                                            'borderCapStyle' => 'butt',
                                            'borderDash' => [],
                                            'borderDashOffset' => 0.0,
                                            'borderJoinStyle' => 'miter',
                                            'pointBorderColor' => "rgba(75,192,192,1)",
                                            'pointBackgroundColor' => "#fff",
                                            'pointBorderWidth' => 1,
                                            'pointHoverRadius' => 5,
                                            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
                                            'pointHoverBorderColor' => "rgba(220,220,220,1)",
                                            'pointHoverBorderWidth' => 2,
                                            'pointRadius' => 1,
                                            'pointHitRadius' => 10,
                                            'data' => $salesValuesMoney,
                                            'spanGaps' => false
                                        ],
                                    ]
                                ]
                            ]); ?>
                        </div>
                        <p>Всего: <?= array_sum($salesValuesMoney) ?> грн.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Последние добавленные товары: </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Товар</th>
                                    <th>Цена</th>
                                    <th>Дата добавления</th>
                                    <th>Просмотров</th>
                                    <th>Продаж</th>
                                </tr>
                                <?php foreach ($latestItems as $item) {
                                    $images = $item->getImageUrl(); ?>
                                    <tr style="vertical-align: middle;">
                                        <td>
                                            <a href="<?= Yii::$app->urlHelper->to(['item/view', 'id' => $item->id]); ?>">
                                                <img style="width: 50px;" src="<?= array_shift($images); ?>">
                                                <?= $item->title; ?>
                                            </a>
                                        </td>
                                        <td><?= $item->cost; ?></td>
                                        <td><?= $item->addition_date; ?></td>
                                        <td><?= $item->count_of_views; ?></td>
                                        <td><?= $item->count; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-center">
                    <a href="<?= Yii::$app->urlHelper->to(['item/index']); ?>" class="uppercase">Все товары</a>
                </div>
            </div>
        </div>
    </div>
</div>