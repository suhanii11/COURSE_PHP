<?php
 
$students = array(
    "CA221" => array("Name" => "Mohamed Ahmed Ali", "Phone" => "0648440403", "Address" => "Laba Dhagax, Wardhiigley"),
    "CA223" => array("Name" => "Ahmed Abdi Jama", "Phone" => "0647223201", "Address" => "Taleex, Hodan"),
    "CA221_2" => array("Name" => "Amina Nur Adan", "Phone" => "0646990276", "Address" => "Macmacaanka, Dharkeynley")
);


echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr style='background-color: #ddd;'>";
echo "<th></th><th>Name</th><th>Phone</th><th>Address</th>";
echo "</tr>";

foreach ($students as $code => $info) {

    $display_code = ($code == "CA221_2") ? "CA221" : $code;
    
    echo "<tr>";
    echo "<td style='background-color: #ddd;'><b>" . $display_code . "</b></td>";
    echo "<td>" . $info["Name"] . "</td>";
    echo "<td>" . $info["Phone"] . "</td>";
    echo "<td>" . $info["Address"] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>