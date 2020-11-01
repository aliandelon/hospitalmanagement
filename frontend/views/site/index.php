

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                       <a href="<?= Yii::$app->request->baseUrl . '/doctors-details' ?>"> 
                       	<div class="dash-widget">
							<span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
							<div class="dash-widget-info text-right">
								<h3><?php echo $params['ourDoctors'] ?></h3>
								<span class="widget-title1">Total Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div>
                       </a> 
                    </div>
                     <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                     	 <a href="<?= Yii::$app->request->baseUrl . '/appointments/index2'?>"> 
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $params['ourAppointments']?></h3>
                                <span class="widget-title3">Appointments <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                         </a> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    	 <a href="<?= Yii::$app->request->baseUrl . '/patient-details' ?>"> 
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-wheelchair"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $params['ourPatients']?></h3>
                                <span class="widget-title2">Total Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                         </a> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    	
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $params['ourInvestigations']?></h3>
                                <span class="widget-title4">Investigations <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
				<div class="row">
					<div class="col-12 col-md-8 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Total Investigations & Appointments In This Year</h4>
									<!-- <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span> -->
								</div>	
								<canvas id="linegraph"></canvas>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-4 col-xl-4" style="min-height: 100%">
						<div class="card" style="border:1px solid #05ab9e;">
							<div class="card-body" style="text-align: center;min-height: 100%;">
								<div class="chart-title" style="float:left">
									<h4>Subscription Expiry</h4>
								</div>
								<div id="clockdiv" style="margin-top: -5px">
								  <div>
								    <span class="days"></span>
								    <div class="smalltext">Days</div>
								  </div><br/><br/>
								  <div>
								    <span class="hours"></span>
								    <div class="smalltext">Hours</div>
								  </div>
								  <div>
								    <span class="minutes"></span>
								    <div class="smalltext">Minutes</div>
								  </div>
								  <div>
								    <span class="seconds"></span>
								    <div class="smalltext">Seconds</div>
								  </div>
								</div>
								<div id="clockdiv1" style="display:none;text-align: center">
									<br/><br/>
									<h1><i class="fa fa-calendar"></i></h1>
									<h1 id='endDate'></h1>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="card member-panel">
							<div class="card-header bg-white">
								<h4 class="card-title mb-0">Today's Doctors Summary</h4>
							</div>
                            <div class="card-body">
                                <ul class="contact-list">
                                	<?php foreach ($params['doctorSummary'] as $key => $value) { ?>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status <?php echo ($value['doctor_id']) ? 'offline' : 'online'?>"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis"><?php echo $value['name']?></span>
                                                <span class="contact-date"><?php echo ($value['doctor_id']) ? 'Leave' : $value['docId'].' Appointments'?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                                    <!-- <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Naveen Nandagopal</span>
                                                <span class="contact-date">Leave</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Jerry Varghese</span>
                                                <span class="contact-date">20 Appointments</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Suthambiga</span>
                                                <span class="contact-date">20 Appointments</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Moncy Mathai</span>
                                                <span class="contact-date">Leave</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Sunil</span>
                                                <span class="contact-date">20 Appointments</span>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <!-- <a href="doctors.html" class="text-muted">View all Doctors</a> -->
                            </div>
                        </div>
                    </div>
					<div class="col-12 col-md-8 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Total Earnings In This Year</h4>
									<div class="float-right">
										<ul class="chat-user-total">
											<!-- <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
											<li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li> -->
										</ul>
									</div>
								</div>	
								<canvas id="bargraph"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="appointments.html" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table mb-0">
										<thead class="d-none">
											<tr>
												<th>Patient Name</th>
												<th>Doctor Name</th>
												<th>Timing</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="min-width: 200px;">
													<a class="avatar" href="profile.html">B</a>
													<h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
												</td>               
												<td>
													<h5 class="time-title p-0">Appointment With</h5>
													<p>Dr. Cristina Groves</p>
												</td>
												<td>
													<h5 class="time-title p-0">Timing</h5>
													<p>7:00 PM - 7:30PM</p>
												</td>
											</tr>
											<tr>
												<td style="min-width: 200px;">
													<a class="avatar" href="profile.html">B</a>
													<h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
												</td>                
												<td>
													<h5 class="time-title p-0">Appointment With</h5>
													<p>Dr. Cristina Groves</p>
												</td>
												<td>
													<h5 class="time-title p-0">Timing</h5>
													<p>7:00 PM - 7:30PM</p>
												</td>
											</tr>
											<tr>
												<td style="min-width: 200px;">
													<a class="avatar" href="profile.html">B</a>
													<h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
												</td>                     
												<td>
													<h5 class="time-title p-0">Appointment With</h5>
													<p>Dr. Cristina Groves</p>
												</td>
												<td>
													<h5 class="time-title p-0">Timing</h5>
													<p>7:00 PM - 7:30PM</p>
												</td>
											</tr>
											<tr>
												<td style="min-width: 200px;">
													<a class="avatar" href="profile.html">B</a>
													<h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
												</td>                  
												<td>
													<h5 class="time-title p-0">Appointment With</h5>
													<p>Dr. Cristina Groves</p>
												</td>
												<td>
													<h5 class="time-title p-0">Timing</h5>
													<p>7:00 PM - 7:30PM</p>
												</td>
											</tr>
											<tr>
												<td style="min-width: 200px;">
													<a class="avatar" href="profile.html">B</a>
													<h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
												</td>                     
												<td>
													<h5 class="time-title p-0">Appointment With</h5>
													<p>Dr. Cristina Groves</p>
												</td>
												<td>
													<h5 class="time-title p-0">Timing</h5>
													<p>7:00 PM - 7:30PM</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="card member-panel">
							<div class="card-header bg-white">
								<h4 class="card-title mb-0">Our Doctors</h4>
							</div>
                            <div class="card-body">
                                <ul class="contact-list">
                                	<?php foreach ($params['doctorsView'] as $key => $value) { ?>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status <?php echo ($value['doctor_id']) ? 'offline' : 'online'?>"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis"><?php echo $value['name']?></span>
                                                <span class="contact-date"><?php echo $value['spectial']?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                                    <!-- <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Naveen Nandagopal</span>
                                                <span class="contact-date">MRI Scan</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Jerry Varghese</span>
                                                <span class="contact-date">CT Scan</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Suthambiga</span>
                                                <span class="contact-date">Pregnancy Test</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Moncy Mathai</span>
                                                <span class="contact-date">Eye Test</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Dr. Sunil</span>
                                                <span class="contact-date">ECG</span>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <a href="doctors.html" class="text-muted">View all Doctors</a>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">New Patients </h4> <a href="patients.html" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-block">
								<div class="table-responsive">
									<table class="table mb-0 new-patient-table">
										<tbody>
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt=""> 
													<h2>John Doe</h2>
												</td>
												<td>Johndoe21@gmail.com</td>
												<td>+1-202-555-0125</td>
												<td><button class="btn btn-primary btn-primary-one float-right">MRI Scan</button></td>
											</tr>
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt=""> 
													<h2>Richard</h2>
												</td>
												<td>Richard123@yahoo.com</td>
												<td>202-555-0127</td>
												<td><button class="btn btn-primary btn-primary-two float-right">CT Scan</button></td>
											</tr>
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt=""> 
													<h2>Villiam</h2>
												</td>
												<td>Richard123@yahoo.com</td>
												<td>+1-202-555-0106</td>
												<td><button class="btn btn-primary btn-primary-three float-right">Eye Test</button></td>
											</tr>
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="<?= Yii::$app->request->baseUrl; ?>/img/user.jpg" alt=""> 
													<h2>Martin</h2>
												</td>
												<td>Richard123@yahoo.com</td>
												<td>776-2323 89562015</td>
												<td><button class="btn btn-primary btn-primary-four float-right">Blood Test</button></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-4">
						<div class="hospital-barchart">
							<h4 class="card-title d-inline-block">Today's Summary</h4>
						</div>
						<div class="bar-chart">
							<!-- <div class="legend">
								<div class="item">
									<h4>Level1</h4>
								</div>
								
								<div class="item">
									<h4>Level2</h4>
								</div>
								<div class="item text-right">
									<h4>Level3</h4>
								</div>
								<div class="item text-right">
									<h4>Level4</h4>
								</div>
							</div> -->
							<div class="chart clearfix">
								<?php foreach ($params['investigationSummary'] as $key => $value) { ?>
								<div class="item">
									<div class="bar">
										<span class="percent"><?php echo $value['invIdCount']?></span>
										<div class="item-progress" data-percent="20">
											<span class="title"><?php echo $value['name']?></span>
										</div>
									</div>
								</div>
							<?php } ?>
								<!-- <div class="item">
									<div class="bar">
										<span class="percent">7100</span>
										<div class="item-progress" data-percent="0">
											<span class="title">Blood Test</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">820</span>
										<div class="item-progress" data-percent="0">
											<span class="title">Corona Test</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">670</span>
										<div class="item-progress" data-percent="0">
											<span class="title">Urine Culturing</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">300</span>									
										<div class="item-progress" data-percent="0">
											<span class="title">Pregnancy Test</span>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					 </div>
				</div>
<style>
h1{
  color: #396;
  font-weight: 100;
  font-size: 40px;
  margin: 40px 0px 20px;
}
#clockdiv1{
	text-align: center;
	font-family: sans-serif;
	color: #00816A;
	font-weight: 500;
	text-align: center;
	font-size: 30px;
}

#clockdiv{
	text-align: center;
	font-family: sans-serif;
	color: #fff;
	display: inline-block;
	font-weight: 100;
	text-align: center;
	font-size: 30px;
}

#clockdiv > div{
	color: #fff;
	padding: 4px;
	border-radius: 7px;
	background: #00BF96;
	display: inline-block;
}

#clockdiv .days{
	color: #fff;
	padding: 40px;
	border-radius: 3px;
	background: #00816A;
	display: inline-block;
}

#clockdiv .hours{
	color: #fff;
	padding: 15px;
	border-radius: 3px;
	background: #00816A;
	display: inline-block;
}

#clockdiv .minutes{
	color: #fff;
	padding: 15px;
	border-radius: 3px;
	background: #00816A;
	display: inline-block;
}

#clockdiv .seconds{
	color: #fff;
	padding: 15px;
	border-radius: 3px;
	background: #00816A;
	display: inline-block;
}

.smalltext{
	padding-top: 5px;
	font-size: 14px;
}
</style>
<script>
	// Set the date we're counting down to
function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  	function getLastDate(dateObject) {
	    var d = new Date(dateObject);
	    var day = d.getDate();
	    var month = d.getMonth() + 1;
	    var year = d.getFullYear();
	    if (day < 10) {
	        day = "0" + day;
	    }
	    if (month < 10) {
	        month = "0" + month;
	    }
	    var date = day + "-" + month + "-" + year;

	    return date;
	};
  function updateClock() {
    var t = getTimeRemaining(endtime);
    if(t.days <= 30){
	    daysSpan.innerHTML = t.days;
	    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
	    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
	    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
	    $('#clockdiv1').hide();
	    $('#clockdiv').show();
	}else{
		$('#clockdiv').hide();
		$('#clockdiv1').show();
		$('#endDate').html(getLastDate(endtime));
	}
    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

// var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
var deadline = new Date("2021-02-21 00:00:00");
initializeClock('clockdiv', deadline);
</script>

           <script>
           	$(document).ready(function() {
				// Line Chart

				var lineChartData = {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Doctor Appointments",
						backgroundColor: "rgba(204, 99, 48, 0.5)",
						borderColor: '#F12404',
						borderWidth: 1,
						data: [<?=$params['graph2']['cnt']?>]
					}, {
					label: "Investigations",
					backgroundColor: "rgba(5, 171, 158, 0.5)",
					borderColor: 'rgba(0, 158, 251, 1)',
						borderWidth: 1,
					fill: true,
					data: [<?=$params['graph1']['cnt']?>]
					}]
				};

				var linectx = document.getElementById('linegraph').getContext('2d');
				window.myLine = new Chart(linectx, {
					type: 'line',
					data: lineChartData,
					options: {
						responsive: true,
						legend: {
							display: false,
						},
						tooltips: {
							mode: 'index',
							intersect: false,
						}
					}
				});

				// Bar Chart

				var barChartData = {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: 'Appointments Earnings',
						backgroundColor: '#ffbc35',//'rgba(0, 158, 251, 0.5)',
						borderColor: 'rgba(0, 158, 251, 1)',
						borderWidth: 1,
						data: [<?=$params['graph2']['amt']?>]
					}, {
						label: 'Investigations Earnings',
						backgroundColor: '#05ab9e',//'rgba(255, 188, 53, 0.5)',
						borderColor: 'rgba(255, 188, 53, 1)',
						borderWidth: 1,
						data: [<?=$params['graph1']['amt']?>]
					}]
				};

				var ctx = document.getElementById('bargraph').getContext('2d');
				window.myBar = new Chart(ctx, {
					type: 'bar',
					data: barChartData,
					options: {
						responsive: true,
						legend: {
							display: false,
						}
					}
				});
				$('.card-body').parent('div').css("height","93%");
			});
           </script>