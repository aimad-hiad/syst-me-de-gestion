
<?php
require_once('database-connection.php');

if(isset($_POST['submit'])) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'montant_declare') !== false) {
            $id = str_replace('montant_declare_', '', $key);
            $montant_declare = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE recettes SET declared_amount = '$montant_declare' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        } elseif (strpos($key, 'undeclared_amount') !== false) {
            $id = str_replace('undeclared_amount_', '', $key);
            $undeclared_amount = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE recettes SET undeclared_amount = '$undeclared_amount' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        } elseif (strpos($key, 'undeclared_expenses') !== false) {
            $id = str_replace('undeclared_expenses_', '', $key);
            $undeclared_expenses = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE recettes SET undeclared_expenses = '$undeclared_expenses' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        } elseif (strpos($key, 'date') !== false) {
            $id = str_replace('date_', '', $key);
            $date = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE recettes SET date = '$date' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
    }
}


// Get current date
$current_date = date("Y-m-d");

// check if filter is set
if (isset($_POST['filter']) && isset($_POST['date_filter'])) {
    $date_filter = $_POST['date_filter'];
    $sql = "SELECT * FROM recettes WHERE date = '$date_filter' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM recettes WHERE date = '$current_date' ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
// check if the query was successful
if ($result) {
    // display success message and redirect to charges.php
    $message = "la recette a été modifiée avec succès !";
    $alert_class = "alert-success";
    $redirect_url = "recettes.php";
} else {
    // display error message
    $message = "Erreur lors de la mise à jour des recettes: " . $conn->error;
    $alert_class = "alert-danger";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Recettes</title>
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
        <a href="#">
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
       <a href="users.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Utilisateurs</span>
       </a>
       <span class="tooltip">Utilisateurs</span>
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
             <div class="name">Abdellah el merghani</div>
             <div class="job">Admin</div>
           </div>
         </div>
         <i class='bx bx-log-out' id="log_out" ></i>
     </li>
    </ul>
  </div>
  <section class="home-section">
  <div class="text"><h1>Recettes</h1></div>
	<div class="container">
		<div class="alert <?php echo $alert_class; ?>"><?php echo $message; ?></div>
		<?php if ($redirect_url) { ?>
			<meta http-equiv="refresh" content="2;url=<?php echo $redirect_url; ?>">
		<?php } ?>
	</div>
 </section>
  <script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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