<?php
use yii\helpers\Url;

/* @var $this yii\web\View */


$this->title = 'mastermbbs';
?>
  <!-- <div class="product-sales-area mg-tb-30">
            
  </div> -->
<!-- Static Table Start -->
        <div class="static-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="analytics-sparkle-area">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="analytics-sparkle-line reso-mg-b-30">
                                        <div class="analytics-content">
                                            <h5>Registered Hospitals</h5>
                                            <h2><span class="counter">500</span> <span class="tuition-fees">Clinics</span></h2>
                                            <span class="text-success">&nbsp;</span>
                                            <div class="progress m-b-0">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"> <span class="sr-only">20% Complete</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="analytics-sparkle-line reso-mg-b-30">
                                        <div class="analytics-content">
                                            <h5>Registered Sub-Admins</h5>
                                            <h2><span class="counter">30</span> <span class="tuition-fees">Users</span></h2>
                                            <span class="text-danger">&nbsp;</span>
                                            <div class="progress m-b-0">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"> <span class="sr-only">230% Complete</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                                        <div class="analytics-content">
                                            <h5>Registered Doctors</h5>
                                            <h2><span class="counter">2000</span> <span class="tuition-fees">Specialists</span></h2>
                                            <span class="text-info">&nbsp;</span>
                                            <div class="progress m-b-0">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"> <span class="sr-only">20% Complete</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                                        <div class="analytics-content">
                                            <h5>Registered Patients</h5>
                                            <h2><span class="counter">3500</span> <span class="tuition-fees">Users</span></h2>
                                            <span class="text-inverse">&nbsp;</span>
                                            <div class="progress m-b-0">
                                                <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"> <span class="sr-only">230% Complete</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-sales-area mg-tb-30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                    <div class="product-sales-chart">
                                        <div class="portlet-title">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="caption pro-sl-hd">
                                                        <span class="caption-subject"><b>Hospital / Clinic Analysis</b></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="actions graph-rp graph-rp-dl">
                                                        <select class="form-control">
                                                            <option>Hospital1</option>
                                                            <option>Hospital2</option>
                                                            <option>Hospital3</option>
                                                            <option>Hospital3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="actions graph-rp graph-rp-dl">
                                                         <select class="form-control">
                                                            <option>Investigation1</option>
                                                            <option>Investigation2</option>
                                                            <option>Investigation3</option>
                                                            <option>Investigation4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="actions graph-rp graph-rp-dl">
                                                        <p>Total count of Tests </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="list-inline cus-product-sl-rp">
                                            <li>
                                                <h5><i class="fa fa-circle" style="color: #006DF0;"></i>investigation</h5>
                                            </li>
                                        </ul>
                                        <div id="morris-area-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="white-box analytics-info-cs mg-b-10 res-mg-t-30 table-mg-t-pro-n res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                                        <h3 class="box-title">Total Appointments</h3>
                                        <ul class="list-inline two-part-sp">
                                            <li>
                                                <div id="sparklinedash"></div>
                                            </li>
                                            <li class="text-right sp-cn-r"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-success"><span class="counter">1500</span></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="white-box analytics-info-cs tb-sm-res-d-n dk-res-t-d-n">
                                        <h3 class="box-title">Completed Appointments</h3>
                                        <ul class="list-inline two-part-sp">
                                            <li>
                                                <div id="sparklinedash4"></div>
                                            </li>
                                            <li class="text-right graph-four-ctn"><i class="fa fa-level-down" aria-hidden="true"></i> <span class="text-danger"><span class="counter">80</span>%</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                                        <h3 class="box-title">Total Sales</h3>
                                        <ul class="list-inline two-part-sp">
                                            <li>
                                                <div id="sparklinedash2"></div>
                                            </li>
                                            <li class="text-right graph-two-ctn"><i class="fa fa-level-up" aria-hidden="true"></i> Rs. <span class="counter text-purple"><span class="counter">3000</span></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                                        <h3 class="box-title">Total Earnings</h3>
                                        <ul class="list-inline two-part-sp">
                                            <li>
                                                <div id="sparklinedash3"></div>
                                            </li>
                                            <li class="text-right graph-three-ctn"><i class="fa fa-level-up" aria-hidden="true"></i> Rs. <span class="counter text-info"><span class="counter">5000</span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="traffic-analysis-area">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="social-media-edu">
                                        <i class="fa fa-medkit"></i>
                                        <div class="social-edu-ctn">
                                            <h3>200</h3>
                                            <p>Total Investigations</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="social-media-edu twitter-cl res-mg-t-30 table-mg-t-pro-n">
                                        <i class="fa fa-image"></i>
                                        <div class="social-edu-ctn">
                                            <h3>30</h3>
                                            <p>Total Banners</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="social-media-edu linkedin-cl res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                                        <i class="fa fa-hospital-o"></i>
                                        <div class="social-edu-ctn">
                                            <h3>7000</h3>
                                            <p>Active Customers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="social-media-edu youtube-cl res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                                        <i class="fa fa-users"></i>
                                        <div class="social-edu-ctn">
                                            <h3>2578</h3>
                                            <p>Active Users</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="library-book-area mg-t-30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="single-review-st-item res-mg-t-30 table-mg-t-pro-n">
                                        <div class="single-review-st-hd">
                                            <h2>Top Rated Hospitals</h2>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification1/1.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Lisie Hospital</h3>
                                                <p>Ernakulam</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification1/1.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Lourdes Hospital</h3>
                                                <p>Kochi</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification1/1.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Jubilee Mission Hospital</h3>
                                                <p>Thrissur</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification1/1.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Sun Medical</h3>
                                                <p>Thrissur</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification1/1.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>St.Joseph's Hospital</h3>
                                                <p>Karunagapilly</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification1/1.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Sunrise Hospital</h3>
                                                <p>Kakkanad</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="single-review-st-item res-mg-t-30 table-mg-t-pro-n">
                                        <div class="single-review-st-hd">
                                            <h2>Top Investigations</h2>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification2/1.jpeg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Kidney function test</h3>
                                                <p>5700 in this month</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification2/1.jpeg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Liver function test</h3>
                                                <p>580 in this month</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification2/1.jpeg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Malabsorption test</h3>
                                                <p>150 in this month</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification2/1.jpeg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Thyroid function test</h3>
                                                <p>2500 in this month</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification2/1.jpeg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Toxicology test</h3>
                                                <p>50 in this month</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification2/1.jpeg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Pregnancy test</h3>
                                                <p>250 in this month</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="single-review-st-item res-mg-t-30 table-mg-t-pro-n">
                                        <div class="single-review-st-hd">
                                            <h2>Top Rated Doctors</h2>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification/1.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Sarah Graves</h3>
                                                <p>Cardiologist</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification/2.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Garbease sha</h3>
                                                <p>Neurologist</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification/3.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Gobetro pro</h3>
                                                <p>Neurologist</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification/4.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Siam Graves</h3>
                                                <p>Cardiologist</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification/5.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Sarah Graves</h3>
                                                <p>Cardiologist</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="single-review-st-text">
                                            <img src="img/notification/6.jpg" alt="">
                                            <div class="review-ctn-hf">
                                                <h3>Julsha Grav</h3>
                                                <p>Pediatrician</p>
                                            </div>
                                            <div class="review-item-rating">
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star"></i>
                                                <i class="educate-icon educate-star-half"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
