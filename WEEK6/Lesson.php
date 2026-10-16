<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method = "post">
        <select name="District" id=""></select>
        <option value="hodan">hodan</option>
        <option value="karaan">karaan</option>
        <option value="kaxda">kaxda</option>
     <input type="submit" name="submit" value="Register">
 

     </form>
    <?php
    if(!empty($_post['District']))
        {
        foreach($_post[District]as $r)
            {
                echo $r;
            }
        }else
        {
            echo "please select District";
        }
       // phpinfo()

    ?>
</body>
</html>