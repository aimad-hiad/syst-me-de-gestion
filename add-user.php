<?php
// establish database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "my_database"; // replace with your database name
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check if form is submitted
if(isset($_POST['submit'])) {
  // get form data
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  // insert data into the database
  $sql = "INSERT INTO users (fullname, username, password) VALUES ('$fullname', '$username', '$password')";
  $result = mysqli_query($conn, $sql);

  // check if the insertion was successful
  if($result) {
    // Display a success message if the record was updated successfully
    $message = "l'utilisateur a été ajouté avec succès !";
    $alert_class = "alert-success";
    $redirect_url = "users.php";
  } else {
    // Display an error message if the record was not updated successfully
    $message = "erreur lors de la mise à jour de l'utilisateur: " . mysqli_error($conn);
  }
}

// close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Utilisateurs</title>
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
             <div class="name">Prem Shahi</div>
             <div class="job">Web designer</div>
           </div>
         </div>
         <i class='bx bx-log-out' id="log_out" ></i>
     </li>
    </ul>
  </div>
  <section class="home-section">
      <div class="text"><h1>Utilisateurs</h1></div>
	  <div class="container">
  <form method="post" action="user-added.php">
  <div class="table-responsive">
        <table class="table table-striped vertical-table">
            <tbody>
			<tr>
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
             <td><strong>Nom et prénom :</strong></td>
             <td><input type="text" name="fullname" required></td>
             </tr>
			 <tr>
             <td><strong>Utilisateur :</strong></td>
             <td><input type="text" name="username" required></td>
             </tr>
			 <tr>
             <td><strong>Mot de pass :</strong></td>
             <td><input type="text" name="password" required></td>
             </tr>
	</tbody>
	</table>
	</div>
	<input type="submit" class="btn btn-success" name="submit" value="Ajouter l'utilisateur">
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
</body>
</html>