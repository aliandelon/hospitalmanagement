<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\ImageForm;
?>


<!-- Default box -->
<div class="box">
    <div class="box-body">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="form-group col-xs-12">
            <div class="col-md-4" style="padding-top:30px;">
                <input type="file" id="upload">
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">

                <div id="upload-demo" style="width:350px"></div>



            </div>
            <button class="btn btn-success upload-result">Crop Image</button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJs("
var uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 147,
        height: 177,
        type: 'rectanle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$('#upload').on('change', function () {
   var reader = new FileReader();
    reader.onload = function (e) {
    	uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});

    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result').on('click', function (ev) {
ev.preventDefault();
 if($('#faculty-department_id').val()===''){
                          alert('Please Select department first');
                          return false;
                          }else{

        var folder = $('#faculty-department_id').val();
  uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		$.ajax({
            url: baseurl + 'site/image-upload',
			type: 'POST',
			data: {'image':resp},
			success: function (data) {

			html = '<img src=' + resp + ' />';
		   	$('#imagePriview').html(html).show();
			$('#faculty-image').val(data.image);
                        $('#imageModal').modal('toggle');
                                  return false;


                             }
                });
        });
        }
        });

");
