<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>signIn</title>
     <link rel="stylesheet" href="bts/css/bootstrap.css">
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
  width: 50%;
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
   
   
       <?php
error_reporting(0);
session_start();
if($_SESSION['id']=="admin"){
$link= mysqli_connect("localhost","root","","gestio");

$r= mysqli_query($link,"select * from pro");

$name= mysqli_real_escape_string($link ,$_POST['name']);
$qts = mysqli_real_escape_string($link ,$_POST['qts']);
$price= mysqli_real_escape_string($link ,$_POST['price']);
$cb= mysqli_real_escape_string($link ,$_POST['cb']);


//buttons
$sqls ="";
if($_POST['btnadd']){
    $sqls = "INSERT INTO pro 
         (CB,name,stock,price) VALUES ('$cb', '$name','$qts','$price') ";

    mysqli_query($link,$sqls);
    header("location: product.php");
}

if($_POST['btnedt']){
    $sqls = "update pro set price='$price',name='$name',stock='$qts' where CB=$cb";
    mysqli_query($link,$sqls);
    header("location: product.php");
}

if($_POST['btndel']){
    $sqls = "delete from pro where CB=$cb";
    mysqli_query($link,$sqls);
    header("location: product.php");
}
}
?>
 
      
         <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Admin Control Panel</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
               
            <li class="nav-item log">
                    <a href="vente.php" class="nav-link">Vente</a>
                </li>
                
                <li class="nav-item log">
                    <a href="index.php?logout=1" class="nav-link">LogOut</a>
                </li>
                
            </ul>
        </div>

    </nav>
         
        
<form method="post" class="form-group">
    <div class="MyForm">
    <label>Nom</label><br>
        <input type="text" id="name" name="name" class="form-control">
    <label>Quantité</label>
        <input type="text" id="qts" name="qts" class="form-control">
    <label>Prix</label>    <br>
        <input type="text" id="prix" name="price" class="form-control">
        <label>CodeBar</label>    <br>
        <input type="text" id="codebar" name="cb" class="form-control" onmouseover="this.focus();">
        <br>
   <br>
        
        <input type="submit" name="btnadd" value="Add" class="btn btn-success"/>
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
        </tr>
        <?php 
        $i=1;
        while ($row = mysqli_fetch_array($r))
        {
            
            echo "<tr>";
            echo '<th scope="row">' . $i . "</th>";
            echo '<td>' . $row["CB"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["stock"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
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
            
            document.getElementById("name").value = this.cells[2].innerHTML;
         document.getElementById("qts").value = this.cells[3].innerHTML;
          
         
         document.getElementById("prix").value = this.cells[4].innerHTML; 
            
        document.getElementById("codebar").value = this.cells[1].innerHTML;     
         
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