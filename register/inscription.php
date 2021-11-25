<?php
session_start();
require '../inc/config.php';

$errors = [];

if(!empty($_POST)){

	$safe = array_map('trim', array_map('strip_tags', $_POST));

    if(strlen($safe['user']) < 5 || strlen($safe['user']) > 60){
		$errors[] = 'Votre prénom doit comporter entre 5 et 60 caractères';
	}

    if(!filter_var(strtolower($safe['email']), FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Votre email n\'est pas valide';
	}

    if($safe['password'] == $safe['repassword']){
        $safe['password'] = hash('sha256', $safe['password']);
    }

    if(count($errors) == 0){
        $sql = 'INSERT INTO register (user, email, password, role) VALUES (:user, :email, :password, :role)';

        $insert = $bdd->prepare($sql); 

        // $insert->bindValue(':id', $safe['id']);
        $insert->bindValue(':user', $safe['user']);
        $insert->bindValue(':email', $safe['email']);
        $insert->bindValue(':password', $safe['password']);
        // $insert->bindValue(':token', $safe['token']);
        $insert->bindValue(':role', 'member');

        $insert->execute();
        

        $formIsValid = true;
	}
	else {
		$formIsValid = false;
	}
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
            <label for="user" class="col-sm-2 col-form-label">Prenom</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="user" id="user" placeholder="name" required>
            </div>
        </div>

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

        <div class="mb-3 row">
            <label for="repassword" class="col-sm-2 col-form-label">Re_Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" name="repassword" id="repassword" placeholder="123" required>
            </div>
        </div>

        <button class="btn btn-warning form-control">S'inscrire</button>

    </div>
</form>
