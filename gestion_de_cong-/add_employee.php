<?php
require('top.inc.php');
$name='';
$email='';
$mobile='';
$department_id='';
$address='';
$cin='';
$birthday='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from employees where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$name=$row['name'];
	$email=$row['email'];
	$mobile=$row['mobile'];
	$department_id=$row['department_id'];
	$address=$row['address'];
	$cin=$row['cin'];
}
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);                                               
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$department_id=mysqli_real_escape_string($con,$_POST['department_id']);
	$address=mysqli_real_escape_string($con,$_POST['address']);                                                                    
	$cin=mysqli_real_escape_string($con,$_POST['cin']);
	if($id>0){
		$sql="update employees set name='$name',email='$email',mobile='$mobile',password='$password',department_id='$department_id',address='$address',cin='$cin' where id='$id'";
	}else{
		$sql="insert into employees(name,email,mobile,password,department_id,address,cin,role) values('$name','$email','$mobile','$password','$department_id','$address','$cin','2')";
	//    $sql="insert into employees(name,email,mobile,password,department_id,address,cin,role) values('".$name."','".$email."','".$mobile."','". hash('sha256', $password)."','".$department_id."','". $address."','".$cin."','2')";

	}
	mysqli_query($con,$sql);
	header('location:employee.php');
	die();
}
?>
<link rel="stylesheet" href="employe.css">
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>employees</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter employee name" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter employee email" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter employee mobile" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Password</label>
									<input type="password"  name="password" placeholder="Enter employee password" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">service</label>
									<select name="department_id" required class="form-control">
										<option value="">Select service</option>
										<?php
										$res=mysqli_query($con,"select * from service order by service desc");
										while($row=mysqli_fetch_assoc($res)){
											if($department_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['service']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['service']."</option>";
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Address</label>
									<input type="text" value="<?php echo $address?>" name="address" placeholder="Enter employee address" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">cin</label>
									<input type="text" value="<?php echo $cin?>" name="cin" placeholder="Enter employee cin" class="form-control" required>
								</div>
							   <?php if($_SESSION['ROLE']==1){?>
							   <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <?php } ?>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                  
<?php

?>