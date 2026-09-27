 <!DOCTYPE html>
<html>
<head>
    <title>document</title>
</head>

<body>

<h2>Multiplication Table</h2>

<table border="1">

<?php

for ($i = 1; $i <= 12; $i++) {

    echo "<tr>";

    for ($j = 1; $j <= 12; $j++) {

        echo "<td>";
        echo $i * $j;
        echo "</td>";
    }

    echo "</tr>";
}

?>

</table>

</body>
</html>