<?php
session_start();
if(!$_SESSION["login"]){
    session_destroy();
    header("location:login.html");
}
$con = mysqli_connect("localhost","root","","db");
$q = "select * from employees";
$r = $con->query($q);
$total = $r->num_rows;

$page_size = 5;
$total_pages = ceil($total/$page_size);
if(isset($_GET["p"])){
    $p = $_GET["p"];
    if($p <=$total_pages){}else{ $p = 1;}
}else{
    $p = 1;
}

$start = ($p - 1) * $page_size;
$r = $con->query("select * from employees limit $start, $page_size")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>
<body>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
    </tr>
<?php while($row = $r->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $row["id"] ?></td>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $row["email"] ?></td>
        <td><?php echo $row["deptt"] ?></td>
    </tr>
<?php }?>
</table>
<ul class="pagination">
    <li><a href="index.php?p=1">First</a></li>
    <?php
    if($total_pages < 10){
    for($i = 1;$i<= $total_pages;$i++){?>
    <li><a href="index.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php }}else{
    if($p > 5){
        $n = $p -4;
    }else{
        $n = 1;
    }
        if($n == 1){
            $end = 10;
            if ($end > $total_pages) {
                $end = $total_pages;
            }
        }else {
            $end = $p + 4;
            if ($end > $total_pages) {
                $end = $total_pages;
            }
        }
    for($i = $n;$i<= $end;$i++){?>
    <li><a href="index.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php
    }
    }
    ?>
    <li><a href="index.php?p=<?php echo $total_pages; ?>">Last</a></li>
</ul>
</body>
</html>
