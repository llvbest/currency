<?php
use yii\helpers\Url;
use frontend\models\Currency;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php if (!Yii::$app->user->isGuest):?>
        <div class="current_date">
            <div>Rate for current date (<?=Currency::formatDate();?>):</div>
            <?php
                $rates = Currency::getRates($endDate);
                foreach ($rates as $rate) {
                	echo $rate['baseCurrency'].'/'.$rate['currency'].' - '.$rate['saleRate'].'/'.$rate['purchaseRate'].'<br/>';
                }
            ?>
        </div>
        <hr />
        <div class="list_date">
            <?php 
            foreach (Currency::getDatesFromRange($startDate, $endDate) as $date):?>
                <div>date (<?=Currency::formatDate($date);?>):</div>
                <?php
                    $rates = Currency::getRates($date);
                    foreach ($rates as $rate) {
                    	echo $rate['baseCurrency'].'/'.$rate['currency'].' - '.$rate['saleRate'].'/'.$rate['purchaseRate'].'<br/>';
                    }
                ?>
            <?php endforeach;?>
        </div>
    <?php else:?>
        <div class="jumbotron">
            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['/site/login']);?>">Log in</a></p>
        </div>
    <?php endif;?>
</div>