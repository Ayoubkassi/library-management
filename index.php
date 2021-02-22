<?php 
  session_start();

   $noNavbar='';

     // Check If User Coming From HTTP Post Request

  if (isset($_SESSION['ID'])) {
    header('Location: menu.php'); // Redirect To Dashboard Page
  }

	include 'init.php';




  	if($_SERVER['REQUEST_METHOD'] == "POST"){
  	$user= $_POST['user'];
  	$pass = $_POST['pass'];

  	$sql = "SELECT * FROM gestionaire WHERE login='".$user."' and pass='".$pass."'";
  	$result = mysqli_query($conn,$sql);
    $info = mysqli_fetch_assoc($result);
  	$nbr = mysqli_num_rows($result);
  	if($nbr == 0){

  }else{
    $_SESSION['ID'] = $info['id_gestionaire']; // Register Session ID
  	header("Location:menu.php");
  	exit();
}

  }

 ?>
<div class="container main">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <h2>LOGIN</h2>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="user" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
<div class="d-grid gap-2">
  <input type="submit" class="btn btn-primary" value="LOGIN">
</form>
</div>

<?php include 'footer.php' ?>
