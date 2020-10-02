<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Packages';
$this->params['breadcrumbs'][] = $this->title;
// print_r($packages);exit;
$packageColor = ["magenta","green","yellow","blue"];
$selectHospitalId=common\models\HospitalClinicDetails::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
$name = ($selectHospitalId['name']) ? $selectHospitalId['name'] : "";
$phone = ($selectHospitalId['phone_number']) ? $selectHospitalId['phone_number'] : "";
$email = ($selectHospitalId['email']) ? $selectHospitalId['email'] : "";
$address = ($selectHospitalId['address']) ? $selectHospitalId['address'] : "";
?>
<script>var baseurl = "<?php print \yii\helpers\Url::base() . "/"; ?>";</script>
<div class="container" style="background-color: #fff;padding: 50px 20px">
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
                         <span class="amount1 <?php echo (($value['discount_rate']/1000) >= 1) ? 'k1000' : ''?>"><?php echo ($value['discount_rate']!="0.00") ?  (($value['discount_rate']/1000) >= 1) ? "₹ ".round(($value['discount_rate']/1000),1)."K" : "₹ ".$value['discount_rate'] : "";?></span>
                    </div>
                    <?php echo $value['description']?>
                </div>
                <button  class="pricingTable-signup" onclick="test('<?php echo $apikey?>','<?php echo ($value['discount_rate']) ? round($value['discount_rate']) : $value['price']?>','<?php echo $name?>','<?php echo $value['package_name']?>','','<?=$email?>','<?=$phone?>','<?=$address?>')">Order Now</button>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!-- Modal -->
  <div class="modal" id="myModal" role="dialog" style="display: none">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 style="padding-left:33%;text-align: center;color:#008000;"><button type="button" style="background-color:#008000;" class="btn btn-primary btn-rounded"><span class="fa fa-3x">&#10004</span></button><br><br>Payment Successfull</h4><br>
          <h6></h6>
        </div>
        <div class="modal-body">
          <p>Payment Type <span style="float:right">Net Banking</span></p>
          <p>Bank <span style="float:right">SIB</span></p>
          <p>Mobile <span style="float:right">7189065340</span></p>
          <p>Email <span style="float:right">test@test.com</span></p>
        </div>
        <div class="modal-body">
            <h6>Amount Paid<span style="float:right">500.00</span></h6>
        </div>
         <div class="modal-body">
            <p>Transaction Id<span style="float:right">12356789023456</span></h6>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Print</button>
            <button type="button" class="btn btn-info" data-dismiss="modal" onclick="$('.modal').hide()">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

 
// document.getElementById('rzp-button1').onclick = function(e){
function test(apiKey,amount,name,description,images,email,mobile,address){
    var options = {
    "key":apiKey,
    "amount": amount, 
    "currency": "INR",
    "name": name,
    "description": description,
    "image": images,
    "handler": function (response){
        if(response)
       $('.modal').show()
    },
    "prefill": {
        "name": name,
        "email": email,
        "contact": mobile
    },
    "notes": {
        "address": address
    },
    "theme": {
        "color": "#F37254"
    }
};




   var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
}
</script>