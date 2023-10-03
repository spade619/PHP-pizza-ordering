
<?php
include('configurations/db_connect.php');
// query initialization
$sql = 'SELECT * FROM pizzas';
// query execution
$result = mysqli_query($conn, $sql);
// returning result in an associative array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// cleanup functions for on successful query to free from memory
mysqli_free_result($result);
//close connection
mysqli_close($conn);


    // print_r(explode(',', $pizzas[0]['ingredients']));
 ?>
<!DOCTYPE html>
<html lang="en">



<?php include('templates/header.php'); ?>
<?php include('templates/contentHeader.php'); ?>
<div class="container bg-light text-center">
    <h3>Current Pizzas</h3>
    <div class="container">
        <?php foreach($pizzas as $pizza){ ?>
            <div class="card" style="width: 18rem;">
        <div class="card-body text-center">
             <h4 class="card-title text-warning"><?php echo htmlspecialchars($pizza['title']); ?></h4>
             <h6 class="card-subtitle mb-2 text-body-secondary">
             <?php echo 'by: ' . htmlspecialchars($pizza['name']); ?>
             </h6>
             <!-- <p class="card-text"> <?php echo '<h5>ingredients: </h5>' . htmlspecialchars($pizza['ingredients']); ?></p> -->
             <ul class="text-center px-3">
                <h5>ingredients</h5>
                <?php foreach(explode(',', $pizza['ingredients']) as $madeWith){ ?>
                    <li style="list-style: none;">
                        <?php echo htmlspecialchars($madeWith); ?>
                    </li>
                    <?php } ?>
             </ul>
         </div>
         <div>
       
         <button type="button" class="btn btn-outline-secondary my-2 mx-2">
            <a href="details.php?id=<?php echo $pizza['id']?>" style=" text-decoration: none;">More Info</a>
         </button>
         </div>
        </div>
        <?php } ?>
    </div>
    
</div>
<?php include('templates/footer.php'); ?>


</html>