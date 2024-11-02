// Get the filter form and add an event listener to submit
document.querySelector('#filter-form').addEventListener('submit', (event) => {
    // Prevent the form from submitting and refreshing the page
    event.preventDefault();

    // Get the filter values from the form
    const filterMonth = document.querySelector('#filter-month').value;
    const filterYear = document.querySelector('#filter-year').value;

    // Build the URL with the filter values
    const url = `index2.php?filter_month=${filterMonth}&filter_year=${filterYear}`;

    // Redirect to the new URL
    window.location.href = url;
});

// Add event listener to Add Invoice button
document.querySelector('#add-invoice-btn').addEventListener('click', () => {
    // Redirect to the Add Invoice page
    window.location.href = 'add-invoice.php';
});
