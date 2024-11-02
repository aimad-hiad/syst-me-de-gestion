<!DOCTYPE html>
<html>
<head>
	<title>Financial Statistics Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-DmEiXnkrHT5V7FVYYcN6PwSt5wOdN7NjqyiG3q6bXKsZi5MW5PJ7R5XQ6BkMkah" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/chart.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Financial Statistics Dashboard</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Dashboard</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	<div class="container-fluid">
		<h1 class="mt-5">Financial Statistics Dashboard</h1>
		<div class="row">
			<div class="col-md-6">
				<div class="card mt-4">
					<div class="card-header">Total Revenue</div>
					<div class="card-body">
						<canvas id="totalRevenueChart"></canvas>
					</div>
				</div>
						</div>
			<div class="col-md-6">
				<div class="card mt-4">
					<div class="card-header">Expenses by Category</div>
					<div class="card-body">
						<canvas id="expensesChart"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS scripts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
	<script>
		// Set up expenses chart
		var expensesData = {
			labels: <?php echo json_encode($expense_categories); ?>,
			datasets: [{
				data: <?php echo json_encode($expense_category_totals); ?>,
				backgroundColor: [
					'#FF6384',
					'#36A2EB',
					'#FFCE56',
					'#4BC0C0',
					'#9966FF',
					'#FF66CC'
				]
			}]
		};
		var expensesChart = new Chart(document.getElementById('expensesChart'), {
			type: 'pie',
			data: expensesData,
			options: {
				responsive: true,
				legend: {
					position: 'right'
				},
				title: {
					display: true,
					text: 'Expenses by Category'
				}
			}
		});
	</script>
</body>
</html>
