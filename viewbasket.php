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
    <title>View Basket and checkout</title>
</head>
    <h1>Basket contents</h1>
    <?php
        session_start();
        $howmany=count($_SESSION["lunchbasket"]);
        echo("You have ".$howmany." items in your basket<br>");
        include_once("connection.php");
        $total=0;
        foreach ($_SESSION["lunchbasket"] as $item){
            $fid=$item["foodid"];
            $stmt=$conn->prepare("SELECT * FROM tblfood WHERE FoodID=:fid");
            $stmt->bindParam(":fid",$fid);
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                print_r($row["Name"]." - Qty: ".$item["qty"]."total price".($row["Price"]*$item["qty"]));
                echo("<br>");
                $total+=($row["Price"]*$item["qty"]);
            }
        }
        echo("Total cost: ".$total);
    ?>
    <a href="checkout.php">Proceed to checkout</a>
<body>
    
</body>
</html>