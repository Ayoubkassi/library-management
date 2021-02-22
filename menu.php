<?php 
	include 'init.php';



?>
<div class="container menu">
  <div class="row row-cols-auto">
    <div class="col">
    	<div class="card">
  <div class="card-header">
    Etudiant
  </div>
  <div class="card-body">
    <h5 class="card-title">Etudiant infos</h5>
    <p class="card-text">Here u could see the list of all student or add a new one.</p>
    <a href="list_etudiants.php" class="btn btn-primary">Liste des étudiant</a>
    <a href="ajouter_etudiant.php" class="btn btn-info">Ajouter étudiant</a>

  </div>
</div>
    </div>
    <div class="col">
    	<div class="card">
  <div class="card-header">
    Livre
  </div>
  <div class="card-body">
    <h5 class="card-title">Livre infos</h5>
    <p class="card-text">Here u could see the list of all book or add a new one.</p>
    <a href="list_livre.php" class="btn btn-primary">Liste des livres</a>
    <a href="ajouter_livre.php" class="btn btn-info">Ajouter livres</a>

  </div>
</div>
    </div>
    <div class="col">
    	<div class="card">
  <div class="card-header">
    Emprunts
  </div>
  <div class="card-body">
    <h5 class="card-title">Emprunts infos</h5>
    <p class="card-text">Here u could see the list of all emprunts or add a new one.</p>
    <a href="list_emprunt.php" class="btn btn-primary">Liste des emprunts</a>
    <a href="ajouter_emprunt.php" class="btn btn-info">Ajouter emprunts</a>

  </div>
</div>
    </div>
  </div>
</div>

<?php include 'footer.php' ?>

