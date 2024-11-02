<?php
// connect to the database
require_once('database-connection.php');

// get invoice id from the URL parameter
$invoice_id = $_GET['id'];

// get the details of the invoice from the database
$sql = "SELECT * FROM degrenne_invoice WHERE invoice_id = $invoice_id";
$result = mysqli_query($conn, $sql);

// check if the invoice exists
if (mysqli_num_rows($result) == 0) {
    echo "<script>
          alert('Invoice not found');
          window.location.href = 'index.php';
          </script>";
    exit();
}

// get the current values of the invoice
$row = mysqli_fetch_assoc($result);
$invoice_date = $row['invoice_date'];
$invoice_amount = $row['invoice_amount'];

// check if the form has been submitted
if (isset($_POST['submit'])) {
    // get the new values of the invoice from the form
    $new_invoice_date = $_POST['invoice_date'];
    $new_invoice_amount = $_POST['invoice_amount'];

    // update the invoice in the database
    $sql = "UPDATE degrenne_invoice SET invoice_date = '$new_invoice_date', invoice_amount = '$new_invoice_amount' WHERE invoice_id = $invoice_id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
              alert('Invoice updated successfully');
              window.location.href = 'invoice.php';
              </script>";
        exit();
    } else {
        echo "<script>
              alert('Error updating invoice: " . mysqli_error($conn) . "');
              window.location.href = 'index.php';
              </script>";
        exit();
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Modifier la facture</title>
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
             <div class="name">Abdellah el merghani</div>
             <div class="job">Admin</div>
           </div>
         </div>
         <i class='bx bx-log-out' id="log_out" ></i>
     </li>
    </ul>
  </div>

    <section class="home-section">
      <div class="text"><h1>Modifier la facture</h1></div>
	  <div class="container">
        <form method="post" action="update-invoice.php">
    <div class="form-group">
        <label for="invoice_date">Date de facturation:</label>
        <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="<?php echo $invoice_date; ?>" required>
    </div>
    <div class="form-group">
        <label for="invoice_amount">Montant de la facture:</label>
        <input type="number" class="form-control" id="invoice_amount" name="invoice_amount" value="<?php echo $invoice_amount; ?>" required>
    </div>
    <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>">
    <button type="submit" name="submit" class="btn btn-primary">Sauvegarder</button>
    <a href="invoice.php" class="btn btn-secondary">Annuler</a>
</form>

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
