<?php

use MiniCRUD\Core\Person;
use MiniCRUD\Database\MySQLManager;

require __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../partials/header.php';

if (filter_input_array(INPUT_POST)) {
    $person = new Person(new MySQLManager());

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

        if (! $person->findPersonByEmail($data->email)) {
            $person->insertNewPerson();
            header('Location: ./read.php?message=success');
        } else {
            echo 'Email already registered!';
        }
    }
}

?>

<div>
    <div>
        <h1>:: Create ::</h1>
        <a href="./../../index.php">Preview</a>
    </div>
    <div>
        <div>
            <form action="./../person/create.php" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Full Name">
                <label for="name">Email</label>
                <input type="email" name="email" id="email" placeholder="email@example.com">
                <label for="name">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="+5500000000000">

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/header.php' ?>
