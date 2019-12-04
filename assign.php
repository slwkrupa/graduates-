<!doctype html>
<html>
<head>
    <title>Assign</title>

    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="assign.css">
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
<form method="POST" action="#" id="formula">

<div class="list">
Select a class
<!--Wybór klasy, do której chcemy przypisać osoby-->
<select id="claslist" name="claslist">
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT id_division, first_name, last_name, division_code, div_end_date FROM users INNER JOIN division ON division.id_professor=users.id_user WHERE user_type_id='2'";
            mysqli_query($conn, "SET NAMES utf8");
            $results=mysqli_query($conn, $query);

            while($wiersz = mysqli_fetch_row($results)){
                echo "<option value='$wiersz[0]'>".$wiersz[1]." ".$wiersz[2]." - CLASS ".$wiersz[3]." year ".$wiersz[4]."</option>";
            }

            mysqli_close($conn);
        ?>
    </select>
    <br/>
</div>
<script language="JavaScript" type="text/javascript" src="search.js"></script>
<!--Wyszukiwarka-->
    Search<br/>
    <input type="text" class="search-text" id="search-text" placeholder="Search...">   
    <div id="result"></div>

<table>
    <tr>
        <th>LP</th>
        <th>Name</th>
        <th>Last name</th>
        <th>Start Date</th>
        <th>End date</th>
        <th>Select graduate</th>
    </tr>

<!--Pobranie z bazy wyników i wypisanie ich w tabeli-->
<?php
    $conn=mysqli_connect("localhost","root");
    $baza=mysqli_select_db($conn, "graduates");
    mysqli_query($conn, "SET NAMES utf8");
    $query="SELECT id_user, first_name, last_name, start_date, end_date FROM users WHERE user_type_id='3'"; 
    $results=mysqli_query($conn, $query);

    //sprawdzenie liczby iwerszy w zbiorze wyników
    $resNumber=mysqli_num_rows($results);
    $licznik = 1;
    
    while($wiersz = mysqli_fetch_row($results)){
        echo "<tr>";
        echo "<td class='data-list'>".$licznik."</td><td>".$wiersz[1]."</td><td>".$wiersz[2]."</td><td>".$wiersz[3]."</td><td>".$wiersz[4]."</td>";
        echo "<td><input type='checkbox' name='ckb[]' value='$wiersz[0]'></td>";
        echo "</tr>";
        $licznik++;
    }
    mysqli_close($conn);
?>
</table>
<br/>

<input type="submit" value="Dodaj">
</form>

<?php
    $conn=mysqli_connect("localhost","root");
    $baza=mysqli_select_db($conn, "graduates");
    mysqli_query($conn, "SET NAMES utf8");
    if(isset($_POST['ckb'])){
        $tablica=$_POST['ckb'];
        $elNumber=count($tablica);
        $query2="UPDATE users SET user_id_division=".$_POST['claslist']." WHERE id_user IN ("; 
        for($i=0; $i < $elNumber; $i++){
            if($i < $elNumber - 1){
                $query2=$query2.$tablica[$i].",";
            }else{
                $query2=$query2.$tablica[$i].")";
            }
        }  
        $wynik2 = mysqli_query($conn, $query2);
    }
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




