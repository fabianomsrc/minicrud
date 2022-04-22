<?php

use MiniCRUD\Core\Person;
use MiniCRUD\Database\MySQLManager;

require __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../partials/header.php';

if (filter_input_array(INPUT_GET)) {
    $personID = filter_input(INPUT_GET, 'personID');

    $person = new Person(new MySQLManager());
    $result = $person->findPersonByID($personID);

    if (filter_input_array(INPUT_POST)) {
        $post = filter_input_array(INPUT_POST);

        $data = [
            'name'  => trim($post['name']),
            'email' => trim($post['email']),
            'phone' => trim($post['phone'])
        ];

        $data = (object)$data;
        
        if (! empty($data->name) && ! empty($data->email)) {
            $person->name  = $data->name;
            $person->email = $data->email;
            $person->phone = $data->phone;

            if ($person->updatePerson($personID)) {
                header('Location: ./read.php');
            }
        }
    }
}
?>

<div>
	<div>
        <a href="./read.php"><h1>:: Update ::</h1></a>
        <a class="btn btn-success text-white" href="./read.php">Prev</a>
    </div>
    <div>
        <div>
            <?php if ($result) : ?>
            <form action="" method="POST">
                <input type="hidden" name="personID" value="<?= htmlspecialchars($result['person_id'], ENT_QUOTES) ?>">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($result['person_name'], ENT_QUOTES) ?>">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($result['person_email'], ENT_QUOTES) ?>">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($result['person_phone'], ENT_QUOTES) ?>">

                <button type="submit">Save</button>
            </form>
            <?php endif ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php' ?>
