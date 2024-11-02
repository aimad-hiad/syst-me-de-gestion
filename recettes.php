<?php
require_once('database-connection.php');

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
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <!-- Add this script tag to the head of the page -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<title>Recettes</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style>
		.container {
			margin-top: 50px;
		}
		
		.vertical-table {
            display: table;
            table-layout: fixed;
            width: 100%;
        }

        .vertical-table td:first-child {
            width: 40%;
        }

	</style>
</head>
<body>

  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
        <div class="logo_name" href="index.php">Cocci Market</div>
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
      <div class="text"><h1>Recettes</h1></div>
	  	<div class="container">
		<form method="post">
    <div class="form-group">
        <label for="date_filter">Filtrer par date :</label>
        <input type="date" class="form-control" id="date_filter" name="date_filter" value="<?php echo isset($_POST['date_filter']) ? $_POST['date_filter'] : $current_date; ?>">
    </div>
    <button type="submit" class="btn btn-primary" name="filter">Filtrer</button>
</form>
		<hr>
		<form method="post" action="update-recette.php" id="form-recettes">
            <div class="table-responsive">
                <table class="table table-striped vertical-table">
                    <tbody>
                        <?php 
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><strong>Date:</strong></td>
                                
									
									<td><span name="date"><?php echo $row['date']; ?></span></td>


                                </tr>
                                <tr>
                                    <td><strong>Montants Déclarés:</strong></td>
                                    <td><input type="number" name="montant_declare_<?php echo $row['id']; ?>" value="<?php echo $row['declared_amount']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><strong>Montants non déclarés:</strong></td>
                                    <td><input type="number" name="undeclared_amount_<?php echo $row['id']; ?>" value="<?php echo $row['undeclared_amount']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><strong>Dépenses non déclarées:</strong></td>
                                    <td><input type="number" name="undeclared_expenses_<?php echo $row['id']; ?>" value="<?php echo $row['undeclared_expenses']; ?>"></td>
                                </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
                // Display the "Save changes" button
                echo '<button type="submit" class="btn btn-primary" name="submit">Sauvegarder</button>';
            } else { ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Aucun résultat trouvé !
                </div>
                <?php
				if(isset($_POST['date_filter'])) {
  $date = urlencode($_POST['date_filter']);
} else {
  $date = ''; // set a default value if the index is not set
}
				
                // Display the "Add recette" button
				  echo "<a href='add-recette.php?date={$date}' class='btn btn-primary'>Ajouter recettes</a>";
            } 
            ?>
            <input type="hidden" name="action" value="save_changes">
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
  <script>
  let recettesLink = document.querySelector("#recettes-link");
  let homeSection = document.querySelector(".home-section");

  recettesLink.addEventListener("click", () => {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        homeSection.innerHTML = this.responseText;
      }
    };
    xhr.open("GET", "recettes.php", true);
    xhr.send();
  });
</script>
<!------------ JS code for Add recettes -->
<script>
$(document).ready(function() {
    $('#add-recette-form').submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action') || window.location.href;
        var method = form.attr('method');

        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            success: function(response) {
                $('#add-recette-message').html('<div class="alert alert-success mt-3" role="alert">Record added successfully!</div>');
                form[0].reset();
            },
            error: function(xhr, status, error) {
                $('#add-recette-message').html('<div class="alert alert-danger mt-3" role="alert">Error: ' + error + '</div>');
            }
        });
    });
});
</script>
<!------------ JS code for Add recettes -->
</body>

</html>
