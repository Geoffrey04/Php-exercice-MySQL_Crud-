<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 14/01/2019
 * Time: 10:28
 */

$servername = 'localhost' ;
$username = "root" ;
$password = '';
$dbname = "colyseum";


// créer une nouvelle connexion :

$con = new mysqli($servername, $username, $password) ;

if($con -> connect_error) {

    die("Connection failed: " . $con->connect_error);


} else {

    $con -> select_db($dbname) ;

}
echo "Tout les clients :" . '<br>';

$clients = "select * from clients" ;

$connexion = $con -> query($clients) ;

while($row = $connexion-> fetch_assoc()) {

    echo "Her/His name is" .' '.$row['firstName']. ' ' . $row['lastName'] . '<br>' ;

}

echo '<br><br><br>' ;

echo "Types de spectacles : " . '<br>';

$show = "select * from showtypes" ;

$connexion = $con -> query($show) ;

while($row = $connexion-> fetch_assoc()) {

    echo "In this database , we have showtype like :" .' '. $row['type'] . '<br>' ;

}

echo '<br><br><br>' ;

echo "20 Premiers clients" . '<br>' ;

$client = "select * from clients where  clients.id <= 20" ;

$connexion = $con -> query($client) ;

while($row = $connexion-> fetch_assoc()) {

    echo $row['id']."His/Her name is" . ' ' . $row['firstName'] . ' ' . $row['lastName'] . '<br>';

}

echo '<br><br><br>' ;

echo "clients possedant une carte de fidélité :" . '<br>' ;

$cardf = "select * from clients, cards where clients.cardNumber = cards.cardNumber and cards.cardTypesId = 1  " ;
$connexion = $con -> query($cardf) ;

while($row = $connexion-> fetch_assoc()) {

    echo 'Mr/Mme' . $row['lastName'] . ' ' . $row['firstName'] . ' ' . 'have fidelity card'. '<br>' ;

}

echo '<br><br><br>' ;

echo "Liste des clients avec un nom commençant par M :" . '<br>' ;

$nameM = "select * from clients where clients.lastName like 'm%' order by lastName" ;

$connexion = $con -> query($nameM) ;

while($row = $connexion-> fetch_assoc()) {

    echo "Nom :" .' ' . $row['lastName'] . '<br>' . 'Prenom :' .' ' . $row['firstName'] . '<br><br>' ;
}

echo '<br><br><br>' ;

echo "Les spectacles :" . '<br>';

$showtime = "select * from shows order by title" ;

$connexion = $con -> query($showtime) ;

while($row = $connexion-> fetch_assoc()) {

    echo "Le spectacle :" .' '.$row['title'] . ' ' . 'par' . ' ' . $row['performer']. ' ' . 'le' . ' ' . $row['date']. ' '.'à' .' ' . $row['startTime'] . '<br><br>' ;

}

echo '<br><br><br>' ;

echo "Liste excercice 7:" . '<br>';

$showtime = "select * from clients  left join cards ON (cards.cardNumber = clients.cardNumber ) WHERE 1" ;

$connexion = $con -> query($showtime) ;

while($row = $connexion-> fetch_assoc()) {

    if($row['cardTypesId'] == 1) {

 echo 'Nom : ' . ' ' . $row['lastName'] . '<br>' . 'Prenom :'. ' ' . $row['firstName'] . '<br>' . 'Date de Naissance :' . ' ' . $row['birthDate'] . '<br>' .
        'Carte de fidélité : Oui '  . 'Numéro de carte : '. ' ' . $row['cardNumber'] . '<br><br>' ;

    } else {
        echo 'Nom : ' . ' ' . $row['lastName'] . '<br>' . 'Prenom :'. ' ' . $row['firstName'] . '<br>' . 'Date de Naissance :' . ' ' . $row['birthDate'] . '<br>' .
            'Carte de fidélité : non ' . '<br><br>' ;
    }

}


