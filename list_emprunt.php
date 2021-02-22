<?php 
 include 'init.php';
 $do= isset($_GET['do']) ? $_GET['do'] : 'Manage';
  if($do == 'Manage'){

   	$sql = "SELECT * FROM emprunt";
   	$result = mysqli_query($conn,$sql);

   	 		echo "
   	 		<div class='content'>
   	 		<table class='table table-hover tab'>
 		 <thead class='table-dark'>
 		 	<tr>
      <th>id_emprunt</th>
      <th>id_etudiant</th>
      <th>id_livre</th>
      <th>dt_debut</th>
      <th>dt_retour</th>
      <th>id_gestionaire</th>
      <th></th>


    </tr>
 		  </thead>  <tbody>
 		 ";

   	while ($row = mysqli_fetch_assoc($result)) {
   			echo "	<tr>
      <th>".$row['id_emprunt']."</th>
      <th>" .$row['id_etudiant']. "</th>
      <th>" .$row['id_livre']. "</th>
      <th>" .$row['dt_debut']."</th>
      <th>" .$row['dt_retour']."</th>
      <th>" .$row['id_gestionaire']."</th>
      <th>
        <a href='list_emprunt.php?do=Edit&emprunt=" . $row['id_emprunt'] . "' class='btn btn-info'><i class='fa fa-edit'></i>Edit</a>
        <a href='list_emprunt.php?do=Delete&emprunt=" . $row['id_emprunt'] . "' class='btn btn-danger'><i class='fa fa-times'></i>Delete </a>
      </th>


    </tr> ";

}
echo "  </tbody>
</table></div>";

}

else if($do == 'Edit'){
   $emprunt = isset($_GET['emprunt']) && is_numeric($_GET['emprunt']) ? intval($_GET['emprunt']) : 0;
   $sql = "SELECT * From emprunt WHERE id_emprunt= '$emprunt'  LIMIT 1";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_assoc($result);
   ?>
   <form action="?do=Update" method="POST" enctype="multipart/form-data">
    <div class="marg"> 
      <h2>Edit Emprunt</h2>
     <div class="form-group">
    <label for="etudiant"  class="form-label">Choose etudiant :</label>
<select id="etudiant" class="form-control" name="etudiant">
  <?php
      $sql = "SELECT * FROM etudiant";
    $result = mysqli_query($conn,$sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value=".$row['num_apogee'].">".$row['num_apogee']."</option>";
      }

   ?>  </select>  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Choose livre :</label>
    <select id="livre" class="form-control" name="livre">
  <?php
      $sql = "SELECT * FROM livre";
    $result = mysqli_query($conn,$sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value=".$row['isbn'].">".$row['isbn']."</option>";
      }

   ?>  </select>  </div>

   <div class="form-group row">
        <label for="exampleInputPassword1" class="form-label">Date de début</label>
  <div class="col-10">
    <input class="form-control" type="date" name="dt_debut" value="2020-08-19" id="example-datetime-local-input">
  </div>
</div>
   <input type="hidden" value="<?php echo $emprunt ?>" name="emprunt"> 

<div class="form-group row">
        <label for="exampleInputPassword1" class="form-label">Date de retour</label>
  <div class="col-10">
    <input class="form-control" type="date" name="dt_retour" value="2020-12-29" id="example-datetime-local-input">
  </div>
</div>
  <button type="submit" class="btn btn-primary bz">Edit emprunt</button>
</div>
</form>
<?php
}

else if($do == 'Update'){
   echo "<h1 class='text-center mt-4'>Update Emprunt</h1>";
            echo "<div class='container'>";
    
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get the variables from the post

                $emprunt= $_POST['emprunt'];
                $id = $_POST['etudiant'];
                $livre = $_POST['livre'];
                $dt_debut = $_POST['dt_debut'];
                $dt_retour = $_POST['dt_retour'];


                $formErrors = array();

                if(empty($id)){
                    $formErrors[]=   'Etudiant canno\'t be <strong>empty</strong>' ;
                }
    
                if(empty($livre)){
                    $formErrors[]=   'Book\'t be <strong>empty</strong>' ;
                }
    
                if(empty($dt_debut)){
                    $formErrors[]=   'Date debut_ canno\'t be<strong>empty</strong>' ;
                }

                if(empty($dt_retour)){
                    $formErrors[]=   'Date retour canno\'t be<strong>empty</strong>' ;
                }

                foreach($formErrors as $error){
                    echo '<div class="alert alert-danger col-md-8">' . $error . '<div/>';
                }

                
                if(empty($formErrors)){
                    $sql = "UPDATE emprunt SET id_etudiant='$id',id_livre='$livre',dt_debut='$dt_debut',dt_retour='$dt_retour' WHERE id_emprunt='$emprunt'";
                    $result = mysqli_query($conn,$sql);


                     // Echo success message
       
                    echo  "<div class='alert alert-info col-md-10'>1 Record Updated </div>";
                    echo"</div>";
                    header('refresh:2;url = list_emprunt.php');

                }
                else {
                header('refresh:3;url = list_emprunt.php');
            }
                
  }
}

else if($do == 'Delete'){
   $emprunt = isset($_GET['emprunt']) && is_numeric($_GET['emprunt']) ? intval($_GET['emprunt']) : 0;
  $sql = "DELETE FROM emprunt WHERE id_emprunt='$emprunt'";
  $result = mysqli_query($conn,$sql);

  echo "<h1 class='text-center mt-4'>Delete Emprunt</h1>";
            echo "<div class='container'>";

            echo  "<div class='alert alert-info col-md-10'>1 Record Deleted </div>";
            echo"</div>";
            header('refresh:2;url = list_emprunt.php');
}


include 'footer.php';
 ?>
