<?php 
// Random number generator, so the database doesn't replace the old pictures
function randomDigits($length){
    $digits = 0;
    $numbers = range(0,9);
    shuffle($numbers);
    for($i = 0;$i < $length;$i++)
    $digits .= $numbers[$i];
    return $digits;
}

   
    $randomNumber = randomDigits(5);
    $target = 'gallery/'. $randomNumber .basename($_FILES['image']['name']);

    // Connection to the database, it may be anything
    $db = mysqli_connect("localhost", "root", "", "raksa");

    // All the needed things from the form
    $image = $_FILES['image']['name'];
    // Text not needed in this case
    $text = $_POST['text'];
    $finalimage = $randomNumber . $image;

    // When uploaded, files move in the database
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    }

    if ($_FILES['image']['name'] == "") {
        header('Location: screenshots.php');
    } else {
        $sql = "INSERT INTO gallery (image, text) VALUES ('$finalimage', '$text')";
        mysqli_query($db, $sql); //Saving the file(s) to the database
    }
    header('Location: screenshots.php');
    

?>
