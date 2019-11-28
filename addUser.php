<!doctype html>
<html>
<head>
    <title>Graduades</title>

    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<style>
    main div{
        display: inline-block;
    }
    .container{

    }
    .left{
        margin-left: 500px;
        text-align: right;
    }
    .right{
        text-align: left;
    }
    input[type="submit"]{
        margin-left: 500px;
        text-align: center;
    }
</style>
<body>
<header>
    <h3>Data of graduated</h3>
    <div>
    <ul>
        <li><a href="main.php">Home</a></li>
        <li><a href="addUser.php">Add user</a></li>
        <li><a href="addDivision.php">Add division</a></li>
        <li><a href="main.php">Database</a></li>
        <li><a href="main.php">Resume</a></li>
    </ul>
    </div>
</header>
<main>
<div class="container">
<div class="left">
    Kind of person you want to add <br/>
    Name <br/>
    Last name <br/>
    Pesel <br/>
    Email <br/>
    Start date <br/>
    End date <br/>
    Class <br/>
    Gender <br/>
    Country <br/>
    Company <br/>
    University <br/>
</div>
<div class="right">

<form method=POST action="#" name="form1">

    <select id="personlist" name="personlist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_dict, short_description FROM dict WHERE id_dictio_type='1'";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/>

    <input type="text" id="txtname" name="name"><br/>
    <input type="text" id="txtlname" name="lastname"><br/>
    <input type="text" id="txtlname" name="pesel"><br/>
    <input type="text" id="txtlname" name="email"><br/>
    <input type="date" value="yyyy-mm-dd" id="sdate" name="sdate"><br/>
    <input type="date" value="yyyy-mm-dd" id="edate" name="edate"><br/>


    <select id="classlist" name="classlist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_division, division_code FROM division";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }
            mysqli_close($conn);
        ?>
    </select>
    <br/>

    <select id="genderlist" name="genderlist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_dict, short_description FROM dict WHERE id_dictio_type='4'";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }
            mysqli_close($conn);
        ?>
    </select>
    <br/>


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
    <br/>

    <select id="complist" name="complist">
        <option value="null">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_workplace, name FROM workplace WHERE workplace_type='43'";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/>

    <select id="unlist" name="unlist">
        <option value="null"></option>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_workplace, name FROM workplace WHERE workplace_type='42'";
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

<input type="submit" name="form1" value="Dodaj"/>
</form>
<?php
        $conn=mysqli_connect("localhost","root");
        $baza=mysqli_select_db($conn, "graduates");
        if(isset($_POST['form1']))
    {
        $personll = $_POST['personlist'];
        $user_name = $_POST['name'];
        $user_last_name = $_POST['lastname'];
        $user_pesel = $_POST['pesel'];
        $user_email = $_POST['email'];
        $user_sdate = $_POST['sdate'];
        $user_edate = $_POST['edate'];
        $clasll = $_POST['classlist'];
        $genderll = $_POST['genderlist'];
        $countryll = $_POST['countrylist'];
        $companyll = $_POST['complist'];
        $universityll = $_POST['unlist'];

        $query="INSERT INTO users VALUES(null,'$user_email',null,'$user_name','$user_last_name','$user_pesel','$user_sdate','$user_edate','$clasll','$personll','$genderll','$countryll','$companyll','$universityll')";
        mysqli_query($conn, "SET NAMES utf8");
        $results=mysqli_query($conn, $query);
        
    }else{
        echo "Nie";
    }
        
    mysqli_close($conn);
?>
</main>
<footer>

</footer>
</body>
</html>




