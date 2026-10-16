<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Home.php" method ="post" enctype="multipart/form-data">
        <label for="">select gender</label><hr>
        <input type="file" name ="stdimage"><hr>
         <input type="submit" name="submit" value="Upload">
    </form>
    <?php
      if(!empty($_files['stdimage']['name'])) // true
        {
            echo "file name is:".$_files['stdimage']['name']."<hr>";
            echo "file size is:".$_files['stdimage']['size'] ."<hr>";
            echo "file type is:".$_files['stdimage']['type']."<hr>";
            echo "file temporary is:".$_files['stdimage']['tmp_name']."<hr>";
            //move
            $temp = $_files['stdimage']['tmp_name'];
            $destination = "c:\Users\PC\Downloads\hamdi.pdf".$_files['stdimage']['nmae'];

            if(move_uploaded_file($temp,$destination))
                {
                    echo "succed to upload";
                }
                else{
                echo "faild to upload";
                }
        }else{
            echo "please select file";
        }
    ?>
    
</body>
</html>