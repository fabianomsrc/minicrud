<?php

use MiniCRUD\Core\Person;
use MiniCRUD\Database\MySQLManager;

require __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../partials/header.php';

if (filter_input(INPUT_POST, 'personID')) {
    $personID = filter_input(INPUT_POST, 'personID');

    $person = new Person(new MySQLManager());
    $person->deletePersonByID($personID);

    header('Location: ./read.php?message=success');
}
?>

<div>
    <div>
    </div>
    <div>
        <div>
            <form action="../../pages/person/delete.php" method="post">
                <label>Do you really want to remove the user?</label>
                <input type="hidden" name="personID" value="<?= filter_input(INPUT_GET, 'personID') ?>">
                <button type="submit" name="btnDelete">Yes</button>
            </form>
        </div>
    </div>
</div>
