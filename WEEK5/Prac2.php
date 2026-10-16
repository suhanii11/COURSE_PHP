<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //creating function
    function sum(&$number) // & calamaadaan ku dhufasho ayey utaaganthy
    {
        // creating local variables
        $number = $number+10;

    }

    $x =5;
    sum($x);
    echo $x;
    ?>
</body>
</html>