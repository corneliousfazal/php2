<ul><?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$n = $_POST["n"];
$p = $_POST["p"];
$flag = true;
if(empty($n)){
    echo "<li>Please enter your name</li>";
    $flag = false;
}

if(empty($p)){
    echo "<li>please enter your password</li>";
    $flag = false;
}
if($flag){
    if($n == "ali" && $p = "123"){
        session_start();
        $_SESSION["login"] = true;
        echo "<li>login</li>";
    }else{
        echo "<li>Invalid user name or password</li>";
    }
    }}else{
    header("location:login.html");
}
?></ul>