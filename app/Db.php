<?php
```
Function of this programm are:
    - establish valid connection with provided database
    - perform queries for database
    - dump the variables
```

// Class responsible for creating database connection
class DatabaseConnection{

    public $connection;

    public function __construct(string $serverName, string $databaseName, string $userName, string $password){
        try{
            $dns="mysql:host=$serverName;dbname=$databaseName";
            $conn = new PDO($dns, $userName, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection= $conn;
        }
        catch(PDOException $e){
            $this->connection=null;
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Close connection for safety reasons while no longer in use
    public function __destruct(){
        $this->connection = null;
    }
}

// Function that return two joined tables(customers and daysorders) by a AGENT_CODE variable
// All of the custumers are returned if there is no matching daysorder record, it returns null
function getJoinedTable($connection){
    $query="
    SELECT *
    FROM customer
    LEFT JOIN daysorder
    ON customer.AGENT_CODE=customer.AGENT_CODE;
    ";
    $sth = $connection->prepare($query);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

// This function return sum of recived amount from all active (by ORD_DESCRIPTION) dayorders
function getSumOfActiveReciveAmount($connection){
    $query="
    SELECT SUM(RECEIVE_AMT)
    FROM customer
    INNER JOIN daysorder
    ON customer.AGENT_CODE=customer.AGENT_CODE
    WHERE ORD_DESCRIPTION = 'ACTIVE'
    ";

    $sth = $connection->prepare($query);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

// Establishing connection
$database = new DatabaseConnection("flexi.home.pl", "01452998_inter_system_dev", "01452998_inter_system_dev", "BhvNU7GDh");

// Making sure connection is valid
if($database->connection){
    var_dump(getJoinedTable($database->connection));
    var_dump(getSumOfActiveReciveAmount($database->connection));
}

?> 

