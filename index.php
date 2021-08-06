<?php
include_once 'assets/conn/dbconnect.php';
// include_once 'assets/conn/server.php';
?>


<!-- login -->
<!-- check session -->
<?php
session_start();
// session_destroy();
if (isset($_SESSION['patientSession']) != "") {
header("Location: patient/patient.php");
}
if (isset($_POST['login']))
{
$icPatient = mysqli_real_escape_string($con,$_POST['icPatient']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$icPatient'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
if ($row['password'] == $password)
{
$_SESSION['patientSession'] = $row['icPatient'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: patient/patient.php");
} else {
?>
<script>
alert('wrong input ');
</script>
<?php
}
}
?>
<!-- register -->
<?php
if (isset($_POST['signup'])) {
$patientFirstName = mysqli_real_escape_string($con,$_POST['patientFirstName']);
$patientLastName  = mysqli_real_escape_string($con,$_POST['patientLastName']);
$patientEmail     = mysqli_real_escape_string($con,$_POST['patientEmail']);
$icPatient     = mysqli_real_escape_string($con,$_POST['icPatient']);
$password         = mysqli_real_escape_string($con,$_POST['password']);
$month            = mysqli_real_escape_string($con,$_POST['month']);
$day              = mysqli_real_escape_string($con,$_POST['day']);
$year             = mysqli_real_escape_string($con,$_POST['year']);
$patientDOB       = $year . "-" . $month . "-" . $day;
$patientGender = mysqli_real_escape_string($con,$_POST['patientGender']);
//INSERT
$query = " INSERT INTO patient (  icPatient, password, patientFirstName, patientLastName,  patientDOB, patientGender,   patientEmail )
VALUES ( '$icPatient', '$password', '$patientFirstName', '$patientLastName', '$patientDOB', '$patientGender', '$patientEmail' ) ";
$result = mysqli_query($con, $query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Register success. Please Login to make an appointment.');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('User already registered. Please try again');
</script>
<?php
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Clinic Appointment Application</title>
        <!-- Bootstrap -->
        <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link href="assets/css/material.css" rel="stylesheet">
        <style>

.pad25{
    transition: all 0.2s ease!important;
    margin:20px auto!important;
	
}
.heading{
    color: white !important;
    text-align:center!important;
}
.cal{
	width: 40% !important;
}
.pad25 h4{
    color:lightblue!important;
}

.pad25:hover{
    box-shadow: 0px 0px 10px white!important;
    transform: scale(1.0,1.0)!important;
	border-radius:5px;
    color: white !important;

}
.pad25:hover p{
    color: white !important;
}
.covid h3{
	margin-top:20px!important;
    color: white !important;
}
.covid h4{
    color:lightblue;
}
		</style>
    </head>
    <body>
        <!-- navigation -->
        <nav class="navbar navbar-default navbar-dark bg-dark nav-back navbar-fixed-top" role="navigation" >
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                   
                    <div style="display:flex;">
                    <a class="navbar-brand " href="index.php"><img alt="Brand" src="assets/img/doctor.png" height="50px" style="margin-top:-10px!important; margin-left:10px;"></a>
                    <h4 style="color:white; text-shadow:0px 3px 3px blue; margin-top:22px;  ">HealthCare</h4>
                    </div>
                    
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                    <ul class="nav navbar-nav navbar-right">
                        

                        <!-- <li><a href="adminlogin.php">Admin</a></li> -->
                        <li><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>
                   
                        <li>
                            <p class="navbar-text ml-2 " style="margin-left:10px;">   Already have an account?</p>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                                <div class="form-group">
                                                    <label class="sr-only" for="icPatient">Email</label>
                                                    <input type="text" class="form-control" name="icPatient" placeholder="Id Number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Sign in</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- navigation -->

        <!-- modal container start -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- modal content -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Sign Up</h3>
                    </div>
                    <!-- modal body start -->
                    <div class="modal-body">
                        
                        <!-- form start -->
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                        <h4>It's free and always will be.</h4>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="patientFirstName" value="" class="form-control input-lg" placeholder="First Name" required />
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="patientLastName" value="" class="form-control input-lg" placeholder="Last Name" required />
                                            </div>
                                        </div>
                                        
                                        <input type="text" name="patientEmail" value="" class="form-control input-lg" placeholder="Your Email"  required/>
                                        <input type="number" name="icPatient" value="" class="form-control input-lg" placeholder="Your Id Number"  required/>
                                        
                                        
                                        <input type="password" name="password" value="" class="form-control input-lg" placeholder="Password"  required/>
                                        
                                        <input type="password" name="confirm_password" value="" class="form-control input-lg" placeholder="Confirm Password"  required/>
                                        <label>Birth Date</label>
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <select name="month" class = "form-control input-lg" required>
                                                    <option value="">Month</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">May</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Aug</option>
                                                    <option value="09">Sep</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="day" class = "form-control input-lg" required>
                                                    <option value="">Day</option>
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="year" class = "form-control input-lg" required>
                                                    <option value="">Year</option>
                                                    
                                                    <option value="1981">1981</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1999">1999</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                </select>
                                            </div>
                                        </div>
                                        <label>Gender : </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="patientGender" value="male" required/>Male
                                        </label>
                                        <label class="radio-inline" >
                                            <input type="radio" name="patientGender" value="female" required/>Female
                                        </label>
                                        <br />
                                        <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>
                                        
                                        <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">Create my account</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->
        <!-- modal container end -->

        <!-- 1st section start -->
        <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 main">
                        <h2 style="text-shadow:0px 0px 3px black;font-weight:bold;color:white;">Make appointment today!</h2>
                        <p style="text-shadow:0px 0px 2px black ;font-weight:bold;color:white;">This is Doctor's Schedule. Please <span class="label label-danger">login</span> to make an appointment. </p>
                            
                        <!-- date textbox -->
                       
                        <div class="input-group" style="margin-bottom:10px;">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar">
                                </i>
                            </div>
                            <input class="form-control calander" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
                        </div>
                       
                        <!-- date textbox end -->

                        <!-- script start -->
                        <script>

                            function showUser(str) {
                                
                                if (str == "") {
                                    document.getElementById("txtHint").innerHTML = "";
                                    return;
                                } else { 
                                    if (window.XMLHttpRequest) {
                                        // code for IE7+, Firefox, Chrome, Opera, Safari
                                        xmlhttp = new XMLHttpRequest();
                                    } else {
                                        // code for IE6, IE5
                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                                        }
                                    };
                                    xmlhttp.open("GET","getuser.php?q="+str,true);
                                    console.log(str);
                                    xmlhttp.send();
                                }
                            }
                        </script>
                        
                        <!-- script start end -->
                     
                        <!-- table appointment start -->
                        <div id="txtHint"><b> </b></div>
                        
                        <!-- table appointment end -->
                    </div>
                    <!-- /.col -->
                   <!--  <div class="col-md-6 col-md-offset-1">
                        <div class="video-wrapper">
                            <iframe width="560" height="315" src="http://www.youtube.com/embed/FEoQFbzLYhc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div> -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- first section end -->

        
        <!-- second section start -->
        
        <!-- second section end -->
        <!-- third section start -->
        
        <!-- third section end -->
        <!-- forth sections start -->
        <section id="content-1-9" class="content-1-9 content-block">
            <div class="container">
                <div class="underlined-title">
                    <h3>Our Services</h3>
                    <h4 class="text-primary" style="font-weight:bold;">Book an appointment for an in-clinic consultation</h4>
                    
                </div>
<div class="row "style="justify-content:space-around;" >
<div >
  <div class="col-lg-4 col-md-4 col-sm-11 box-shadow ">
    <div class="card">
      <img src="./assets/img/medical-lab.png" class="card-img-top " alt="...">
      <div class="card-body">
        <h5 class="card-title">Diagnostics and emergency treatment</h5>
        <p class="card-text">
Some common diagnostic tests performed in the ER are blood tests. </p>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-11 box-shadow">
    <div class="card">
      <img src="./assets/img/doctor.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Home medical appointments</h5>
        <p class="card-text">HomeCare’s doctor at home service provides expert care for you and your family .</p>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-11 box-shadow">
    <div class="card">
      <img src="./assets/img/healthcare (1).png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Long term medical care in a hospital</h5>
        <p class="card-text">Long-term care facilities include nursing homes, inpatient behavioral health facilities.</p>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-11 box-shadow">
    <div class="card">
      <img src="./assets/img/test.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">A specialized laboratory research</h5>
        <p class="card-text">Medical laboratories vary in size and complexity and so offer a variety of testing services. </p>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-11 box-shadow">
    <div class="card">
      <img src="./assets/img/ambulance.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Medical transport to the hospital</h5>
        <p class="card-text">This is generally for the patients who need critical care between hospitals and other medical facilities.</p>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-11 box-shadow">
    <div class="card">
      <img src="./assets/img/stethoscope (1).png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Pharmacy refunded from hospital</h5>
        <p class="card-text">A medicine search from the hospital pharmacy system was. carried out, in order to know about the consumption and refund.</p>
      </div>
    </div>
  </div>



  
</div>

</div>
            
</section>
        <!-- forth section end -->

        <!-- fifth sections start -->
		<section id="content-1-9" class="content-1-9 content-block"style="background-color:black;" >
			<div class="container">
				<div class="underlined-title" style="padding:0px;margin-top:-20px; color:white;">
					<h1><img src="./assets/img/symptom.png" style="height:70px;">  Be aware of COVID - 19 </h1>
				
					
				</div>
				<div class="row covid"> 
				<h3 class="text-center">Symptoms</h3>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2" >
							<img src="./assets/img/symptom-1.png" style="height:50px;width:50px;">
						</div>
						<div class="col-xs-10">
							<h4>High Fever</h4>
							<p>A fever is a temporary increase in your body temperature,Seek immediate medical attention if you have serious symptoms. </p>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2" >
							<img src="./assets/img/symptom-2.png" style="height:50px;width:50px">
						</div>
						<div class="col-xs-10">
							<h4 >Dry Cough</h4>
							<p>A dry cough is a common symptom of coronavirus, in addition to signs like fever and shortness of breath. </p>
						</div>
					</div>
                
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2" >
							<img src="./assets/img/symptom-4.png" style="height:50px;width:50px;">
						</div>
						<div class="col-xs-10">
							<h4>Difficulty in Breathing</h4>
							<p>Is shortness of breath one of the first symptoms of COVID-19 and  the disease affects the lungs.</p>
						</div>
					</div>
                        </div>
                        <h3 class="text-center heading">How its Spread</h3>
                        <div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2" >
							<img src="./assets/img/spread-1.png" style="height:50px; width:50px;">
						</div>
						<div class="col-xs-10">
                        <h4>Air by Cough or Sneeze</h4>
							<p> Cover your mouth and nose with a tissue when you cough or sneeze; Throw used tissues in the dastbin and this is also the reason spread of COVID-19</p>
						</div>
					</div>
                    
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
                      
					<div class="col-xs-2" >
                    <img src="./assets/img/spread-2.png" style="height:50px;width:50px;">
						</div>
						<div class="col-xs-10">
							<h4>Personal Contact</h4>
							<p> coronavirus (COVID-19) spreads and take steps to protect yourself and others. Avoid close contact, clean your hands often, cover coughs and sneezes.</p>
						</div>
					</div>
                           
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2" >
                    <img src="./assets/img/spread-4.png" style="height:50px;width:50px;">
						</div>
						<div class="col-xs-10">
							<h4>Mass Gathering</h4>
							<p>Mass gatherings can increase the risk of transmission of infectious diseases such as Coronavirus (COVID 19)</p>
						</div>
					</div>
                    
                            </div>

                                <div class="container">
                                <h3 class="heading" style="text-align:center">Preventions</h3>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
					
					<div class="col-xs-2" >
                    <img src="./assets/img/prevention-1.png" style="height:50px; width:50px;">
						</div>
						<div class="col-xs-10">
							<h4>Wash your Hands</h4>
							<p>Clean your hands often. Use soap and water, or an alcohol-based hand rub.</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2">
                    <img src="./assets/img/prevention-2.png" style="height:50px;width:50px;">
						</div>
						<div class="col-xs-10">
							<h4>Wear a Face Mask</h4>
							<p> wearing face masks can protect people health and slow the spread of COVID-19 and Make sure it covers both your nose, mouth and chin.</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2">
                    <img src="./assets/img/prevention-3.png" style="height:50px;width:50px;">
						</div>
						<div class="col-xs-10">
							<h4>Avoid Contact Sick People</h4>
							<p>People can catch COVID-19 from others who have the virus so Avoid close contact with people who are sick.</p>
						</div>
					</div>
    
                                
					
                            </div>
					
				</div>
				<!-- /.row -->
			</div>
		</section>
		<!-- forth section end -->








         <!-- footer start -->
         <div class="copyright-bar bg-black">
        <div class="col-md-12 py-5 text-center" >
        <div class="mb-5 ml-5 flex-center">

          <!-- Facebook -->
          <a class="fb-ic">
            <i class="fab fa-facebook-f fa-lg white-text mr-5 fa-2x" style="margin-left:15px;margin-bottom:10px;"> </i>
          </a>
          <!-- Twitter -->
          <a class="tw-ic">
            <i class="fab fa-twitter fa-lg white-text  mr-5 fa-2x" style="margin-left:15px;"> </i>
          </a>
          
          <!--Linkedin -->
          <a class="li-ic">
            <i class="fab fa-linkedin-in fa-lg white-text  mr-5 fa-2x" style="margin-left:15px;"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic">
            <i class="fab fa-instagram fa-lg white-text  mr-5 fa-2x" style="margin-left:15px;"> </i>
          </a>
          
        </div>
      </div>
            <div class="container" style="text-align:center;">
                <p class=" small">Copyright © 2021, Designed by HealthCare Team   </a> <a href="adminlogin.php"> Admin</a></p>
            </div>
        </div>
        <!-- footer end -->
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    </script>
    <!-- date start -->
  
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })

    })

</script>

    <!-- date end -->
   
</body>
</html>