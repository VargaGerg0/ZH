<?php 
function getDb($hostname="localhost",$username="root",$password="",$dbname="mydb"):PDO{
    try{
    $db=new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
    } catch(PDOException $e){
    echo 'Sikertelen' . $e->getMessage();
    exit;
    }
}
session_start();
$db=getDb();
$errors=[];

if(!empty($_POST)){


if(empty($_POST['nev'])){
    $errors['nev'] = 'Név megadása kötelező';
}
if($_POST['szam']>6||$_POST['szam']<0){
    $errors['szam'] = 'Az értékelésnek 1 és 5 között kell lennie';
}
if(empty($_POST['szam'])){
    $errors['szam'] = 'Pont megadása kötelező';
}
if(empty($errors)){
$nev=$_POST['nev'];
$szam=$_POST['szam'];
$film=$_POST['filmek'];

$statement=$db->prepare("INSERT INTO ertekeles(filmek_id,nev,pont) VALUES(:film,:ember,:szam)");
$statement->bindParam(":szam",$szam,PDO::PARAM_STR);
$statement->bindParam(":film",$film,PDO::PARAM_STR);
$statement->bindParam(":ember",$nev,PDO::PARAM_STR);
$result=$statement->execute();
if($result){
    $_SESSION["message"]='Sikeres beszúrás';
}


}
}
header("Location: index.php");
?>