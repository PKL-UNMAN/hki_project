<?php
// Sample data array, replace this with your actual data or fetch data from a database
$data = array(
    array('Name 1', 'Value 1', 'Other 1'),
    array('Name 2', 'Value 2', 'Other 2'),
    array('Name 3', 'Value 3', 'Other 3'),
    // Add more rows as needed
);

// Function to transpose the rows to columns
function transposeArray($array) {
    $transposedArray = array();
    foreach ($array as $rowIndex => $row) {
        foreach ($row as $columnIndex => $value) {
            $transposedArray[$columnIndex][$rowIndex] = $value;
        }
    }
    return $transposedArray;
}

// Transpose the data array
$transposedData = transposeArray($data);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Transposed Data</title>
</head>
<body>
    <table>
        <?php
        // Loop through the transposed data and display it as columns
        foreach ($transposedData as $column) {
            echo '<tr>';
            foreach ($column as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>

