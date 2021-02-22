<?php include 'init.php' ?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <div class="marg"> 
      <h2>Add Livre</h2>
     <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Isbn</label>
    <input type="text" class="form-control" name="isbn" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Titre de livre</label>
    <input type="text" class="form-control" name="titre" id="exampleInputPassword1">
  </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Auteur</label>
    <input type="text" class="form-control" name="auteur" id="exampleInputPassword1">
  </div>
     <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Add livre</button>
</div>
</form>
<?php 
  if () {

        $isbn=$_POST['isbn'];
        $titre=$_POST['titre'];
        $auteur=$_POST['auteur'];
        $avatarName = $_FILES['image']['name'];
        $avatarSize = $_FILES['image']['size'];
        $avatarTmp  = $_FILES['image']['tmp_name'];
        $avatarType = $_FILES['image']['type'];

        // List Of Allowed File Typed To Upload

        $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");

        // Get Avatar Extension

        $avatarExtension = explode('.', $avatarName);
        $avatarExtension = strtolower(end($avatarExtension));

        // Validate The Form

        $formErrors = array();

        if (empty($isbn)) {
          $formErrors[] = 'Apogee Cant Be <strong>Empty</strong>';
        }

        if (empty($titre)) {
          $formErrors[] = 'Nom Cant Be <strong>Empty</strong>';
        }

        if (empty($auteur)) {
          $formErrors[] = 'Prenom Cant Be <strong>Empty</strong>';
        }

        if (! empty($avatarName) && ! in_array($avatarExtension, $avatarAllowedExtension)) {
          $formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';
        }

        if (empty($avatarName)) {
          $formErrors[] = 'Avatar Is <strong>Required</strong>';
        }

        if ($avatarSize > 4194304) {
          $formErrors[] = 'Avatar Cant Be Larger Than <strong>4MB</strong>';
        }

        // Loop Into Errors Array And Echo It

        foreach($formErrors as $error) {
          echo '<div class="alert alert-danger">' . $error . '</div>';
        }

        // Check If There's No Error Proceed The Update Operation

        if (empty($formErrors)) {

          $avatar = rand(0, 10000000000) . '_' . $avatarName;

          $source_path = $picTmp;

          $target_path = 'up/' . $_FILES['image']['name'];;

          move_uploaded_file($source_path,$target_path);


          $sql = "INSERT INTO livre VALUES('$isbn','$titre','$auteur','$avatarName')";

          $result = mysqli_query($conn,$sql);

          if($result == true){
            echo "Félicitation livre ajouté";
                header('Location: list_livre.php');
          }
          else{
            echo "Error of creation";
          }
          include 'footer.php' ;}}


?>

