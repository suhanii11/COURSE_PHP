<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <ph 
        <?php

$a = 20;
$b = 10;
$c = 30;

$greatest = $a;

if ($b > $greatest) {
    $greatest = $b;
}

if ($c > $greatest) {
    $greatest = $c;
}

$smallest = $a;

if ($b < $smallest) {
    $smallest = $b;
}

if ($c < $smallest) {
    $smallest = $c;
}

echo "Greatest number: " . $greatest . "<br>";
echo "Smallest number: " . $smallest;

?>
</body>
</html>