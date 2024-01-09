<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Civil Savant Recruitment </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<?php 


if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

</head>
<?php

?>
<body style="background-image: url('image/bg5.jpg'); height: 500px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
background-repeat: no-repeat;
  ">
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">Civil Savant Recruitment</span></div>
<div class="col-md-4 col-md-offset-2">
 <?php
 include_once 'dbConnection.php';
session_start();

if(isset($_POST['update_appl'])){
		
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $state = $_POST['state'];
  $lga = $_POST['lga'];
  $address = $_POST['address'];
  $mob = $_POST['mob'];
  $dob = $_POST['dob'];
  $appl_id = $_POST['apid'];
  $sql = "UPDATE user SET status = '0',state='$state',lga='$lga',address='$address',mob='$mob' WHERE id = '$appl_id'";
  if($con->query($sql)){
    $_SESSION['success'] = 'Candidate updated successfully';
  }
  else{
    $_SESSION['error'] = $con->error;
  }
}
else{
  $_SESSION['error'] = 'Fill up edit form first';
}
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];
$email=$_SESSION['email'];

include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php?q=1" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>
</div>
</div></div>
<div class="bg">

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="account_user.php?q=0" class="navbar-brand"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp; Home</a></li>
        <li <?php if(@$_GET['q']==6) echo'class="active"'; ?>><a href="account_user.php?q=6" class="navbar-brand"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp; Applcation</a></li>
        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Promotional Exam<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="account_user.php?q=1">Start Exam</a></li>
            
</ul>
        <li class="pull-right"> <a href="logout.php?q=account.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Signout</a></li>
		</ul>
            <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter tag ">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Search</button>
      </form>
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel">
<div class="table-responsive">
<table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr>
  <td>'.$c++.'</td>
  <td>'.$title.'</td>
  <td>'.$total.'</td>
  <td>'.$sahi*$total.'</td>
  <td>'.$time.'&nbsp;min</td>
	<td>
  <b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
}
else
{
echo
 '<tr style="color:#99cc32">
<td>'.$c++.'</td>
<td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
<td>'.$total.'</td><td>'.$sahi*$total.'</td>
<td>'.$time.'&nbsp;min</td>
	<td>
  <b><a href="account.php?q=result&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:green;color:#fff;"><span class="glyphicon glyphicon-eye" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Result</b></span></a></b></td></tr>';
}
}
$c=0;
echo '</table></div></div>';

}?>
<span id="countdown" class="timer"></span>
<!--<script>
var seconds = 40;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Buzz Buzz";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
</script>
  -->
<!--home closed-->

<!--quiz start-->
<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q) )
{
$qns=$row['qns'];
$qid=$row['qid'];
echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
}
$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
<br />';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$optionid=$row['optionid'];
echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
}
echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
//result display
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
$eid=@$_GET['eid'];
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
      <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
echo '</table></div>';

}
?>
<!--quiz end-->
<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
}
$c++;
echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}

//ranking start
if(@$_GET['q']== 3) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title"><div class="table-responsive">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>College</b></td><td><b>Score</b></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['gender'];
$college=$row['college'];
}
$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$college.'</td><td>'.$s.'</td><td>';
}
echo '</table></div></div>';}
?>

<?php 

if(@$_GET['q']==6) {
  $apid = $_SESSION["email"];
  
  ?>
  

<?php


$result2 = mysqli_query($con,"SELECT * FROM user WHERE email = '$apid'") or die('Error');
echo  '<div class="panel">

<div class="table-responsive">
<h4>'. date('Y').' Online Application</h4><hr/>
<form action=" " method="POST">
';

if($result2){
  while($row = mysqli_fetch_array($result2)) {
    $id = $row['id'];
    $name = $row['name'];
    $mob = $row['mob'];
    $gender = $row['gender'];
    $email = $row['email'];
    $institution = $row['institution'];
    $qualification = $row['qualification'];
    $course = $row['course'];
    $grade = $row['grade'];
    $year = $row['year'];
    $state = $row['state'];
    $lga = $row['lga'];
    $address = $row['address'];
    $dob = $row['dob'];
    $employment = $row['employment'];
    if($employment==1){
      $employment="<span><b style='color:green'>CONGRATULATION</b> $name you have been emloyed. Go to the institution for physical documentation .</span>";
    }else{
      $employment="<span style='color:red'> You have not been employed. Check back.</span>";
    }

    if($row['status']==1){
	echo '
  
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <label>Full Name</label>
  <input name="name" value="'.$name.'" placeholder="Enter your name" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="gender"></label>
  <div class="col-md-12">
  <label>Gender</label>
    <select id="gender" name="gender" placeholder="Enter your gender" class="form-control input-md" >
   <option value="'.$gender.'">'.$gender.'</option>
  <option value="M">Male</option>
  <option value="F">Female</option> </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="dob"></label>  
  <div class="col-md-12">
  <label>Date Of Birth</label>
  <input  id="dob" name="dob" value="'.$dob.'" class="form-control input-md" type="date">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="gender"></label>
  <div class="col-md-12">
  <label>Qualification</label>
    <select id="qualification" name="qualification"  class="form-control input-md" >
   <option value="'.$qualification.'">'.$qualification.'</option>
  <option>Diploma</option>
  <option>NCE</option>
  <option>HND</option>
  <option>Degree</option>
  <option>Masters</option>
  <option>PHD</option>
 </select>
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="gender"></label>
  <div class="col-md-12">
  <label>Grade</label>
    <select id="grad" name="grade" placeholder="Enter your gender" class="form-control input-md" >
   <option value="'.$grade.'">'.$grade.'</option>
  <option>Lower Credit</option>
  <option>Upper Credit</option>
  <option>Pass</option>
  <option>First Class</option>
  <option>Distinction</option>
  
 </select>
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label title1" for="institution"></label>
  <div class="col-md-12">
  <label>Institution</label>
    <input id="institution" name="institution"  value="'.$institution.'" placeholder="Enter your institution" class="form-control input-md" type="email">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label title1" for="course"></label>
  <div class="col-md-12">
  <label>Cours Of Study</label>
    <input id="course" name="course"  value="'.$course.'" placeholder="Enter your course" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label title1" for="year"></label>
  <div class="col-md-12">
  <label>Year Of Graduation</label>
    <input id="year" name="year"  value="'.$year.'" placeholder="Enter your year of graduation" class="form-control input-md" type="date">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label title1" for="email"></label>
  <div class="col-md-12">
  <label>Email Address</label>
    <input id="email" name="email"  value="'.$email.'" placeholder="Enter your email-id" class="form-control input-md" type="email">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="mob"></label>  
  <div class="col-md-12">
  <label>Phone Number</label>
  <input id="mob" name="mob" value="'.$mob.'" placeholder="Enter your mobile number" class="form-control input-md" type="number">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="state"></label>
  <div class="col-md-12">
  <label>State</label>
    <input id="state" name="state" value="'.$state.'" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="lga"></label>
  <div class="col-md-12">
  <label>LGA</label>
    <input id="lga" name="lga" value="'.$lga.'" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="address"></label>
  <div class="col-md-12">
  <label>Address</label>
    <textarea name="address"  class="form-control input-md">'.$address.'</textarea>
    <input  type="hidden" name="apid" value="'.$id.'">
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" name="update_appl" class="sub" value="Submit Application" class="btn btn-primary"/>
  </div>
</div>
</form>';
}else
{

echo'<div class="table-responsive"><table class="table table-striped title1">
<tr>
    <td><b>Application Submited</b></td>
    
</tr>
<tr style="text-align:center;">
    <td><b>'.$employment.'</b></td>
    
</tr>';
echo '</table>'
  ; 
}
}
}else{echo "Error";}

}

echo '</div></div>';


?>


</div></div>


<!--Modal for admin login-->
	 <div class="modal fade" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
      </div>
      <div class="modal-body title1">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<form role="form" method="post" action="admin.php?q=index.php">
<div class="form-group">
<input type="text" name="uname" maxlength="20"  placeholder="Admin user id" class="form-control"/> 
</div>
<div class="form-group">
<input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
</div>
<div class="form-group" align="center">
<input type="submit" name="login" value="Login" class="btn btn-primary" />
</div>
</form>
</div><div class="col-md-3"></div></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--footer end-->

<?php
	
?>
</body>
</html>
