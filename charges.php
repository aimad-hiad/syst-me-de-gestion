<?php
require_once('database-connection.php');

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
	<title>Charges</title>
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
      <div class="text"><h1>Charges</h1></div>
	  	<div class="container">
		<?php 
// retrieve the selected year and month
$year = isset($_POST['year']) ? $_POST['year'] : date("Y");
$month = isset($_POST['month']) ? $_POST['month'] : date("n");

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
$stmt = $conn->prepare("SELECT * FROM charges WHERE YEAR(date) = ? AND MONTH(date) = ?");
$stmt->bind_param("ii", $year, $month);

// execute the statement
if ($stmt->execute()) {
    $result = $stmt->get_result();
} else {
    echo "Error executing query: " . $stmt->error;
}

// close the statement
$stmt->close();

// close the connection
$conn->close();

?>

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

<form method="post" action="update-charges.php" id="form-charges">
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
                                    <td><strong>Electricité:</strong></td>
                                    <td><input type="number" name="electricite_<?php echo $row['id']; ?>" value="<?php echo $row['electricite']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><strong>Eau:</strong></td>
                                    <td><input type="number" name="eau_<?php echo $row['id']; ?>" value="<?php echo $row['eau']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><strong>Loyer:</strong></td>
                                    <td><input type="number" name="loyer_<?php echo $row['id']; ?>" value="<?php echo $row['loyer']; ?>"></td>
                                </tr>
								<tr>
                                    <td><strong>Gasoil:</strong></td>
                                    <td><input type="number" name="gasoil_<?php echo $row['id']; ?>" value="<?php echo $row['gasoil']; ?>"></td>
                                </tr>
								<tr>
                                    <td><strong>Abonnements:</strong></td>
                                    <td><input type="number" name="abonnements_<?php echo $row['id']; ?>" value="<?php echo $row['abonnements']; ?>"></td>
                                </tr>
								<tr>
                                    <td><strong>Comptable:</strong></td>
                                    <td><input type="number" name="comptable_<?php echo $row['id']; ?>" value="<?php echo $row['comptable']; ?>"></td>
                                </tr>
								<tr>
                                    <td><strong>Marchandises:</strong></td>
                                    <td><input type="number" name="marchandises_<?php echo $row['id']; ?>" value="<?php echo $row['marchandises']; ?>"></td>
                                </tr>
								<tr>
                                    <td><strong>URSSAF(ETAT):</strong></td>
                                    <td><input type="number" name="URSSAF_<?php echo $row['id']; ?>" value="<?php echo $row['URSSAF']; ?>"></td>
                                </tr>
								<tr>
                                    <td><strong>Salaires:</strong></td>
                                    <td><input type="number" name="salaires_<?php echo $row['id']; ?>" value="<?php echo $row['salaires']; ?>"></td>
                                </tr>
								<tr>
                                    <td><strong>Autres:</strong></td>
                                    <td><input type="number" name="autres_<?php echo $row['id']; ?>" value="<?php echo $row['autres']; ?>"></td>
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
				   echo "<a href='add-charge.php?year={$year}&month={$month}' class='btn btn-primary'>Ajouter des charges</a>";
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
    xhr.open("GET", "charges.php", true);
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
