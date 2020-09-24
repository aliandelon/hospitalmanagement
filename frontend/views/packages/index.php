<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Packages';
$this->params['breadcrumbs'][] = $this->title;
// print_r($packages);exit;
$packageColor = ["magenta","blue","yellow"];
?>
<div class="container">
    <div class="col-sm-8 col-4">
            <h4 class="page-title">Packages</h4>
        </div>
    <div class="row">
        <?php foreach ($packages as $key => $value) {?>
        <div class="col-md-4 col-sm-6">
            <div class="pricingTable <?php echo $packageColor[$key]?>">
                <?php if($value['featured_flag']){?>
                <div class="ribbon">
                    <div class="label">Featured</div>
                </div>
                <?php } ?>
                <div class="pricingTable-header">
                    <h3 class="title"><?php echo $value['package_name']?></h3>
                </div>
                <div class="pricing-content">
                    <div class="price-value">
                        <span class="amount <?php echo (($value['price']/1000) >= 1) ? "k1000" : ""?> <?php echo ($value['discount_rate']!="0.00") ? 'lineThrough' : ''?>">₹ <?php echo (($value['price']/1000) >= 1) ? round(($value['price']/1000),1)."K" : $value['price']?></span>
                         <span class="amount1 <?php echo (($value['discount_rate']/1000) >= 1) ? 'k1000' : ''?>"><?php echo ($value['discount_rate']!="0.00") ?  (($value['discount_rate']/1000) >= 1) ? "₹ ".round(($value['discount_rate']/1000),1)."K" : $value['discount_rate'] : "";?></span>
                    </div>
                    <?php echo $value['description']?>
                </div>
                <a href="#" class="pricingTable-signup">Order Now</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
