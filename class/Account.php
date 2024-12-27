<?php
class Account
{
    protected $holderName;
    protected $balance;

    public function __construct( $holdName, $bal )
    {
        $this->holderName = $holdName;
        $this->balance = $bal;
    }

    public function ajouterCompte($conn,$typeAcc,$val)
    {
        try {
            $query = "INSERT INTO account (holderName, balance) 
                  VALUES (:holderName, :balance)";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':holderName', $this->holderName);
            $stmt->bindValue(':balance', $this->balance);
            if ($stmt->execute()) {
                $id = $conn->lastInsertId();
                // retunr $id

                /*
                $id = parent::ajouterCompte()
                 $query1 = "INSERT INTO currentaccount (accountID,overdraftLimit) VALUES ($id,$val)";
                    $stmt1 = $conn->prepare($query1);
                    $stmt1->execute();
                */
                if($typeAcc === "currentaccount"){
                    $query1 = "INSERT INTO currentaccount (accountID,overdraftLimit) VALUES ($id,$val)";
                    $stmt1 = $conn->prepare($query1);
                    $stmt1->execute();
                }
                elseif($typeAcc == "savingaccount"){
                    $query1 = "INSERT INTO savingaccount (accountID,interestRate) VALUES ($id,$val)";
                    $stmt1 = $conn->prepare($query1);
                    $stmt1->execute();
                }
                elseif($typeAcc == "businessaccount"){
                    $query1 = "INSERT INTO businessaccount (accountID,transactionFee) VALUES ($id,$val)";
                    $stmt1 = $conn->prepare($query1);
                    $stmt1->execute();
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function consulterComptes($conn)
    {
        $query = "SELECT * FROM account";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modifierCompte($conn ,$id)
    {
        $query = "UPDATE account SET holderName = :holderName, balance = :balance WHERE accountID = :accountID";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':accountID', $id);
        $stmt->bindValue(':holderName', $this->holderName);
        $stmt->bindValue(':balance', $this->balance);
        return $stmt->execute();
    }

    public function supprimerCompte($conn,$id)
    {
        $query = "DELETE FROM account WHERE accountID = :accountID";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':accountID', $id);
        return $stmt->execute();
    }

    public function afficherSolde()
    {
        return $this->balance;
    }

    // public function deposer($amount)
    // {
    //     if ($amount > 0) {
    //         $this->balance += $amount;
    //         return true;
    //     }
    //     return false;
    // }

    // public function retirer($amount)
    // {
    //     if ($amount > 0 && $this->balance >= $amount) {
    //         $this->balance -= $amount;
    //         return true;
    //     }
    //     return false;
    // }
}
?>
