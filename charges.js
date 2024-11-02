$(document).ready(function() {
  // initialize the DataTable
  var table = $('#charges-table').DataTable({
    "order": [[ 0, "desc" ]], // order by year desc by default
    "columnDefs": [
      { "type": "numeric-comma", targets: [2,3,4,5,6,7,8,9,10,11] }, // use numeric comma sorting for amount columns
      { "targets": 'no-sort', orderable: false } // disable sorting for action buttons column
    ]
  });

  // add event listener for filter form submission
  $('#filter-form').on('submit', function(e) {
    e.preventDefault(); // prevent form submission
    var year = $('#filter-year').val(); // get selected year
    var month = $('#filter-month').val(); // get selected month
    table.columns(0).search(year + '-' + month).draw(); // apply filter and redraw table
  });

  // add event listener for reset button click
  $('#reset-btn').on('click', function(e) {
    e.preventDefault(); // prevent default click behavior
    $('#filter-form')[0].reset(); // reset filter form
    table.columns(0).search('').draw(); // clear year-month filter and redraw table
  });
});
