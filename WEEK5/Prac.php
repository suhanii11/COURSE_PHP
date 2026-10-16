<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // creating function
  function sum ($x, $y)
  {
    // creating local variable
    $z = $x+$y;
    echo $z;
  }     // only variables should be passed by refrence 

    // calling function 
    sum(10,20); //two argument  -passing by values
    echo <"br">;
    // creating a variables
    $a =10;
    $b =  20;
    sum($a, $b); //passing by refrences
    ?>
</body>
</html>