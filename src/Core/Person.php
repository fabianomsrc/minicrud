<?php

declare(strict_types=1);

namespace MiniCRUD\Core;

use MiniCRUD\Database\MySQLManager;

class Person
{
    protected MySQLManager $manager;

    protected string $name;

    protected string $email;

    protected ?string $phone = null;

    public function __construct(MySQLManager $manager)
    {
        $this->manager = $manager;
    }

    public function insertNewPerson(): bool
    {
        try {
            $conn = $this->manager->connect();

            $query = 'INSERT INTO `person` (`person_name`, `person_email`, `person_phone`) VALUES (?, ?, ?)';

            $stmt = $conn->prepare($query);
            $stmt->bind_param('sss', $this->name, $this->email, $this->phone);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }

            return false;
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }

    public function findPersonByID(int $personID): ?array
    {
        try {
            $conn = $this->manager->connect();

            $query = 'SELECT * FROM `person` WHERE `person_id` = ?';

            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $personID);

            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                return $result;
            }

            return null;
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }

    public function findPersonByEmail(string $email)
    {
        try {
            $conn = $this->manager->connect();

            $query = 'SELECT * FROM `person` WHERE `person_email` = ?';

            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $email);

            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $result;
            }

            return false;
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }

    public function readAllData(): ?array
    {
        try {
            $conn = $this->manager->connect();

            $query = 'SELECT * FROM `person`';

            $stmt = $conn->query($query);

            if ($stmt->num_rows > 0) {
                $result = $stmt->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                return $result;
            }

            return null;
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }

    public function updatePerson(int $personID)
    {
        try {
            $conn = $this->manager->connect();

            $query = 'UPDATE `person` SET `person_name` = ?, `person_email` = ?, `person_phone` = ? WHERE `person_id` = ?';

            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssi', $this->name, $this->email, $this->phone, $personID);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return false;
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }

    public function deletePersonByID(int $personID): bool
    {
        try {
            $conn = $this->manager->connect();

            $query = 'DELETE FROM `person` WHERE `person_id` = ?';

            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $personID);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return false;
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }
}
