<?php
error_reporting(0);
session_start();
if($_SESSION['id']=="admin"){
$link= mysqli_connect("localhost","root","","gestio");
$r= mysqli_query($link,"select * from cart");}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vente</title>
     <link rel="stylesheet" href="bts/css/bootstrap.css">
    </head>
    <body>
        
        
     <table border="1" id="info" class="table table-sm">
    <tr class="header">
       <th scope="col">#</th>
        <th scope="col">CodeBar</th>
        <th scope="col">Nom</th>
        <th scope="col">Quantité</th>
        <th scope="col">Prix</th>
        <th scope="col">montant</th>
        </tr>
        <?php 
        $i=1;
        while ($row = mysqli_fetch_array($r))
        {
            
            echo "<tr>";
            echo '<th scope="row">' . $i . "</th>";
            echo '<td>' . $row["c_cb"] . "</td>";
            echo "<td>" . $row["c_name"] . "</td>";
            echo "<td>" . $row["c_qts"] . "</td>";
            echo "<td>" . $row["u_price"] . "</td>";
            echo "<td>" . $row["montant"] . "</td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
        
        
        
        
     <script>document.onload = window.print()</script>   
        
        
        
        
    </body>