
<?php
require_once('database-connection.php');

if(isset($_POST['submit'])) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'electricite') !== false) {
            $id = str_replace('electricite_', '', $key);
            $electricite = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET electricite = '$electricite' WHERE id = '$id'";
            mysqli_query($conn, $sql);
			} elseif (strpos($key, 'date') !== false) {
            $id = str_replace('date_', '', $key);
            $date = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET date = '$date' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        } elseif (strpos($key, 'eau') !== false) {
            $id = str_replace('eau_', '', $key);
            $eau = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET eau = '$eau' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        } elseif (strpos($key, 'loyer') !== false) {
            $id = str_replace('loyer_', '', $key);
            $loyer = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET loyer = '$loyer' WHERE id = '$id'";
            mysqli_query($conn, $sql);
			} elseif (strpos($key, 'gasoil') !== false) {
            $id = str_replace('gasoil_', '', $key);
            $gasoil = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET gasoil = '$gasoil' WHERE id = '$id'";
            mysqli_query($conn, $sql);
			} elseif (strpos($key, 'abonnements') !== false) {
            $id = str_replace('abonnements_', '', $key);
            $abonnements = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET abonnements = '$abonnements' WHERE id = '$id'";
            mysqli_query($conn, $sql);
			} elseif (strpos($key, 'comptable') !== false) {
            $id = str_replace('comptable_', '', $key);
            $comptable = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET comptable = '$comptable' WHERE id = '$id'";
            mysqli_query($conn, $sql);
			} elseif (strpos($key, 'marchandises') !== false) {
            $id = str_replace('marchandises_', '', $key);
            $marchandises = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET marchandises = '$marchandises' WHERE id = '$id'";
            mysqli_query($conn, $sql);
			} elseif (strpos($key, 'URSSAF') !== false) {
            $id = str_replace('URSSAF_', '', $key);
            $URSSAF = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET URSSAF = '$URSSAF' WHERE id = '$id'";
            mysqli_query($conn, $sql);
			} elseif (strpos($key, 'salaires') !== false) {
            $id = str_replace('salaires_', '', $key);
            $salaires = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET salaires = '$salaires' WHERE id = '$id'";
            mysqli_query($conn, $sql);
			} elseif (strpos($key, 'autres') !== false) {
            $id = str_replace('autres_', '', $key);
            $autres = mysqli_real_escape_string($conn, $value);
            $sql = "UPDATE charges SET autres = '$autres' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
    }
}


// Get current date
$current_date = date("Y-m-d");

// check if filter is set
if (isset($_POST['filter']) && isset($_POST['date_filter'])) {
    $date_filter = $_POST['date_filter'];
    $sql = "SELECT * FROM charges WHERE date = '$date_filter' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM charges WHERE date = '$current_date' ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
// check if the query was successful
if ($result) {
    // display success message and redirect to charges.php
    $message = "Charges modifiés avec succès !";
    $alert_class = "alert-success";
    $redirect_url = "charges.php";
} else {
    // display error message
    $message = "Erreur lors de la mise à jour des charges: " . $conn->error;
$message .= "<br> SQL Query: " . $sql;
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
          <i class='bx bx-search' ></i>
         <input type="text" placeholder="Search...">
         <span class="tooltip">Search</span>
      </li>
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