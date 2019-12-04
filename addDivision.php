<!doctype html>
<html>
<head>
    <title>Add Division</title>

    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="user.css">
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
<div class="left">
    Class professor <br/>
    Division code <br/>
    Start date <br/>
    End date <br/>
    Class specialization <br/>
</div>
<div class="right">

<form method=POST action="#" name="form2">

    <!--Wybór profesora z listy-->
    <select id="profclaslist" name="professorclasslist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_user, first_name, last_name FROM users WHERE user_type_id='2'";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]." ".$wiersz[2]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/>

    <!--Wybór kodu klasy z listy-->
    <select id="divclist" name="divcodelist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT division_code FROM division";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option>".$wiersz[0]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/>

    <!--Data rozpoczęcia pracy oddziału-->
    <input type="date" value="yyyy-mm-dd" id="sdate" name="sdate" required><br/>
    <!--Data zakończenia pracy oddziału-->
    <input type="date" value="yyyy-mm-dd" id="edate" name="edate"><br/>

    <!--Wybór specjalizacji-->
    <select id="speclist" name="speclist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_specialization, spec_name FROM specialization";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/>
    
</div>
</div>
<br/><br/>

<input type="submit" name="form2" value="Dodaj"/>
</form>
<?php
        $conn=mysqli_connect("localhost","root");
        $baza=mysqli_select_db($conn, "graduates");
        if(isset($_POST['form2']))
    {
        $prof = $_POST['professorclasslist'];
        $divcode = $_POST['divcodelist'];
        $class_sdate = $_POST['sdate'];
        $class_edate = $_POST['edate'];
        $spec = $_POST['speclist'];

        $query="INSERT INTO division(id_division, id_professor, division_code, div_start_date, div_end_date, div_id_specialization) VALUES(null,'$prof','$divcode','$class_sdate','$class_edate','$spec')";
        mysqli_query($conn, "SET NAMES utf8");
        
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




