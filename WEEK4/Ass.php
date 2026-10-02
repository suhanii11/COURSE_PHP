<?php

$colors = array(
    "Light" => array("Red" => "Light Red", "Green" => "Light Green", "Blue" => "Light Blue"),
    "Normal" => array("Red" => "Normal Red", "Green" => "Normal Green", "Blue" => "Normal Blue"),
    "Dark" => array("Red" => "Dark Red", "Green" => "Dark Green", "Blue" => "Dark Blue")
);

echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr style='background-color: #ddd;'>";
echo "<th></th><th>Red</th><th>Green</th><th>Blue</th>";
echo "</tr>";

foreach ($colors as $row_name => $row_values) {
    echo "<tr>";
    echo "<td style='background-color: #ddd;'><b>" . $row_name . "</b></td>";
    foreach ($row_values as $col_name => $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>