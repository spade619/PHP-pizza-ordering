<?php
include('configurations/db_connect.php');
$name = $title = $ingredients = '';
$errors = array('name' => '', 'title' => '', 'ingredients' => '');

    if(isset($_POST['submit'])){
       

        if(empty($_POST['name'])){
           $errors['name'] = 'a name is required <br />';
        }else{
            $name = $_POST['name'];
        }

        if(empty($_POST['title'])){
            $errors['title'] =  'a title is required <br />';
        }else{
            $name = $_POST['title'];
        }

        if(empty($_POST['ingredients'])){
            $errors['ingredients'] =  'an ingredients is required <br />';
        }else{
            $name = $_POST['ingredients'];
        }

        // check for errors
        if(array_filter($errors)){
            // echo 'there are errors';
        }else{
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
            //query to add data to db
            $sql = "INSERT INTO pizzas(title,name,ingredients) VALUES('$title', '$name', '$ingredients')";
          
          //save to db then check
          if(mysqli_query($conn, $sql)){
            //if success redirects to home page
            header('Location: index.php');
          }else{
            //if error displays error
            echo'somethings wrong with the query' . mysqli_error($conn);
          }
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">



<?php include('templates/header.php'); ?>
<section class="container text-dark">
    <div class="text-center vh-100">
        <div>Add a pizza</div>
        <div class="container text-center">
            <form class="bg-light pizzaForm" action="addItem.php" method="POST">

            <label for="exampleFormControlInput1" class="form-label">Your Name</label>
  <input type="text" class="form-control"  name="name"  placeholder="Input Name" value="<?php echo $name ?>">
                <div class="text-danger">
                        <?php echo $errors['name']; ?>
                </div>
  <label for="exampleFormControlInput1" class="form-label">Pizza Title</label>
  <input type="text" class="form-control"  name="title"  placeholder="Input Pizza Title" value="<?php echo $title ?>">
        <div class="text-danger">
        <?php echo $errors['title']; ?>
        </div>
  <label for="exampleFormControlInput1" class="form-label">Ingredients (comma separated): </label>
  <input type="text" class="form-control"  name="ingredients"  placeholder="Input Ingredients" value="<?php echo $ingredients ?>">
            <div class="text-danger">
            <?php echo $errors['ingredients']; ?>
            </div>
<div class="text-center">
    <input type="submit" name="submit" value="submit" class="btn btn-primary my-4">
</div>
</form></div>
        
    </div>
</section>
<?php include('templates/footer.php'); ?>


</html>