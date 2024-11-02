<?php
// retrieve the form inputs
require_once 'database-connection.php';

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

// check if date is empty, and set it to the current date if it is
if (empty($_GET['date'])) {
    $date = date('Y-m-d');
} else {
    $date = $_GET['date'];
}

// prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO recettes (date, declared_amount, undeclared_amount, undeclared_expenses) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siii", $date, $declared_amount, $undeclared_amount, $undeclared_expenses);

// execute the statement
if ($stmt->execute()) {
    // display success message and redirect to charges.php
    $message = "Recettes ajoutés avec succès !";
    $alert_class = "alert-success";
    $redirect_url = "recettes.php";
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
  
  <div class="text"><h1>Ajouter une recette</h1></div>
      <div class="container">
		<form method="POST" action="save-recette.php">
			<div class="form-group">
				<label for="date">Date:</label>

				<input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required readonly>
			</div>
			<div class="form-group">
				<label for="declared_amount">Montants Déclarés:</label>
				<input type="number" value="0" class="form-control" id="declared_amount" name="declared_amount">
			</div>
			<div class="form-group">
				<label for="undeclared_amount">Montants non déclarés:</label>
				<input type="number" value="100" class="form-control" id="undeclared_amount" name="undeclared_amount">
			</div>
			<div class="form-group">
				<label for="undeclared_expenses">Dépenses non déclarées:</label>
				<input type="number" value="0" class="form-control" id="undeclared_expenses" name="undeclared_expenses">
			</div>
			<button type="submit" class="btn btn-primary" name="submit">Enregistrer</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('recette-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var amountInputs = document.querySelectorAll('input[name^="declared_amount"], input[name^="undeclared_amount"], input[name^="undeclared_expenses"]');
            var data = [];
            for (var i = 0; i < amountInputs.length; i++) {
                var input = amountInputs[i];
                var row = input.closest('tr');
                var id = row.querySelector('input[name="id"]').value;
                var name = input.getAttribute('name');
                var value = input.value;
                data.push({
                    id: id,
                    name: name,
                    value: value
                });
            }

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('Changes saved successfully!');
                }
            };
            xhr.open('POST', 'update-recette.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.send(JSON.stringify(data));
        });
    });
</script>
