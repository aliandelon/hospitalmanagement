<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DoctorsDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="card-box mb-0">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Doctors</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="<?php echo Yii::$app->request->baseUrl .'/doctors-details/create'?>" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
                    </div>
                </div>
                <div class="row doctor-grid">
                    <?php foreach ($doctorsList as $key => $value) { 
                        $id = $value['id'];
                        $path = Yii::$app->request->baseUrl .'/uploads/doctors/'.$id.'/'.$id.'.'.$value['img'];
                        
                    ?>
                        <div class="col-md-4 col-sm-4  col-lg-3">
                            <div class="profile-widget">
                                <div class="doctor-img">
                                    <a class="avatar" href="profile.html">
                                        <?php echo ($value['img'] != '') ? '<img alt="" src="'.$path.'">' : '<i class="fa fa-user-md fa-2x"></i>'?>
                                    </a>
                                </div>
                                <div class="dropdown profile-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="<?php echo Yii::$app->request->baseUrl .'/doctors-details/update?id='.$id?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                       <!--  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                    </div>
                                </div>
                                <h4 class="doctor-name text-ellipsis"><a href="<?php echo Yii::$app->request->baseUrl .'/doctors-details/view?id='.$id?>"><?php echo isset($value['name']) ? $value['name'] : "";?></a></h4>
                                <div class="doc-prof"><?php echo isset($value['qualifications']) ? $value['qualifications'] : "";?></div>
                                <div class="user-country">
                                    <i class="fa fa-graduation-capr"></i> <?php echo isset($value['spectial']) ? $value['spectial'] : "";?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- <div class="row">
                    <div class="col-sm-12">
                        <div class="see-all">
                            <a class="see-all-btn" href="javascript:void(0);">Load More</a>
                        </div>
                    </div>
                </div> -->
                 </div>
            </div>
