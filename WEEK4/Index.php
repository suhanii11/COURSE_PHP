 <?php
$numbers = array(5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9);
echo "<b>Elements of array:</b><br>";
foreach ($numbers as $num) {
    echo $num . " ";
}
echo "<br><br>";

$total = 0;
foreach ($numbers as $num) {
    $total += $num;
}
echo "Total of all elements: " . $total . "<br>";

$even_total = 0;
foreach ($numbers as $num) {
    if ($num % 2 == 0) {
        $even_total += $num;
    }
}
echo "Total of even elements: " . $even_total . "<br>";
$odd_total = 0;
foreach ($numbers as $num) {
    if ($num % 2 != 0) {
        $odd_total += $num;
    }
}
echo "Total of odd elements: " . $odd_total . "<br>";

$min = min($numbers);
$min_positions = array();
foreach ($numbers as $index => $val) {
    if ($val == $min) {
        $min_positions[] = $index;
    }
}
echo "Minimum element: " . $min . " (Positions: " . implode(", ", $min_positions) . ")<br>";
$max = max($numbers);
$max_positions = array();
foreach ($numbers as $index => $val) {
    if ($val == $max) {
        $max_positions[] = $index;
    }
}
echo "Maximum element: " . $max . " (Positions: " . implode(", ", $max_positions) . ")<br>";
?>