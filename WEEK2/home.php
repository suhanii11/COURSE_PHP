<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $NUMBERS = array(2,"HAMDI",295.5,TRUE);

  //   CREATING AN array _numeric array
     //first way to create array
     $names = array();

     //second way to initial array
    $names[0] = "Hamdi";
    $names[1] = "Hamda";
    $names[2] = "CA233";
     echo $names[0] . "<br>";
      echo $names[1] . "<br>";
       echo $names[2] . "<br>";
    // dispalay array values using var  dump() fucntion
    var_dump($names)
      dispaly all the values usig pre tag
      echo "<pre>";
      print_r($names); /// data typeka ma sheego kan
      echo "</pre>";

    //  for loop to display array values
      for ($i=0; $i < count($names); $i++) {    
            echo $names[$i] . "<br>";
      }
     //   associative array

     $info = array(
    "name" => "Hamdi",
    "age" => 20,
    "course" => "CA233",
    "address" => "muqdisho",
    "status" => "single",
    "weight" => 70
);
echo "<pre>";
print_r($info);
echo "</pre>";
    ?>
</body>
</html>