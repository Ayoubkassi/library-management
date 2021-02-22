<?php 
 include 'init.php';
 $do= isset($_GET['do']) ? $_GET['do'] : 'Manage';
  if($do == 'Manage'){

   	$sql = "SELECT * FROM etudiant";
   	$result = mysqli_query($conn,$sql);

   	 		echo "
   	 		<div class='content'>
   	 		<table class='table table-hover tab'>
 		 <thead class='table-dark'>
 		 	<tr>
      <th>num_apogee</th>
      <th>nom</th>
      <th>prenom</th>
      <th>image</th>
      <th></th>
    </tr>
 		  </thead>  <tbody>
 		 ";

   	while ($row = mysqli_fetch_assoc($result)) {
   			echo "	<tr>
      <th>".$row['num_apogee']."</th>
      <th>" .$row['nom']. "</th>
      <th>" .$row['prenom']. "</th>
      <th>" .$row['image']."</th>
      <th>
        <a href='list_etudiants.php?do=Edit&userid=" . $row['num_apogee'] . "' class='btn btn-info'><i class='fa fa-edit'></i>Edit</a>
        <a href='list_etudiants.php?do=Delete&userid=" . $row['num_apogee'] . "' class='btn btn-danger'><i class='fa fa-times'></i>Delete </a>

      </th>
    </tr> ";

}
echo "  </tbody>
</table></div>";
}

else if($do == 'Edit'){
   $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
   $sql = "SELECT * From etudiant WHERE num_apogee= '$userid'  LIMIT 1";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_assoc($result);
   /*$count = mysqli_num_rows($result);
   echo $count;_*/
   ?>
    <h1 class="text-center mt-4">Edit Member</h1>
   <form action="?do=Update"  method="POST" enctype="multipart/form-data">
    <div class="marg"> 
     <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Num apogee</label>
    <input type="text" class="form-control" name="apog" value="<?php echo $row['num_apogee'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Nom</label>
    <input type="text" class="form-control" value="<?php echo $row['nom'] ?>" name="nom" id="exampleInputPassword1">
  </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prenom</label>
    <input type="text" class="form-control" value="<?php echo $row['prenom'] ?>" name="prenom" id="exampleInputPassword1">
  </div>
     <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Edit student</button>
</div>
</form>

<?php
}
else if($do =='Update'){
    echo "<h1 class='text-center'>Update Student</h1>";
            echo "<div class='container'>";
    
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get the variables from the post

                $id = $_POST['apog'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];


                $formErrors = array();

                if(empty($id)){
                    $formErrors[]=   'Numero apogee canno\'t be <strong>empty</strong>' ;
                }
    
                if(empty($nom)){
                    $formErrors[]=   'Nom canno\'t be <strong>empty</strong>' ;
                }
    
                if(empty($prenom)){
                    $formErrors[]=   'Prenom canno\'t be<strong>empty</strong>' ;
                }

                foreach($formErrors as $error){
                    echo '<div class="alert alert-danger col-md-8">' . $error . '<div/>';
                }

                if(empty($formErrors)){
                    $sql = "UPDATE etudiant SET nom= '$nom',prenom='$prenom' WHERE num_apogee='
                    $id'";
                    $result = mysqli_query($conn,$sql);


                     // Echo success message
       
                    echo  "<div class='alert alert-info col-md-10'>1 Record Updated </div>";
                    echo"</div>";
                    header('refresh:2;url = list_etudiants.php');

                }
                else {
                header('refresh:3;url = list_etudiants.php');
            }
                
  }
}

elseif($do == 'Delete'){
  $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
  $sql = "DELETE FROM etudiant WHERE num_apogee='$userid'";
  $result = mysqli_query($conn,$sql);

  echo "<h1 class='text-center'>Delete Student</h1>";
            echo "<div class='container'>";

            echo  "<div class='alert alert-info col-md-10'>1 Record Deleted </div>";
            echo"</div>";
            header('refresh:2;url = list_etudiants.php');
}

include 'footer.php';
 ?>
