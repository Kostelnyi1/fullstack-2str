<?php
session_start();
require_once '../templates/header.php';



$userId = $_GET['id'];

$query = 'SELECT * FROM users WHERE id = :id';
$res = $pdo->prepare($query);
$res->execute([
    ':id' => $userId,
]);
$user = $res->fetch();

if ($user) {

$query = "SELECT * FROM cities";
$res = $pdo->query($query);
$cities = $res->fetchAll();

if (isset($_SESSION['error'])) {
    echo"
    <div class='alert alert-danger text-center' role='alert'>
        {$_SESSION['error']}
    </div>
    ";
    unset($_SESSION['error']);
} else if  (isset($_SESSION['success'])) {
    echo"
    <div class='alert alert-success text-center' role='alert'>
        Данные успешно обновлены!
    </div>
    ";
    unset($_SESSION['success']);
}

?>
        <form method="post" action="../actions/update_user.php">
            <label>Имя</label>
            <input name='id' hidden value='<?=$user['id']?>'>
            <input class="form-control mb-2" name='name' value='<?=$user['name']?>'>
            <label>Логин</label>
            <input class="form-control mb-2" name='login' value='<?=$user['login']?>'>
            <select class="form-control mb-2" name="city_id">   
                    <?php
                        if (!$user['city_id']) { 
                            echo '<option selected disabled>-- Выберите город --</option>';  
                        }    
                        foreach ($cities as $city){
                            $selected = $city['id'] == $user['city_id'] ? 'selected' : '';
                            echo "<option $selected value='{$city['id']}'>{$city['name']}</option>";
                        }
                    ?>
            </select>
            <button type='submit' class="btn btn-success w-100">СОХРАНИТЬ</button>
        </form>

        <?php
        } else {
            echo 
            '<div class="alert alert-warning" role="alert">
                Пользователь не найден!
            </div>
            ';
        }
        ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>