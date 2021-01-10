 <?php
error_reporting(0);
session_start();
if($_SESSION['id']=="admin"){
$link= mysqli_connect("localhost","root","","gestio");
$r= mysqli_query($link,"select * from cart");

$c_qts= mysqli_real_escape_string($link ,$_POST['c_qts']);
$c_cb = mysqli_real_escape_string($link ,$_POST['c_cba']);
    
$info =mysqli_query($link,"select * from pro where CB='$c_cb'");
    $rzlt=mysqli_fetch_array($info);
     if($rzlt["CB"]){
        $aff= 1;
    }
   
   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vente</title>
     <link rel="stylesheet" href="bts/css/bootstrap.css">
     <style>
         .container{
             
             margin-top: 20px;
         }
         input{
             min-width: 300px;
             width: 100%;
             margin-top: 15px;
         }
    </style>
      <style>
            .emailh{
                text-align: center;
                border: 1px solid grey;
                border-radius: 10px;
                margin-top: 20px;
            }
            textarea{
                height: 120px;
            }
            form{
                padding-bottom: 20px;
            }
         .login{
             margin-top: 10px;
         }
        </style>
         <style>


#myInput,#myInput2 {
  margin-top: 15px;
}

#info {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#info th, #info td {
  text-align: left;
  padding: 12px;
}

#info tr {
  border-bottom: 1px solid #ddd;
}

#info tr.header, #info tr:hover {
  background-color: #f1f1f1;
            } 
.MyForm{
    margin: auto;
  width: 60%;
  border: 3px solid #ddd;
  padding: 10px;
            }
            body {
    text-align: center;
}
form {
    display: inline-block;
   
}
.log{
    float: right;
            }
.navbar{
    margin-bottom: 20px;
            }
           
        </style>
</head>
<body>
      
       <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Admin Control Panel</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
               
            <li class="nav-item log">
                    <a href="product.php" class="nav-link">AdminP</a>
                </li>
                
                <li class="nav-item log">
                    <a href="index.php?logout=1" class="nav-link">LogOut</a>
                </li>
                
            </ul>
        </div>

    </nav>
  
    
    <?php
    $not='<div class="alert alert-info">Please Enter Your Information</div>';
    
     if($rzlt["CB"]){
         $c_name=$rzlt["name"];
         $u_price=$rzlt["price"];
         $mon=$u_price*$c_qts;
         $sqls = "INSERT INTO cart 
         (c_cb,c_name,c_qts,u_price,montant) VALUES ('$c_cb', '$c_name','$c_qts','$u_price','$mon') ";
         mysqli_query($link,$sqls);
    
         
        $not='<div class="alert alert-success">added seccefully</div>';
          header("location: vente.php?seccess=1");
    }
    
    if($_GET["seccess"]==1){
        $not='<div class="alert alert-success">added seccefully</div>';
    }
    
    if($_POST['submit']){
      if(!$rzlt["CB"]){
        $not='<div class="alert alert-danger">The product doesnt exict</div>';}
    }  
    
   
     echo $not;
    
    ?>
    <div class="container d-flex justify-content-center align-items-center mx-auto" style="width: 300px">
    <div class="row">
    
    <div class="col-md-10 col-lg-10">
        <h1 style="float: left">Vendu Un </h1>
        <h1 style="float: right,margin-left: 0"> Produit</h1>
        <form action="" method="post" class="form-group"><input type="text" name="c_qts" placeholder="La Quantite" class="form-control">
        
        <input type="text" name="c_cba" placeholder="Le CodeBar" class="form-control">
        
        <input type="submit" name="submit" placeholder="La Quantite" class="btn btn-success" value="Ajouter">
        
        <a href="print.php" class="btn btn-primary" style="min-width: 300px;
             width: 100%;
             margin-top: 15px;">Impimer</a>
        
        </form>
       
    </div>    
        
    </div>    
          
    </div>
    <hr><br><br>
    
    <?php
    // Edite Button
    if($_POST['btnedt']){
        $e_qts = mysqli_real_escape_string($link ,$_POST['qts']);
        
       $e_cb = mysqli_real_escape_string($link ,$_POST['cb']);
        
       $e_price = mysqli_real_escape_string($link ,$_POST['price']);
        
        
        $e_mon= $e_price * $e_qts;
    $sqls = "update cart set c_qts='$e_qts',montant='$e_mon' where c_cb=$e_cb";
    mysqli_query($link,$sqls);
    header("location: vente.php");
       
}
    //Delete Button
    if($_POST['btndel']){
        $h_cb = mysqli_real_escape_string($link ,$_POST['cb']);
    $sqls = "delete from cart where c_cb=$h_cb";
    mysqli_query($link,$sqls);
    header("location: vente.php");
}
    ?>
           
<form method="post" class="form-group">
    <div class="MyForm">
    
    <label>Quantité</label>
        <input type="text" id="qts" name="qts" class="form-control">
   
        
        <input type="hidden" id="codebar" name="cb" class="form-control">
        
        <input type="hidden" id="prix" name="price" class="form-control">
        <br>
   <br>
        
        <input type="submit" name="btnedt" value="Edit" class="btn btn-primary"/>
        <input type="submit" name="btndel" value="Delete" class="btn btn-danger"/>
        
    
    </div>
    <br><br>
    <lable><h5>La Recherche :</h5> </lable>
    <div>
        
    <input type="text" id="myInput" onkeyup="myFilter1()" placeholder="Rechercher Par le Nome" title="Type in a name" class="form-control">
    </div>
    
    <div>
    
    <input type="text" id="myInput2" onkeyup="myFilter()" placeholder="Rechercher Par le CodeBar" title="Type in a name" class="form-control">
    </div>
    
    <br><br>
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

</form>
       
  
    
  
  <script>
var tbl = document.getElementById('info');
    for(var i=1; i<tbl.rows.length;i++){
        tbl.rows[i].onclick=function(){
            
         document.getElementById("qts").value = this.cells[3].innerHTML;
          
         
            
        document.getElementById("codebar").value = this.cells[1].innerHTML;     
            
        document.getElementById("prix").value = this.cells[4].innerHTML;      
         
        }
    }

    
    function myFilter1() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("info");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
      
      
       function myFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("info");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
    
    
    
    
    
    
    
    
    
    
    
</body>
</html>