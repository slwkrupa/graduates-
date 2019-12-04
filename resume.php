<!doctype html>
<html>
<head>
    <title>Resume</title>

    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="resume.css">
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
<main>
<!--osoby uczące się po zakończeniu szkoły-->
<div class="container">
    <div class="textof">People who gone to the university after school</div>
    <table>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT first_name, last_name FROM users WHERE id_university IS NOT NULL AND id_company IS NULL AND user_type_id='3'"; 
            $results=mysqli_query($conn, $query);
            $num = mysqli_num_rows($results);
            echo "<div class='textof'>(quantity: ".$num.")</div>";
            $number = 1;

            while($wiersz = mysqli_fetch_row($results)){
                echo "<tr>";
                echo "<td>".$number."</td><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td>";
                echo "</tr>";
                $number++;
            }
            
            mysqli_close($conn);
        ?>
    </table> 
<!--osoby pracujące po zakończeniu szkoły-->
    <div class="textof">People who gone to the job after school</div>
    <table>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT first_name, last_name FROM users WHERE id_company IS NOT NULL AND id_university IS NULL AND user_type_id='3'"; 
            $results=mysqli_query($conn, $query);
            $num = mysqli_num_rows($results);
            echo "<div class='textof'>(quantity: ".$num.")</div>";
            $number = 1;

            while($wiersz = mysqli_fetch_row($results)){
                echo "<tr>";
                echo "<td>".$number."</td><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td>";
                echo "</tr>";
                $number++;
            }
            
            mysqli_close($conn);
        ?>
    </table>
<!--osoby zarówno pracujące jak i uczące się po zakończeniu szkoły-->
    <div class="textof">People who gone to the job and university after school</div>
    <table>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT first_name, last_name FROM users WHERE id_company IS NOT NULL AND id_university IS NOT NULL AND user_type_id='3'"; 
            $results=mysqli_query($conn, $query);
            $num = mysqli_num_rows($results);
            echo "<div class='textof'>(quantity: ".$num.")</div>";
            $number = 1;

            while($wiersz = mysqli_fetch_row($results)){
                echo "<tr>";
                echo "<td>".$number."</td><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td>";
                echo "</tr>";
                $number++;
            }
            
            mysqli_close($conn);
        ?>
    </table>

<!--osoby pracujące w kraju-->
    <div class="textof">People who works at homeland</div>
    <table>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT first_name, last_name FROM users WHERE id_company IS NOT NULL AND id_university IS NULL AND country='35' AND user_type_id='3'"; 
            $results=mysqli_query($conn, $query);
            $num = mysqli_num_rows($results);
            echo "<div class='textof'>(quantity: ".$num.")</div>";
            $number = 1;

            while($wiersz = mysqli_fetch_row($results)){
                echo "<tr>";
                echo "<td>".$number."</td><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td>";
                echo "</tr>";
                $number++;
            }
            
            mysqli_close($conn);
        ?>
    </table>

<!--osoby uczące się w kraju-->
<div class="textof">People who study at homeland</div>
    <table>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT first_name, last_name FROM users WHERE id_university IS NOT NULL AND id_company IS NULL AND country='35' AND user_type_id='3'"; 
            $results=mysqli_query($conn, $query);
            $num = mysqli_num_rows($results);
            echo "<div class='textof'>(quantity: ".$num.")</div>";
            $number = 1;

            while($wiersz = mysqli_fetch_row($results)){
                echo "<tr>";
                echo "<td>".$number."</td><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td>";
                echo "</tr>";
                $number++;
            }
            
            mysqli_close($conn);
        ?>
    </table>

<!--osoby pracujące poza krajem-->
    <div class="textof">People who works not at homeland</div>
    <table>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT first_name, last_name FROM users WHERE id_company IS NOT NULL AND id_university IS NULL AND country!='35' AND user_type_id='3'"; 
            $results=mysqli_query($conn, $query);
            $num = mysqli_num_rows($results);
            echo "<div class='textof'>(quantity: ".$num.")</div>";
            $number = 1;

            while($wiersz = mysqli_fetch_row($results)){
                echo "<tr>";
                echo "<td>".$number."</td><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td>";
                echo "</tr>";
                $number++;
            }
            
            mysqli_close($conn);
        ?>
    </table>

<!--osoby uczące się poza krajem-->
    <div class="textof">People who study not at homeland</div>
    <table>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT first_name, last_name FROM users WHERE id_university IS NOT NULL AND id_company IS NULL AND country!='35' AND user_type_id='3'"; 
            $results=mysqli_query($conn, $query);
            $num = mysqli_num_rows($results);
            echo "<div class='textof'>(quantity: ".$num.")</div>";
            $number = 1;

            while($wiersz = mysqli_fetch_row($results)){
                echo "<tr>";
                echo "<td>".$number."</td><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td>";
                echo "</tr>";
                $number++;
            }
            
            mysqli_close($conn);
        ?>
    </table>

<!--osoby uczące się i pracujace poza krajem-->
<div class="textof">People who study and work not at homeland</div>
    <table>
        <?php
            $conn=mysqli_connect("localhost","root");
            $baza=mysqli_select_db($conn, "graduates");
            $query="SELECT first_name, last_name FROM users WHERE id_university IS NOT NULL AND id_company IS NOT NULL AND country!='35' AND user_type_id='3'"; 
            $results=mysqli_query($conn, $query);
            $num = mysqli_num_rows($results);
            echo "<div class='textof'>(quantity: ".$num.")</div>";
            $number = 1;

            while($wiersz = mysqli_fetch_row($results)){
                echo "<tr>";
                echo "<td>".$number."</td><td>".$wiersz[0]."</td><td>".$wiersz[1]."</td>";
                echo "</tr>";
                $number++;
            }
            
            mysqli_close($conn);
        ?>
    </table>
</div>
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