<?php
    session_start(); 
    require_once 'header.php';

    if(isset($_SESSION['user'])){
    
?>

    <div class="card" <?php if ( $_SESSION['user']['gender'] == 'male') { echo "style='box-shadow: 0 0 15px #1a1e33;background-color: #15192f; color: #ededf2'";}?>>
        <img <?php if ( $_SESSION['user']['gender'] == 'male') { echo "style='border: 2px solid #ededf2;'";}?> src="images/<?php echo $_SESSION['user']['file']?>" alt="img">
        <div>
            <h2>Name : <?php echo $_SESSION['user']['name']?></h2>
            <h2>Email : <?php echo $_SESSION['user']['email']?></h2>
            <h2>Password : <?php echo $_SESSION['user']['password']?></h2>
            <h2>Address : <?php echo $_SESSION['user']['address']?></h2>
            <h2>Gender : <?php echo $_SESSION['user']['gender']?></h2>
            <h2>Linkedin Url : <?php echo "<a href='http://www.linkedin.com'>".$_SESSION['user']['url'].'</a>'?></h2>
        </div>
    </div>
<?php
} require_once 'footer.php';
?>