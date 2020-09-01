<?php include 'includes/layout/header.php'; 
    include 'includes/functions/functions.php';
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if(!$id){
    die('Is not valid');
    }

    $result = obtainContact($id);

    $contact = $result->fetch_assoc();

?>



<div class="containerBar">
    <div class="container Bar">
        <a href="index.php" class="btn back">Back</a>
        <h1>Edit contact</h1>
    </div>
</div>

<div class="bgBlue container shadow">
    <form id ="contact" action ="">
        <legend>Change the values<span></span></legend>

        <?php include 'includes/layout/form.php'; ?>
        
    </form>
</div>

<?php include 'includes/layout/footer.php'; ?>