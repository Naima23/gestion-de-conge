<?php
require('top.inc.php');
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from employees where id='$id'");
}
$res=mysqli_query($con,"select * from employees where role=2 order by id desc");
?>



    <!-- --------------------recherche pour id -->

<?php

// if (!empty($_POST['submit'])) :
//   $user_id = $_POST['recherche'];
//   $req = $con->prepare("SELECT * FROM employees WHERE id = :user_id");
//   $req->bindParam(':user_id', $user_id, PDO::PARAM_INT);
//   $req->execute();
//   $infos = $req->fetch();
//   print_r($infos);
//   $_SESSION['info_update'] = $infos;
//   if (!empty($infos)) :
//     header('location:employee.php?verif=modification');
//   else :
//     header('location:employee.php?erreur=IDindisponible');
//   endif;
// elseif (!empty($_POST['update'])) :
  
//   $id = $_SESSION['info_update']['id'];
//   $password = $_SESSION['info_update']['password'];
//   $query = $con->prepare("UPDATE employees SET name = ?, Email = ?, Mobile = ?, Password = ? , Department = ?, Address = ?, Birthday = ? , WHERE id=$id ");
//   $passwordhash = password_hash($password, PASSWORD_BCRYPT);
//   $query->execute([$_POST['Name'], $passwordhash, $_POST['Email'], $_POST['Mobile'], $_POST['Password'], $_POST['Department'], $_POST['Address'], $_POST['Birthday']]);
//   header('location:employee.php?modification=updateok');

  
// endif;

?>











<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Employee Master </h4>
						   <h4 class="box_title_link"><a href="add_employee.php">Add Employee</a> </h4>

      <!------------------------------ button recherche               -->
                     <!-- <form method="POST">
  <label for=""> ID </label> <br>
  <input type="text" name="recherche" id="">
  <input type="submit" name="submit" value="submit">
</form> -->

                    
 

                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="40%">Name</th>
									   <th width="15%">Email</th>
									   <th width="15%">Mobile</th>
                                       <th width="20%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){?>
									<tr>
                                       <td><?php echo $i?></td>
									   <td><?php echo $row['id']?></td>
                                       <td><?php echo $row['name']?></td>
									   <td><?php echo $row['email']?></td>
									   <td><?php echo $row['mobile']?></td>
									   <td><a href="add_employee.php?id=<?php echo $row['id']?>">Edit</a> <a href="employee.php?id=<?php echo $row['id']?>&type=delete">Delete</a></td>
                                    </tr>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         
<?php
require('footer.inc.php');
?>