<?php

// call the database-connection.php file to make a connection to the database
require_once 'database-connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Charges</title>
   <meta charset="UTF-8">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <!-- Add this script tag to the head of the page -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
        <div class="logo_name">Cocci Market</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="index.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Tableau de bord</span>
        </a>
         <span class="tooltip">Tableau de bord</span>
      </li>
	 <li>
  <a href="recettes.php">
    <i class='bx bx-dollar-circle'></i>
    <span class="links_name">Recettes</span>
  </a>
  <span class="tooltip">Recettes</span>
</li>

	 <li>
  <a href="charges.php">
    <i class='bx bx-money' ></i>
    <span class="links_name">Charges</span>
  </a>
  <span class="tooltip">Charges</span>
</li>

     <li>
  <a href="invoice.php">
    <i class='bx bx-file' ></i>
    <span class="links_name">Factures</span>
  </a>
  <span class="tooltip">Factures</span>
</li>
<li>
       <a href="#">
         <i class='bx bx-user' ></i>
         <span class="links_name">Utilisateur</span>
       </a>
       <span class="tooltip">Utilisateur</span>
     </li>
     <li>
       <a href="#">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Paramètres</span>
       </a>
       <span class="tooltip">Paramètres</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <!--<img src="profile.jpg" alt="profileImg">-->
           <div class="name_job">
             <div class="name">Prem Shahi</div>
             <div class="job">Web designer</div>
           </div>
         </div>
         <i class='bx bx-log-out' id="log_out" ></i>
     </li>
    </ul>
  </div>
  <section class="home-section">
  <div class="text"><h1>Ajouter des charges</h1></div>
	<div class="container">
		<form method="POST" action="save-charges.php">
			<div class="form-group">
				<label for="date">Date:</label>
				<input type="date" class="form-control" id="date" name="date" value="<?php echo isset($_GET['year']) && isset($_GET['month']) ? $_GET['year'] . '-' . str_pad($_GET['month'], 2, '0', STR_PAD_LEFT) . '-01' : date('Y-m-d'); ?>" required readonly>

			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Nom des charges</th>
						<th>Montant</th>
					</tr>
				</thead>
				<tbody>
					<tr>
    <td>Electricite</td>
    <td>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">€</span>
            </div>
            <input type="number" value="0" class="form-control" id="electricite" name="electricite" required>
        </div>
    </td>
</tr>
<tr>
    <td>Eau</td>
    <td>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">€</span>
            </div>
            <input type="number" value="0" class="form-control" id="eau" name="eau" required>
        </div>
    </td>
</tr>
<tr>
    <td>Loyer</td>
    <td>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">€</span>
            </div>
            <input type="number" value="0" class="form-control" id="loyer" name="loyer" required>
        </div>
    </td>
</tr>
					<tr>
  <td>Gasoil</td>
  <td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number" value="0" class="form-control" id="gasoil" name="gasoil" required></div></td>
</tr>
<tr>
  <td>Abonnements</td>
  <td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number" value="0" class="form-control" id="abonnements" name="abonnements" required></div></td>
</tr>
<tr>
  <td>Comptable</td>
  <td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number" value="500" class="form-control" id="comptable" name="comptable" required></div></td>
</tr>
<tr>
  <td>Marchandises</td>
  <td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number" value="0" class="form-control" id="marchandises" name="marchandises" required></div></td>
</tr>
<tr>
  <td>URSSAF</td>
  <td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number" value="0" class="form-control" id="URSSAF" name="URSSAF" required></div></td>
</tr>
<tr>
  <td>Salaries</td>
  <td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number" value="0" class="form-control" id="salaires" name="salaires" required></div></td>
</tr>
<tr>
  <td>Autres</td>
  <td><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">€</span></div><input type="number" value="0" class="form-control" id="autres" name="autres" required></div></td>
</tr>

				</tbody>
			</table>
			<button type="submit" class="btn btn-primary">Ajouter les charges</button>
		</form>
	</div>
</div>
  </section>
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

if (window.innerWidth > 768) { // Only toggle the sidebar on mobile devices
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    }

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
  </script>
</body>
</html>
