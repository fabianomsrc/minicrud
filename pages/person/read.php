<?php

use MiniCRUD\Core\Person;
use MiniCRUD\Database\MySQLManager;

require __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../partials/header.php';

?>

<div>
    <div>
        <h1>:: Read ::</h1>
        <a href="./create.php">New Person</a>
    </div>
    <div>

    </div>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    <?php if ((new Person(new MySQLManager()))->readAllData()) : ?>
        <?php foreach ((new Person(new MySQLManager()))->readAllData() as $result) : ?>
        <tr>
            <td><?= htmlspecialchars($result['person_name'], ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($result['person_email'], ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($result['person_phone'], ENT_QUOTES) ?></td>
            <td><a href="./update.php?personID=<?=$result['person_id']?>"><i class="fas fa-edit"></i></a></td>
            <td><a href="./delete.php?personID=<?=$result['person_id']?>"><i class="fas fa-trash"></i></a></td>
        </tr>
        <?php endforeach ?>
    <?php endif ?>
    </table>
</div>

<?php include __DIR__ . '/../partials/footer.php' ?>
