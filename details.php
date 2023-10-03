<?php
include('configurations/db_connect.php');
//check get request id params

if(isset($_POST['delete'])){
   $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);


   $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

   if(mysqli_query($conn, $sql)){
    //query success
    header('Location: index.php');
   }else{
    //query fail
    echo 'query error: ' . mysqli_error($conn);
   }
}

if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //make sql query
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    //get the query result
    $result = mysqli_query($conn, $sql);

    // format result in associative array
    $pizzaInfo = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

    // print_r($pizzaInfo);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
    <div class="container text-center vh-100 mt-5">

  
        <h2 class="mb-5 text-danger"> Pizza details page</h2>

        <?php  if($pizzaInfo) : ?>
                <h3 class="text-warning"><?php echo htmlspecialchars($pizzaInfo['title']); ?></h3>
                <p><strong><?php echo htmlspecialchars($pizzaInfo['created_At']); ?></strong></p>
                <h5>Created By: <?php echo htmlspecialchars($pizzaInfo['name']); ?></h4>
                <p><?php echo 'Ingredients <br/>' . htmlspecialchars($pizzaInfo['ingredients']); ?></p>
        <?php else: ?>
            <?php endif; ?>

     
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizzaInfo['id']; ?>">
                <input type="submit" name="delete" value="DELETE" style="border-radius: 7px;
                 width: 100px; background-color: red; border: none;">
            </form>
        </div>
<?php include('templates/footer.php'); ?>
</html>