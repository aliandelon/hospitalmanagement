<!-- <div class="row doctor-grid"> -->
                        <?php foreach ($doctorsList as $key => $value) { 
                            $id = $value['id'];
                            $path = Yii::$app->request->baseUrl .'/uploads/doctors/'.$id.'.'.$value['image'];
                            
                        ?>
                            <div class="col-md-4 col-sm-4  col-lg-3">
                                <div class="profile-widget">
                                    <div class="doctor-img">
                                        <a class="avatar" href="profile.html">
                                            <?php echo ($value['image'] != '') ? '<img alt="" src="'.$path.'">' : '<i class="fa fa-user-md fa-2x"></i>'?>
                                        </a>
                                    </div>
                                    <h4 class="doctor-name text-ellipsis"><a href="<?php echo Yii::$app->request->baseUrl .'/doctors-details/view?id='.$id?>"><?php echo isset($value['name']) ? $value['name'] : "";?></a></h4>
                                    <div class="doc-prof"><?php echo isset($value['leaveDate']) ? $value['leaveDate'] : "";?></div>
                                    <!-- <div class="user-country">
                                        <i class="fa fa-graduation-capr"></i> <?php //echo $months[$i]?>
                                    </div>  -->
                                </div>
                            </div>
                        <?php } ?>
                    <!-- </div> -->