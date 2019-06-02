<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible">
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <title>RaksaVR</title>
    </head>
    
    
<body>
    <!-- Navigationbar -->
    <div class="topnav">
      <a href="index.php">Home</a>
      <a href="credits.php">Credits</a>
      <a href="about.php">About</a>
      <a class="active" href="#">Gallery</a>
</div>

    <div class="Gallery">
        <?php
            $db = mysqli_connect("localhost", "root", "", "raksa");
            $sql = "SELECT * FROM gallery";
            $result = mysqli_query($db, $sql);

            // Things you want to print from the database
            while($row = mysqli_fetch_array($result)) {
                echo "<div id='image-div'>";
                    echo "<img src='gallery/".$row['image']."' >";
                    echo "<p style='color: white;'>".$row['text']."</p>";
                echo "</div>";
            }

        ?>
    </div>

    <!-- Uploading form -->
    <div class="container-1">
        <form class="screenshot-form" method="post" action = "post.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="10000000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
            <!-- <textarea name="text" cols="40" rows="4" placeholder="Your text here"></textarea> -->
            </div>
            <div>
                <input type="submit" name="upload" value="Upload your screenshot">
            </div>  
        </form>
    </div>
</body>
</html>
