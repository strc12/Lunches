<?php
    session_start();
    #print_r($_SESSION);
    if (isset($_SESSION["loggedinuser"])){
        echo("Hello ".$_SESSION["firstname"]);
    }else{
        echo("not logged in");
    }
?>
<!DOCTYPE HTML>
<html>
<head>          
    <title>Packed lunch ordering system</title>
</head>

<body>
    <h1>Orders page</h1>
    Select category 
    show foods in that category 
     <?php
        include_once("connection.php");
        $stmt=$conn->prepare("SELECT * FROM tblfood ORDER BY Category, Name");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            //print_r($row);
            echo ('<form action="addtobasket.php" method="POST">');
            echo($row["Name"]." ".$row["Description"]." ".$row["Price"]);
            echo('<input type="hidden" name="foodid" value='.$row["FoodID"].'>');
            echo('Quantity:<input type="number" name="qty" min="1" max="5" value="1">');
            echo('<input type="submit" value="Add Food">');
            echo("<br></form>");
        }
    ?>

</body>
</html>