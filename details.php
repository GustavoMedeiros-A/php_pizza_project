<?php 

    include('config/db_connect.php');

    //delete
    if(isset($_POST['delete'])){ //delete is the name of the input field

        $id_to_delete = mysqli_real_escape_string($connection, $_POST['id_to_delete']); //id_to_delete is the name of the input who catch the id

        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if(mysqli_query($connection, $sql)) {
            //success
            header('Location: index.php');
        } else {
            echo "query error: " . mysqli_error($connection);
        }
    }


    // check GET request id param
    if(isset($_GET['id'])) {

        $id = mysqli_real_escape_string($connection, $_GET['id']);

        //make sql

        $sql = "SELECT * FROM pizzas WHERE id = '$id'";

        //get the query result
        $result = mysqli_query($connection, $sql);

        //fetch result in array format // Catch just ONE result
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($connection);

        // print_r($pizza);

    }

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>


    <div class="container center grey-text">
        <?php if($pizza): ?>

            <h4><?php echo htmlspecialchars($pizza['title']) ?></h4>
            <p> Created by: <?php echo htmlspecialchars($pizza['email']) ?></p>
            <p><?php echo date($pizza['created_at']) ?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']) ?></p>

            <!-- DELETE FROM -->
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                <input type="submit" name="delete" value="Delete" class= "btn brand z-depth-0">
            </form>

        <?php else: ?>

            <h5>No such pizza exists</h5>

        <?php endif;  ?>
    </div>


    <?php include('templates/footer.php'); ?>

</html>