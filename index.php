<?php

include_once("./php/config.php");
include_once("./class/Account.php");

if (isset($_POST["Ajouter"])) {

    $holdName = $_POST["holderName"];
    $bal = $_POST["balance"];
    $typeAcc = $_POST["type_account"];

    if ($typeAcc == "currentaccount") {
        $val = $_POST["val1"];
    } elseif ($typeAcc == "savingaccount") {
        $val = $_POST["val2"];
    } elseif ($typeAcc == "businessaccount") {
        $val = $_POST["val3"];
    }
    $addAccount = new Account($holdName, $bal);
    $addAccount->ajouterCompte($conn, $typeAcc, $val);
}

if (isset($_GET["idDelet"])) {

    $id = $_GET["idDelet"];

    $DeletAccount = new Account(null, null);
    $DeletAccount->supprimerCompte($conn, $id);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css?v=1.1">
    <title>Account Management</title>
</head>

<body>
    <nav class="navbar">
        <div class="div1_navbar">
            <img src="./images/compte.png" alt="" style="width:50px">
        </div>
        <div class="div2_navbar">
            <ul>
                <li><a href="./index.php">Account</a></li>
                <li><a href="./class/CurrentAccount.php">Current Account</a></li>
                <li><a href="./class/SavingsAccount.php">Saving Account</a></li>
                <li><a href="./class/BusinessAccount.php">Business Account</a></li>
            </ul>
        </div>
    </nav>
    <main class="main">
        <form class="form_account" action="" method="POST" class="p-4 border rounded shadow-sm">
            <div class="mb-3">
                <label for="holderName" class="form-label">Holder Name</label>
                <input type="text" name="holderName" id="holderName" class="form-control" placeholder="Holder Name"
                    required>
            </div>

            <div class="mb-3">
                <label for="balance" class="form-label">Balance</label>
                <input type="number" name="balance" id="balance" class="form-control" placeholder="Balance" required>
            </div>

            <div class="mb-3">
                <label for="type_account" class="form-label">Account Type</label>
                <select name="type_account" id="type_account" class="form-select" required>
                    <option value="">-------------------</option>
                    <option value="currentaccount">Current Account</option>
                    <option value="savingaccount">Saving Account</option>
                    <option value="businessaccount">Business Account</option>
                </select>
            </div>

            <div class="mb-3 overdraftLimit1" style="display:none">
                <label for="overdraftLimit" class="form-label">Overdraft Limit</label>
                <input class="overdraftLimit form-control" type="number" placeholder="Overdraft Limit" name="val1" required>
            </div>

            <div class="mb-3 interestRate1" style="display:none">
                <label for="interestRate" class="form-label">Interest Rate</label>
                <input class="interestRate form-control" type="number" placeholder="Interest Rate" name="val2">
            </div>

            <div class="mb-3 transactionFee1" style="display:none">
                <label for="transactionFee" class="form-label">Transaction Fee</label>
                <input class="transactionFee form-control" type="number" placeholder="Transaction Fee" name="val3">
            </div>

            <button type="submit" name="Ajouter" class="btn btn-primary">
                <img src='./images/nouveau-compte.png' alt="" style="width:30px; margin:0">
            </button>
        </form>
        <div class="table-responsive" style="width:70%">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Holder Name</th>
                        <th>Balance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $accounts = Account::consulterComptes($conn);
                    foreach ($accounts as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['accountID'] . "</td>";
                        echo "<td>" . $row['holderName'] . "</td>";
                        echo "<td>" . number_format($row['balance'], 2) . " DH</td>";
                        echo "<td>
                        <a href='Edit.php?idEdit=" . $row['accountID'] . "' class='btn btn-warning btn-sm'>Edit</a> 
                        <a href='index.php?idDelet=" . $row['accountID'] . "' class='btn btn-danger btn-sm'>Delete</a>
                      </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="./js/main.js"></script>
</body>

</html>