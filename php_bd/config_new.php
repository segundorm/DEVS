<?php

     $link = new mysqli('187.32.167.5', 'root', '', 'Pmn@2016');

    if (!$link) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error()); }

   $query = "INSIRA AQUI SUA SQL" or die("Error in the consult.." . mysqli_error($link));  
   $result = $link->query($query); 
   if ($result = $link->query($query))  var_dump(mysqli_fetch_array($result));   

    mysqli_close($link);


?>