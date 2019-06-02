<?php 
function randomDigits($length){
    $digits = 0;
    $numbers = range(0,9);
    shuffle($numbers);
    for($i = 0;$i < $length;$i++)
    $digits .= $numbers[$i];
    return $digits;
}
//Kun upload nappia painetaan
//if (isset($_POST['upload'])) {
    //missä kuva sijaitsee
    $randomNumber = randomDigits(5);
    $target = 'gallery/'. $randomNumber .basename($_FILES['image']['name']);

    //Tietokantayhteys
    $db = mysqli_connect("localhost", "root", "", "raksa");

    //Kaikki tarvittava data lomakkeesta
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];
    $finalimage = $randomNumber . $image;

    //Kuvien siirto kansioon tietokannassa
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // print_r($_FILES);
        // die;
    } else {
        
    }
    // header ('Location: screenshots.php');

    if ($_FILES['image']['name'] == "") {
        header('Location: screenshots.php');
    } else {
        $sql = "INSERT INTO gallery (image, text) VALUES ('$finalimage', '$text')";
        mysqli_query($db, $sql); //tallentaa tiedot tietokantaan
    }
    header('Location: screenshots.php');
    
// } else {
//    echo '<script>console.log("huu")</script>';
// }




?>