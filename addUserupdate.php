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
        <li><a href="main.php">Add graduate</a></li>
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

<form method=POST action="#">

    <select id="personlist" name="personlist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $personl=mysqli_query("SELECT id_dict, short_description FROM dict WHERE id_dictio_type='1'");
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $personl);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }
            
        ?>
    </select>
    <br/>

    <input type="text" id="txtname" name="name"><br/>
    <input type="text" id="txtlname" name="lastname"><br/>
    <input type="text" id="txtlps" name="pesel"><br/>
    <input type="text" id="txtem" name="email"><br/>
    <input type="date" value="yyyy-mm-dd" id="sdate" name="sdate"><br/>
    <input type="date" value="yyyy-mm-dd" id="edate" name="edate"><br/>


    <select id="classlist" name="classlist">
        <?php
            $classl=mysql_query("SELECT id_division, division_code FROM division");
            $results1=mysqli_query($conn, $classl);

            while($wiersz = mysqli_fetch_row($results1)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }
        ?>
    </select>
    <br/>

    <select id="genderlist" name="genderlist">
        <?php
            $genderl=mysqli_query("SELECT id_dict, short_description FROM dict WHERE id_dictio_type='4'");
            mysqli_query($conn, "SET NAMES utf8");
            $results2=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results2)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }
        ?>
    </select>
    <br/>


    <select id="countrylist" name="countrylist">
        <?php
            $countryl=mysqli_query("SELECT id_dict, description FROM dict WHERE id_dictio_type='2'");
            mysqli_query($conn, "SET NAMES utf8");
            $results3=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results3)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }
        ?>
    </select>
    <br/>

    <select id="complist" name="complist">
        <option value="null">
        <?php
            $companyl=mysqli_query("SELECT id_workplace, name FROM workplace WHERE workplace_type='43'");
            mysqli_query($conn, "SET NAMES utf8");
            $results4=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results4)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }
        ?>
    </select>
    <br/>

    <select id="unlist" name="unlist">
        <option value="null"></option>
        <?php
            $universityl=mysqli_query("SELECT name FROM workplace WHERE workplace_type='42'");
            mysqli_query($conn, "SET NAMES utf8");
            $results5=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results5)){
                echo "<option>".$wiersz[0]."</option>";
            }
        ?>
    </select>
    <br/>
</div>
</div>
<br/><br/>

<input type="submit" name="form1" value="Dodaj"/>
</form>
<?php
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

        mysqli_query("INSERT INTO users VALUES(null,'$user_email',null,'$user_name','$user_last_name','$user_pesel','$user_sdate','$user_edate','$clasll','$personll','$genderll','$countryll','$companyll','$universityll')");
		
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




