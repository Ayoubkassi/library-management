<?php
    session_start();

 include 'init.php' ?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <div class="marg"> 
      <h2>Add Emprunt</h2>
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

<div class="form-group row">
        <label for="exampleInputPassword1" class="form-label">Date de retour</label>
  <div class="col-10">
    <input class="form-control" type="date" name="dt_retour" value="2020-12-29" id="example-datetime-local-input">
  </div>
</div>
  <button type="submit" class="btn btn-primary bz">Add emprunt</button>
</div>
</form>
<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $etudiant=$_POST['etudiant'];
        $livre=$_POST['livre'];
        $dt_debut=$_POST['dt_debut'];
        $dt_retour=$_POST['dt_retour'];
        $id_gest = $_SESSION['ID'];




      
        // Check If There's No Error Proceed The Update Operation


          $sql = "INSERT INTO emprunt VALUES(NULL,'$etudiant','$livre','$dt_debut','$dt_retour','$id_gest')";

          $result = mysqli_query($conn,$sql);

          if($result == true){
            echo "Félicitation emprunt ajouté";
                header('Location: list_emprunt.php');
          }
         
}

include 'footer.php' ;
?>

