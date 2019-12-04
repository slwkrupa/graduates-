<!doctype html>
<html>
<head>
    <title>Add Workplace</title>

    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="workplace.css">
</head>
<body>
<header>
    <h3>Data of graduated</h3>
    <div>
    <ul>
        <li><a href="main.php">Home</a></li>
        <li><a href="addUser_v.php">Add user</a></li>
        <li><a href="addDivision.php">Add division</a></li>
        <li><a href="assign.php">Assign user to division</a></li>
        <li><a href="addWorkplace.php">Add workplace</a></li>
        <li><a href="resume.php">Resume</a></li>
    </ul>
    </div>
</header>
<main class="box">
<div class="container">
<form method="POST" action="#" name="formwork">
    
    <!--Wybranie rodzaju instytucji - uczelnia bądź firma-->
    Select type of instistuion<br/>
    <select id="workplacelist" name="workplacelist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_dict, short_description FROM dict WHERE id_dictio_type='3'";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/>

    <!--Wybranie kraju instytucji-->
    Select country of institution<br/>
    <select id="countrylist" name="countrylist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_dict, description FROM dict WHERE id_dictio_type='2'";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/><br/>
  
    <!--Pole do wpisania nazwy instytucji-->
    <div class="txt">
        Name of institution<br/>
        <input type="text" name="nameofworkplace" size="25"><br/>
    </div>
</div> 

    <input type="submit" name="formwork" value="Dodaj">

</form>

<?php
    $conn=mysqli_connect("localhost","root");
    $baza=mysqli_select_db($conn, "graduates");
    if(isset($_POST['formwork'])){

        $namew = $_POST['nameofworkplace'];
        $typew = $_POST['workplacelist'];
        $countryw = $_POST['countrylist'];

        $query="INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES(null,'$namew','$typew','$countryw')";
    }
    $results=mysqli_query($conn, $query);
    mysqli_close($conn);
?>

</main>
<footer>
    <div class="info">
        <ul>
            <li>About us</li>
            <li>Where we are?</li>
            <li>Our best example</li>
        </ul>
    </div>
    <div class="line"></div>
    <div class="text">
        Curabitur sit amet blandit libero, ut vehicula erat. Vestibulum eget fermentum eros. Nulla sit amet rutrum nisi. Praesent vel nisl nec dolor sagittis auctor. Sed sit amet mauris enim. 
        Nulla gravida commodo tellus non accumsan. Ut non enim sed nibh pharetra vulputate.
    </div>
</footer>
</body>
</html>
