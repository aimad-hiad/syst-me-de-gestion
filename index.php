<?php
// call the database-connection.php file to make a connection to the database
require_once 'database-connection.php';

// Get the filter month
$filter_month = $_GET['month'] ?? date('m');

// Get the filter year
$filter_year = $_GET['year'] ?? date('Y');

// Get the first day of the month for the filter
$filter_date = $filter_year . '-' . $filter_month . '-01';

// Get the last day of the month for the filter
$last_day = date('t', strtotime($filter_date));
$filter_end_date = $filter_year . '-' . $filter_month . '-' . $last_day;

// Query to get the total of declared amounts for the filtered month
$sql_total_declared = "SELECT SUM(declared_amount) as total_declared FROM recettes WHERE date >= '$filter_date' AND date <= '$filter_end_date'";

// Query to get the total of undeclared amounts for the filtered month
$sql_total_undeclared = "SELECT SUM(undeclared_amount) as total_undeclared FROM recettes WHERE date >= '$filter_date' AND date <= '$filter_end_date'";

// Query to get the total of undeclared expenses for the filtered month
$sql_total_expenses = "SELECT SUM(undeclared_expenses) as total_expenses FROM recettes WHERE date >= '$filter_date' AND date <= '$filter_end_date'";

// Query to get the total of charges for the filtered month
$sql_total_charges = "SELECT SUM(electricite + eau + loyer + gasoil + abonnements + comptable + marchandises + URSSAF + salaires + autres) as total_charges FROM charges WHERE date >= '$filter_date' AND date <= '$filter_end_date'";

// Query to get the total of invoices for the filtered month
$sql_total_invoices = "SELECT SUM(invoice_amount) as total_invoices FROM degrenne_invoice WHERE invoice_date >= '$filter_date' AND invoice_date <= '$filter_end_date'";

// Execute the queries and fetch the results
$result_total_declared = mysqli_query($conn, $sql_total_declared);
$total_declared = mysqli_fetch_assoc($result_total_declared)['total_declared'];

$result_total_undeclared = mysqli_query($conn, $sql_total_undeclared);
$total_undeclared = mysqli_fetch_assoc($result_total_undeclared)['total_undeclared'];

$result_total_expenses = mysqli_query($conn, $sql_total_expenses);
$total_expenses = mysqli_fetch_assoc($result_total_expenses)['total_expenses'];

$result_total_charges = mysqli_query($conn, $sql_total_charges);
$total_charges = mysqli_fetch_assoc($result_total_charges)['total_charges'];

$result_total_invoices = mysqli_query($conn, $sql_total_invoices);
$total_invoices = mysqli_fetch_assoc($result_total_invoices)['total_invoices'];

$months = array(
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
$profit = [];
foreach ($months as $key => $month) {
  // $month = 
  // Get the filter month
  $_filter_month = $key;
  // Get the filter year
  $_filter_year = $_GET['year'] ?? date('Y');
  // Get the first day of the month for the filter
  $_filter_date = $_filter_year . '-' . $_filter_month . '-01';
  // Get the last day of the month for the filter
  $_last_day = date('t', strtotime($_filter_date));
  $_filter_end_date = $_filter_year . '-' . $_filter_month . '-' . $_last_day;

  // Query to get the total of declared amounts for the filtered month
  $_sql_total_declared = "SELECT SUM(declared_amount) as total_declared FROM recettes WHERE date >= '$_filter_date' AND date <= '$_filter_end_date'";

  // Query to get the total of undeclared amounts for the filtered month
  $_sql_total_undeclared = "SELECT SUM(undeclared_amount) as total_undeclared FROM recettes WHERE date >= '$_filter_date' AND date <= '$_filter_end_date'";

  // Query to get the total of undeclared expenses for the filtered month
  $_sql_total_expenses = "SELECT SUM(undeclared_expenses) as total_expenses FROM recettes WHERE date >= '$_filter_date' AND date <= '$_filter_end_date'";

  // Query to get the total of charges for the filtered month
  $_sql_total_charges = "SELECT SUM(electricite + eau + loyer + gasoil + abonnements + comptable + marchandises + URSSAF + salaires + autres) as total_charges FROM charges WHERE date >= '$_filter_date' AND date <= '$_filter_end_date'";

  // Query to get the total of invoices for the filtered month
  $_sql_total_invoices = "SELECT SUM(invoice_amount) as total_invoices FROM degrenne_invoice WHERE invoice_date >= '$_filter_date' AND invoice_date <= '$_filter_end_date'";

  // Execute the queries and fetch the results
  $_result_total_declared = mysqli_query($conn, $_sql_total_declared);
  $_total_declared = mysqli_fetch_assoc($_result_total_declared)['total_declared'];

  $_result_total_undeclared = mysqli_query($conn, $_sql_total_undeclared);
  $_total_undeclared = mysqli_fetch_assoc($_result_total_undeclared)['total_undeclared'];

  $_result_total_expenses = mysqli_query($conn, $_sql_total_expenses);
  $_total_expenses = mysqli_fetch_assoc($_result_total_expenses)['total_expenses'];

  $_result_total_charges = mysqli_query($conn, $_sql_total_charges);
  $_total_charges = mysqli_fetch_assoc($_result_total_charges)['total_charges'];

  $_result_total_invoices = mysqli_query($conn, $_sql_total_invoices);
  $_total_invoices = mysqli_fetch_assoc($_result_total_invoices)['total_invoices'];
  $data = (float) number_format(($_total_declared + $_total_undeclared ) - ($_total_expenses + $_total_charges + $_total_invoices), 2, '.', '');
  $profit[] = $data < 0 ? 0 : $data;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Financial Report</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      font-size: 36px;
      margin: 20px 0;
      text-align: center;
    }

    form {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      margin: 20px 0;
    }

    form label {
      margin-right: 10px;
    }

    form input[type="number"] {
      padding: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-right: 10px;
      width: 100px;
    }

    form button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    form button:hover {
      background-color: #3e8e41;
    }

    hr {
      border: none;
      border-top: 1px solid #ccc;
      margin: 20px 0;
    }

    h2 {
      font-size: 24px;
      margin: 20px 0;
      text-align: center;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
    }

    table th {
      background-color: #4CAF50;
      color: white;
      font-weight: normal;
      padding: 10px;
      text-align: left;
    }

    table td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: right;
    }

    table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    table tr:hover {
      background-color: #f5f5f5;
    }

    .chart-container {
      position: relative;
      margin: auto;
      height: 250px;
      width: 90%;
    }

    .box1 {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .box1__item {
      width: 100%;
      background-color: #f2f2f2;
      max-width: 320px;
      margin-bottom: 20px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border-radius: 20px;
      display: flex;
      align-items: center;

      .box1__icon-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        background-color: blue;
        border-radius: 20px;
        margin-right: 20px;
      }

    }

    .box1__item i {
      font-size: 40px;
      margin-right: 20px;
      align-items: center;
    }

    .box1__item h3 {
      font-size: 18px;
      font-weight: 400;
      margin-bottom: 10px;

    }

    .box1__item p {
      font-size: 24px;
      font-weight: 700;
      margin: 0;
    }

    .box1__item h2,
    .box1__item h4 {
      margin: 0;
    }

    .box1__item i {
      margin-right: 10px;
    }

    @media (max-width: 768px) {
      .box1__item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .box1__item i {
        margin-bottom: 10px;
      }

      .box1__item h2 {
        font-size: 24px;
        color: blue;
      }

      .box1__item h4 {
        font-size: 18px;
      }
    }

    @media screen and (min-width: 768px) {
      .box1 {
        flex-wrap: nowrap;
      }

      .box1__item {
        width: calc(33.33% - 20px);
        margin-right: 20px;
        margin-bottom: 0;
      }

      .box1__item:last-child {
        margin-right: 0;
      }
    }

    @media screen and (min-width: 768px) {
      .chart-container {
        width: 500px;
      }
    }

    .table2-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .table2-box {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      background-color: white;
      box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.8);
      margin-bottom: 20px;
      padding: 20px;
      width: calc(33.33% - 20px);
    }

    .text2-box {
      text-align: center;
    }

    .label2 {
      font-size: 14px;
      margin-bottom: 5px;
    }

    .value2 {
      font-size: 24px;
      font-weight: bold;
    }

    .icon2 {
      font-size: 48px;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .table-box {
        width: 100%;
      }
    }
  </style>
  <meta charset="UTF-8">
  <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
  <link rel="stylesheet" href="style.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Add this script tag to the head of the page -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-bK/hJnNVyUGs2WmMM3zPzTJqrhTj1eAMxPOgLl0cX/DGy0iypkNTWQ8bfnv3A6TGCvlzT1iD0x8HvhtX2QhOfA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
      <div class="logo_name">Cocci Market</div>
      <i class='bx bx-menu' id="btn"></i>
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
          <i class='bx bx-money'></i>
          <span class="links_name">Charges</span>
        </a>
        <span class="tooltip">Charges</span>
      </li>

      <li>
        <a href="invoice.php">
          <i class='bx bx-file'></i>
          <span class="links_name">Factures</span>
        </a>
        <span class="tooltip">Factures</span>
      </li>
      <li>
        <a href="users.php">
          <i class='bx bx-user'></i>
          <span class="links_name">Utilisateurs</span>
        </a>
        <span class="tooltip">Utilisateurs</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
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
        <i class='bx bx-log-out' id="log_out" onclick="logout()"></i>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <div class="text">
      <h1>Rapport Financier</h1>
    </div>
    <div class="container">
      <form method="post">
        <label for="date_filter" style="font-size: 1.2em;">Filtrer par date :</label>
        <div class="form-row">

          <div class="col-md-3 mb-3">
            <select class="form-control" name="month" id="filter-month">
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
                echo '<option value="' . $i . '"';
                if (isset($_GET['month']) && $_GET['month'] == $i) {
                  echo ' selected="selected"';
                } else if (!isset($_GET['month']) && $i == $currentMonth) {
                  echo ' selected="selected"';
                }
                echo '>' . $monthNames[$i] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <select class="form-control" name="year" id="filter-year">
              <?php
              $currentYear = date("Y");
              for ($i = $currentYear; $i >= 2013; $i--) {
                echo '<option value="' . $i . '"';
                if (isset($_GET['year']) && $_GET['year'] == $i) {
                  echo ' selected="selected"';
                } else if (!isset($_GET['year']) && $i == $currentYear) {
                  echo ' selected="selected"';
                }
                echo '>' . $i . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-md-2 mb-3">
            <button type="button" onclick="onSubmitForm()" class="btn btn-primary form-control" style="width: 200px;">Filtrer</button>
          </div>
        </div>
      </form>




      <hr>
      <h4 style="text-align: center;">Résumé financier pour
        <?php echo date('F Y', strtotime($filter_date)); ?>
      </h4><br>
      <div class="box1" style="margin-bottom: 50px;">
        <div class="box1__item">
          <div class="box1__icon-container">
            <i class="fas fa-coins fa-3x" style="color: #428bca;"></i>

          </div>
          <div>
            <h3><b>Montant déclaré</b></h3>
            <h3>
              <?php echo number_format($total_declared, 2) . ' €'; ?>
            </h3>
          </div>
        </div>
        <div class="box1__item">
          <i class="fas fa-coins fa-3x" style="color: #428bca;"></i>



          <div>
            <h3><b>Montant non déclaré</b></h3>
            <h3>
              <?php echo number_format($total_undeclared, 2) . ' €'; ?>
            </h3>
          </div>
        </div>
        <div class="box1__item">
          <i class="fas fa-chart-line fa-3x" style="color:#428bca"></i>

          <div>
            <h3><b>Dépenses non déclarées</b></h3>
            <h3>
              <?php echo number_format($total_expenses, 2) . ' €'; ?>
            </h3>
          </div>
        </div>
      </div>


      <div class="box1">
        <div class="box1__item">
          <i class="fas fa-receipt fa-3x" style="color:#428bca"></i>

          <div>
            <h3><b>Total charges</b></h3>
            <h3>
              <?php echo number_format($total_charges + $total_invoices, 2) . ' €'; ?>
            </h3>
          </div>
        </div>
        <div class="box1__item">
          <i class="fas fa-chart-line fa-3x" style="color:#428bca"></i>
          <div>
            <h3><b>Profit</b></h3>
            <h3>
              <?php echo number_format(($total_declared + $total_undeclared) - ($total_expenses + $total_charges + $total_invoices), 2) . ' €'; ?>
            </h3>
          </div>
        </div>
        <div class="box1__item">
          <i class="fas fa-percent fa-3x" style="color:#428bca"></i>
          <div>
            <h3><b>ROI</b></h3>
            <h3>
              <?php echo $total_declared ? number_format((($total_declared + $total_undeclared ) - ($_total_expenses + $total_charges + $total_invoices)) / ($total_expenses + $total_charges + $total_invoices) * 100, 2) . '%' : 'N/A'; ?>
            </h3>
          </div>
        </div>
      </div>
      <br>
      <div style="text-align: center;">
      </div>
      <canvas id="profit" style="width:75%"></canvas>
      <script>
        function logout() {
          // Send an AJAX request to logout.php to destroy the session
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'logout.php', true);
          xhr.send();
          // Redirect to the login page
          window.location.href = "login.php";
        }
      </script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

      <script>
        var xValues = [
          'Janvier',
          'Février',
          'Mars',
          'Avril',
          'Mai',
          'Juin',
          'Juillet',
          'Août',
          'Septembre',
          'Octobre',
          'Novembre',
          'Décembre'
        ];
        // var barColors = ["red", "green","blue","orange","brown"];
        var myoption = {
          tooltips: {
            enabled: true
          },
          hover: {
            animationDuration: 2
          },
          animation: {
            duration: 1,
            onComplete: function () {
              var chartInstance = this.chart,
                ctx = chartInstance.ctx;
              ctx.textAlign = 'center';
              ctx.fillStyle = "rgba(0, 0, 0, 2)";
              ctx.textBaseline = 'bottom';

              // Loop through each data in the datasets

              this.data.datasets.forEach(function (dataset, i) {
                var meta = chartInstance.controller.getDatasetMeta(i);
                meta.data.forEach(function (bar, index) {
                  var data = dataset.data[index];
                  ctx.fillText(data, bar._model.x, bar._model.y - 5);

                });
              });
            }
          }
        };
        new Chart("profit", {
          type: "bar",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: ['red', 'blue', 'green', 'orange', 'darkgreen', 'skyblue', 'aqua', 'blueviolet', 'yellowgreen', 'violet', 'turquoise', 'seagreen'],
              data: JSON.parse("<?php echo json_encode($profit); ?>"),
            }]
          },
          options: {
            tooltips: {
              enabled: true
            },
            hover: {
              animationDuration: 1
            },
            animation: {
              duration: 1,
              onComplete: function () {
                var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
                ctx.textAlign = 'center';
                ctx.font = "bold 18px 'Helvetica Neue', Helvetica, Arial, sans-serif";
                ctx.fillStyle = "rgba(0, 0, 0, 1)";
                ctx.textBaseline = 'bottom';

                // Loop through each data in the datasets

                this.data.datasets.forEach(function (dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function (bar, index) {
                    var data = dataset.data[index];
                    ctx.fillText(data+"€", bar._model.x, bar._model.y - 5);
                  });
                });
              }
            },
            legend: { display: false },
            title: {
              display: true,
              text: "Année : <?php echo date('Y', strtotime($filter_date)); ?>",
              fontSize: 18,
              fontColor: 'red'
            },
            plugins: {
              datalabels: {
                color: '#0000FF',
                anchor: 'end',
                align: 'top',
                font: {
                  size: 18,
                  weight: 'bold'
                },
                formatter: function (value, context) {
                  return value.toFixed(2) + "€";
                }
              }
            },

            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  fontSize: 18,
                  fontColor: "black",
                  callback: function (value, index, values) {
                    return value.toFixed(2) + "€";
                  }
                }
              }],
              xAxes: [{
                ticks: {
                  fontSize: 18,
                  fontColor: "blue",
                }
              }]
            }
          }
        });

        const data = {
          labels: [
            "Montant total déclaré",
            "Montant total non déclaré",
            "Dépenses non déclarées"
          ],
          datasets: [
            {
              data: [<?php echo $total_declared; ?>, <?php echo $total_undeclared; ?>, <?php echo $total_expenses; ?>],
              backgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
              ],
              hoverBackgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
              ]
            }]
        };

        const options = {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: 'right',
            labels: {
              fontSize: 10,
              fontColor: '#333'
            }
          }
        };

        const ctx = document.getElementById("myChart").getContext("2d");
        const myPieChart = new Chart(ctx, {
          type: 'pie',
          data: data,
          options: options
        });
      </script>
      <!---- end chart table1 -->


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

    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function(optional)
    });

    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");//replacing the iocns class
      }
    }
function onSubmitForm() {
    var mainText = "index.php";
    var year = document.getElementById('filter-year').value;
    var month = document.getElementById('filter-month').value;
    window.location.href = mainText+'?month='+month+"&year="+year;
}
  </script>

</body>

</html>