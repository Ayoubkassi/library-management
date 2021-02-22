<?php 
 include 'init.php';

$do= isset($_GET['do']) ? $_GET['do'] : 'Manage';
  if($do == 'Manage'){
   	$sql = "SELECT * FROM livre";
   	$result = mysqli_query($conn,$sql);

   	 		echo "
   	 		<div class='content'>
   	 		<table class='table table-hover tab'>
 		 <thead class='table-dark'>
 		 	<tr>
      <th>isbn</th>
      <th>titre_livre</th>
      <th>auteur</th>
      <th>image_livre</th>
      <th></th>
    </tr>
 		  </thead>  <tbody>
 		 ";

   	while ($row = mysqli_fetch_assoc($result)) {
   			echo "	<tr>
      <th>".$row['isbn']."</th>
      <th>" .$row['titre_livre']. "</th>
      <th>" .$row['auteur']. "</th>
      <th>" .$row['image_livre']."</th>
      <th>
        <a href='list_livre.php?do=Edit&isbn=" . $row['isbn'] . "' class='btn btn-info'><i class='fa fa-edit'></i>Edit</a>
        <a href='list_livre.php?do=Delete&isbn=" . $row['isbn'] . "' class='btn btn-danger'><i class='fa fa-times'></i>Delete </a>

      </th>
    </tr> ";

}
echo "  </tbody>
</table></div>";

}

else if($do == 'Edit'){

  $isbn = isset($_GET['isbn']) && is_numeric($_GET['isbn']) ? intval($_GET['isbn']) : 0;
   $sql = "SELECT * From livre WHERE isbn= '$isbn'  LIMIT 1";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_assoc($result);
   /*$count = mysqli_num_rows($result);
   echo $count;_*/
   ?>
    <h1 class="text-center mt-4">Edit Book</h1>
   <form action="?do=Update" method="POST" enctype="multipart/form-data">
    <div class="marg"> 
     <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Isbn</label>
    <input type="text" class="form-control" value="<?php echo $row['isbn'] ?>" name="isbn" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Titre de livre</label>
    <input type="text" class="form-control" value="<?php echo $row['titre_livre'] ?>" name="titre" id="exampleInputPassword1">
  </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Auteur</label>
    <input type="text" class="form-control" value="<?php echo $row['auteur'] ?>" name="auteur" id="exampleInputPassword1">
  </div>
     <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Edit Book</button>
</div>
</form>

<?php
}

else if($do =='Update'){
echo "<h1 class='text-center mt-4'>Update Book</h1>";
            echo "<div class='container'>";
    
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //get the variables from the post

                $isbn = $_POST['isbn'];
                $titre = $_POST['titre'];
                $auteur = $_POST['auteur'];


                $formErrors = array();

                if(empty($isbn)){
                    $formErrors[]=   'Numero apogee canno\'t be <strong>empty</strong>' ;
                }
    
                if(empty($titre)){
                    $formErrors[]=   'Titre canno\'t be <strong>empty</strong>' ;
                }
    
                if(empty($auteur)){
                    $formErrors[]=   'Auteur canno\'t be<strong>empty</strong>' ;
                }

                foreach($formErrors as $error){
                    echo '<div class="alert alert-danger col-md-8">' . $error . '<div/>';
                }

                
                if(empty($formErrors)){
                    $sql = "UPDATE livre SET auteur='$auteur',titre_livre='$titre' WHERE isbn='
                    $isbn'";
                    $result = mysqli_query($conn,$sql);


                     // Echo success message
       
                    echo  "<div class='alert alert-info col-md-10'>1 Record Updated </div>";
                    echo"</div>";
                    header('refresh:2;url = list_livre.php');

                }
                else {
                header('refresh:3;url = list_livre.php');
            }
                
  }
}



elseif($do == 'Delete'){
  $isbn = isset($_GET['isbn']) && is_numeric($_GET['isbn']) ? intval($_GET['isbn']) : 0;
  $sql = "DELETE FROM livre WHERE isbn='$isbn'";
  $result = mysqli_query($conn,$sql);

  echo "<h1 class='text-center mt-4'>Delete Book</h1>";
            echo "<div class='container'>";

            echo  "<div class='alert alert-info col-md-10'>1 Record Deleted </div>";
            echo"</div>";
            header('refresh:2;url = list_livre.php');
}



include 'footer.php';
 ?>
