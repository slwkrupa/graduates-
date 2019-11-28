<?php
    $conn=mysqli_connect("localhost","root");

    $baza=mysqli_select_db($conn, "graduates");


    $query="INSERT INTO users VALUES(
    null, 
    '".$_POST['email']."',
    null,
    '".$_POST['name']."',
    '".$_POST['lastname']."',
    '".$_POST['pesel']."',
    '".$_POST['sdate']."',
    '".$_POST['edate']."',
    '".$_POST['classlist']."',
    '".$_POST['personlist']."',
    '".$_POST['rd']."',
    '".$_POST['countrylist']."',
    '".$_POST['complist']."',
    '".$_POST['unlist']."')"; 

    //polskie znaki
    mysqli_query($conn, "SET NAMES utf8");
    $results=mysqli_query($conn, $query);

    if($results){
        echo "dodano!";
    }

    mysqli_close($conn);
?>