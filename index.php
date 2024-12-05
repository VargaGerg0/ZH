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
$db=getDb();
$query = $db->query("SELECT filmek.*, FORMAT(COALESCE(avg(ertekeles.pont),0),2) as ossz, count(ertekeles.pont) as db FROM filmek
            LEFT JOIN ertekeles ON filmek.id = ertekeles.filmek_id
            WHERE filmek.ev > 2000
            GROUP BY filmek.id, filmek.cim, filmek.ev
            ORDER BY filmek.ev;");
$filmek = $query->fetchAll(PDO::FETCH_ASSOC);
$query=$db->query("select * from ertekeles");
$ertekelesek=[];
foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $e) {
    $ertekelesek[$e['Filmek_id']][] = $e;

}
?>
<!DOCTYPE html>
<html lang="hun">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Filmek</h1>
    <p>Varga Gergő, WWJVXJ</p>
<div class="Filmek">
<?php foreach ($filmek as $movie): ?>
     <div class="Film">
        <h2><?= $movie['Cim'] ?></h2>
        <p><?= $movie['ev']?></p>
        <p><span id="ert">Értékelés: </span><?= $movie['ossz']?>(<?= $movie['db']?> válasz)</p>
             <?php if (!empty($ertekelesek[$movie['id']])): ?>
                <?php foreach ($ertekelesek[$movie['id']] as $ertekeles): ?>
                     <ul>
                     <li><?= $ertekeles['Nev']?>:<?= $ertekeles['Pont']?>/5</li>
                     </ul>
                <?php endforeach ?>
            <?php else: ?>
             <p>Nincs értékelés</p>
                <?php endif; ?>
</div>
<?php endforeach ?>
</div>
<form action="rate.php" method="post">
            <h3>Értékelés</h3>
            Film:
            <select name="filmek">
            <?php foreach ($filmek as $movie): ?>
                <option value=<?=$movie['id']?>><?= $movie['Cim'] ?></option>
                <?php endforeach ?>
            </select>
            <p>
                <label>Név: <input type="text" name="nev" /></label>
                <?= $errors['nev'] ?? '' ?>
            </p>
            <p>
                <label>Pontszám: <input type="number" name="szam" min="1" max="5" id=szam /><span id="hely"></span></label>
                <?= $errors['szam'] ?? '' ?>
            </p>
            <p> 
                <input type="submit" value="Küldés" name="uj" />
            </p>
        </form>
        <script type="text/javascript" src="script.js"></script>
</body>
</html>