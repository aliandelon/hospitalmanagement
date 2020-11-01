<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HospitalClinicDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
        #myMap {
           height: 350px;
           width: 680px;
        }
</style>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIwzALxUPNbatRBj3Xi1Uhp0fFzwWNBkE&v=3.exp&sensor=false">
        </script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript"> 
            var map;
            var marker;
            // 10.09174117142734
            // 76.36016702239196
            // var myLatlng = new google.maps.LatLng(10.090864454155628,76.36149739806335);
            var myLatlng;
            var geocoder = new google.maps.Geocoder();
            var infowindow = new google.maps.InfoWindow();


            function initialize(){
                var lat=10.09174117142734;
                var log=76.36016702239196;
                myLatlng = new google.maps.LatLng(lat,log);
                var mapOptions = {
                    zoom: 18,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
               
                map = new google.maps.Map(document.getElementById("myMap"), mapOptions);
                
                marker = new google.maps.Marker({
                    map: map,
                    position: myLatlng,
                    draggable: true 
                });     
                
                geocoder.geocode({'latLng': myLatlng }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#address').val(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });

                               
                google.maps.event.addListener(marker, 'dragend', function() {

                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#address').val(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });
            });
            
            }
            
            // google.maps.event.addDomListener(window, 'load', initialize);
        </script>  
<div class="hospital-clinic-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'have_diagnostic_center')->textInput() ?>

    <?= $form->field($model, 'master_hospital_id')->textInput() ?>

    <?= $form->field($model, 'same_as_hospital_details_flag')->textInput() ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'razorpay_id')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'razorpay_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pincode')->textInput() ?>

    <?= $form->field($model, 'street1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'package_id')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'commision')->textInput() ?>
  <div id="myMap"></div><br/>
        <div>
            <input id="address"  type="text" style="width:600px;"/>
            <br/>
            <input type="text" id="latitude" placeholder="Latitude"/>
            <input type="text" id="longitude" placeholder="Longitude"/>

            <input type="button" name="load" id="loadMap" onclick="initialize()" value="loade">
        </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
