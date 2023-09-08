<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the CSV data from the hidden input
    $csvData = json_decode(base64_decode($_POST['csv_data']), true);

    // Set the HTTP response headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="order_report.csv"');

    // Open a PHP output stream for writing CSV data
    $output = fopen('php://output', 'w');

    // Output the CSV headers
    fputcsv($output, array_keys($csvData[0]));

    // Output each row of data
    foreach ($csvData as $row) {

        fputcsv($output, $row);
    }

    // Close the output stream
    fclose($output);
    exit;
}
?>
