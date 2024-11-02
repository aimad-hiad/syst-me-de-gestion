<?php
// Call the database-connection.php file to establish a connection to the database
require_once('database-connection.php');

// retrieve the selected year and month
$year = isset($_POST['year']) ? $_POST['year'] : date("Y");
$month = isset($_POST['month']) ? $_POST['month'] : date("n");

$current_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
$current_month = isset($_POST['month']) ? $_POST['month'] : date("n");

if (isset($_POST['year'])) {
  $current_year = $_POST['year'];
}
if (isset($_POST['month'])) {
  $current_month = $_POST['month'];
}

// Construct the SQL query to retrieve the invoices based on the selected year and month filters
$invoices_query = "SELECT * FROM degrenne_invoice WHERE YEAR(invoice_date) = ? AND MONTH(invoice_date) = ? ORDER BY invoice_date DESC";
$stmt = $conn->prepare($invoices_query);
$stmt->bind_param("ss", $current_year, $current_month);
$stmt->execute();
$invoices_result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
     <title>Degrenne Invoice Table</title>
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
      <div class="text"><h1>Factures</h1></div>
	  <div class="container">
  <form method="post">
  <form method="post">
    <label for="date_filter">Filtrer par la date:</label>
    <div class="form-row">
        <div class="col-md-2 mb-3">
            <select class="form-control" name="year">
                <?php 
                $currentYear = date("Y");
                for ($i = $currentYear; $i >= 2013; $i--) {
                    echo '<option value="'.$i.'"';
                    if ($year == $i) {
                        echo ' selected="selected"';
                    }
                    echo '>'.$i.'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <select class="form-control" name="month">
                <?php 
                $currentMonth = date("n");
                $monthNames = array(
                    1 => 'Janvier',
                    2 => 'Février',
                    3 => 'Mars',
                    4 => 'Avril',
                    5 => 'Mai',
                    6 => 'Juin',
                    7 => 'Juillet',
                    8 => 'Août',
                    9 => 'Septembre',
                    10 => 'Octobre',
                    11 => 'Novembre',
                    12 => 'Décembre'
                );
                for ($i = 1; $i <= 12; $i++) {
                    echo '<option value="'.$i.'"';
                    if ($month == $i) {
                        echo ' selected="selected"';
                    }
                    echo '>'.$monthNames[$i].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <button type="submit" class="btn btn-primary form-control" name="filter">Filtrer</button>
        </div>
    </div>
</form>
	<a href="add-invoice.php?year=<?php echo $year ?>&month=<?php echo $month ?>" class="btn btn-success">Ajouter une facture</a>

  </form>

  <table class="table table-striped">
    <thead>
      <tr>
                <th>Date de facture</th>
                <th>Montant de facture (Euro)</th>
				<th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php while ($invoice = $invoices_result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $invoice['invoice_date']; ?></td>
        <td><?php echo number_format($invoice['invoice_amount'], 2, ',', ' ').' €'; ?></td>
        <td>
			<a href="modify-invoice.php?id=<?php echo $invoice['invoice_id']; ?>" class="btn btn-primary">Modifier</a>
            <a href="delete-invoice.php?id=<?php echo $invoice['invoice_id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la facture de <?php echo number_format($invoice['invoice_amount'], 2, ',', ' ').' €'; ?> ?')">Supprimer</a>
        </td>
    </tr>
<?php } ?>

		    </tbody>
  </table>
  <?php if ($invoices_result->num_rows == 0) { ?>
<div class="alert alert-warning mt-3" role="alert">
                    Aucun résultat trouvé !
                </div>
<?php } ?>
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
<script>
    function saveAmount(date, charge_name) {
        var amount = document.getElementsByName(charge_name)[0].value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "save-amount.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
            }
        };
        xhr.send("date=" + date + "&charge_name=" + charge_name + "&amount=" + amount);
    }
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
  
</body>
</html>
<script type="text/babel">
  const DeleteInvoice = window.DeleteInvoice.default;
  const invoiceId = <?php echo json_encode($_GET['invoice_id']); ?>;
  ReactDOM.render(<DeleteInvoice invoiceId={invoiceId} />, document.getElementById('delete-invoice'));
</script>
