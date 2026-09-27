<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

for ($num = 10; $num <= 50; $num++) {

    $count = 0;

    for ($i = 1; $i <= $num; $i++) {

        if ($num % $i == 0) {
            $count++;
        }
    }

    if ($count == 2) {
        echo $num . " ";
    }
}

?>
</body>
</html>