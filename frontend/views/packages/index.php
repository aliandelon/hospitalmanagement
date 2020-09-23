<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Packages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="col-sm-8 col-4">
            <h4 class="page-title">Packages</h4>
        </div>
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="pricingTable">
                <div class="ribbon">
                    <div class="label">Featured</div>
                </div>
                <div class="pricingTable-header">
                    <h3 class="title">Standard</h3>
                </div>
                <div class="pricing-content">
                    <div class="price-value">
                        <span class="amount">$10</span>
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque necessitatibus placeat tempore.
                    </p>
                    <ul>
                        <li>50GB Disk Space</li>
                        <li>50 Email Accounts</li>
                        <li>50GB Monthly Bandwidth</li>
                        <li>50 Subdomains</li>
                        <li>50 Domains</li>
                    </ul>
                </div>
                <a href="#" class="pricingTable-signup">Order Now</a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="pricingTable yellow">
                <div class="ribbon">
                    <div class="label">Featured</div>
                </div>
                <div class="pricingTable-header">
                    <h3 class="title">Business</h3>
                </div>
                <div class="pricing-content">
                    <div class="price-value">
                        <span class="amount">$20</span>
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque necessitatibus placeat tempore.
                    </p>
                    <ul>
                        <li>60GB Disk Space</li>
                        <li>60 Email Accounts</li>
                        <li>60GB Monthly Bandwidth</li>
                        <li>60 Subdomains</li>
                        <li>60 Domains</li>
                    </ul>
                </div>
                <a href="#" class="pricingTable-signup">Order Now</a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            
            <div class="pricingTable green">
                <div class="ribbon">
                    <div class="label">Featured</div>
                </div>
                <div class="pricingTable-header">
                    <h3 class="title">Premium</h3>
                </div>
                <div class="pricing-content">
                    <div class="price-value">
                        <span class="amount">$30</span>
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque necessitatibus placeat tempore.
                    </p>
                    <ul>
                        <li>150GB Disk Space</li>
                        <li>150 Email Accounts</li>
                        <li>150GB Monthly Bandwidth</li>
                        <li>150 Subdomains</li>
                        <li>150 Domains</li>
                    </ul>
                </div>
                <a href="#" class="pricingTable-signup">Order Now</a>
            </div>
        </div>
    </div>
</div>
