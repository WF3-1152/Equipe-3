<?php
session_start();
require '../inc/config.php';

$errors = [];

if(!empty($_POST)){
    $safe = array_map('trim', array_map('strip_tags', $_POST));

    $sql = $bdd->prepare('SELECT email, password FROM register WHERE email = :email AND password = :password');
    $sql->execute();
    $data = $sql->fetch();

    $_SESSION['user'] = $data['user'];
    

    var_dump($sql);
}



?>



<?php require '../header.php'; ?>

<?php 

    if(isset($formIsValid) && $formIsValid == true){
        echo '<div class="alert alert-success">Votre inscription a bien été enregistré</div>';
    }
    elseif(isset($formIsValid) && $formIsValid == false){
        echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>';

    }
?>

<form method="POST">
    <div class="container w-50 my-5 form-group">

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com" required>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="password" placeholder="123" required>
            </div>
        </div>

        <button class="btn btn-warning form-control">Se connecter</button>

    </div>
</form>