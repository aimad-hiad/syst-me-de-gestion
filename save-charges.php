<?php
require_once 'database-connection.php';
// retrieve the form inputs
$date = $_POST['date'];
$electricite = $_POST['electricite'];
$eau = $_POST['eau'];
$loyer = $_POST['loyer'];
$gasoil = $_POST['gasoil'];
$abonnements = $_POST['abonnements'];
$comptable = $_POST['comptable'];
$marchandises = $_POST['marchandises'];
$URSSAF = $_POST['URSSAF'];
$salaires = $_POST['salaires'];
$autres = $_POST['autres'];

// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO charges (date, electricite, eau, loyer, gasoil, abonnements, comptable, marchandises, URSSAF, salaires, autres) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiiiiiiiii", $date, $electricite, $eau, $loyer, $gasoil, $abonnements, $comptable, $marchandises, $URSSAF, $salaires, $autres);

// execute the statement
if ($stmt->execute()) {
    // display success message and redirect to charges.php
    $message = "Charges ajoutés avec succès !";
    $alert_class = "alert-success";
    $redirect_url = "charges.php";
} else {
    // display error message
    $message = "Error adding charges: " . $conn->error;
    $alert_class = "alert-danger";
}

// close the connection
$conn->close();
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
  <div class="text"><h1>Charges</h1></div>
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
