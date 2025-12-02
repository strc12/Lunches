<?php
    session_start();
    print_r($_SESSION);
    include_once("connection.php");
    $datecheckedout=date_create()->format("Y-m-d H:i:s");
    print_r($datecheckedout);
    $status="ordered";
    $stmt=$conn->prepare("INSERT INTO tblorder 
    (OrderID, Status,UserID,Orderdate)
    VALUES
    (NULL,:status,:userid,:orderdate)
    ");
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":userid", $_SESSION["loggedinuser"]);
    $stmt->bindParam(":orderdate", $datecheckedout);
    
    $stmt->execute();
    $lastorderid=$conn->lastInsertId();
    print_r($lastorderid);
    
    foreach ($_SESSION["lunchbasket"] as $item){
        echo($item["foodid"]);
        
        $fid=$item["foodid"];
        $stmt=$conn->prepare("INSERT INTO tblbasket 
        (OrderID,Quantity, FoodID)
        VALUES
        (:orderid,:qty,:foodid)
        ");
        $stmt->bindParam(":orderid", $lastorderid);
        $stmt->bindParam(":qty", $item["qty"]);
        $stmt->bindParam(":foodid", $item["foodid"]);
        
        $stmt->execute();
        
        
    } 
?>