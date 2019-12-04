<!doctype html>
<html>
<head>
    <title>Add User</title>

    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="user.css">
</head>
<style>
</style>
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
    Kind of person you want to add <br/>
    Name <br/>
    Last name <br/>
    Pesel <br/>
    Email <br/>
    Start date <br/>
    End date <br/>
    Gender <br/>
    Country <br/>
    Company <br/>
    University <br/>
</div>
<div class="right">

<form method=POST action="#" name="form1">

    <!--Wybranie z listy typu osoby-->
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

    <!--Imie-->
    <input type="text" id="txtname" name="name" required><br/>
    <!--Nazwisko-->
    <input type="text" id="txtlname" name="lastname" required><br/>
    <!--Pesel-->
    <input type="text" id="txtlname" name="pesel" required><br/>
    <!--Email-->
    <input type="text" id="txtlname" name="email" required><br/>
    <!--Data rozpoczęcia-->
    <input type="date" value="yyyy-mm-dd" id="sdate" name="sdate" required><br/>
    <!--Data zakończenia-->
    <input type="date" value="yyyy-mm-dd" id="edate" name="edate"><br/>

    <!--Płeć-->
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

    <!--Wybór kraju, gdzie obecnie osoba przebywa-->
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

    <!--Wybór pracy, w której obecnie osoba pracuje-->
    <select id="complist" name="complist">
        <option value="null">Brak</option>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_workplace, name FROM workplace WHERE workplace_type IN('49', '50')";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='".$wiersz[0]."'>".$wiersz[1]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/>

    <!--Wybór uczelni, na ktróej obecnie osoba się uczy-->
    <select id="unlist" name="unlist">
        <option value="null">Brak</option>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_workplace, name FROM workplace WHERE workplace_type='49'";
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
        $user_pesel = !empty($_POST['pesel']) ? $_POST['pesel'] : null;
        $user_email = !empty($_POST['email']) ? $_POST['email'] : null;
        $user_sdate = $_POST['sdate'];
        //$user_edate = !empty($_POST['edate']) ? $_POST['email'] : null;
		$user_edate = $_POST['edate'];
        $genderll = $_POST['genderlist'];
        $countryll = $_POST['countrylist'];
        $companyll = !empty($_POST['complist']) ? $_POST['complist'] : null;
        $universityll = !empty($_POST['unlist']) ? $_POST['unlist'] : null;

        //NULLIF - był problem z wartością w dacie zakończenia
        $query="INSERT INTO users VALUES(null, '$user_email' ,null,'$user_name','$user_last_name', $user_pesel ,'$user_sdate', NULLIF('$user_edate','') ,null,'$personll','$genderll','$countryll', $companyll , $universityll)";
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




