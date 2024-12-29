<?php

include("./php/config.php");
include("./class/Account.php");

if (isset($_POST["Edit"])) {

    $id = $_GET["idEdit"];

    $holdN = $_POST["EditholderName"];
    $bln = $_POST["Editbalance"];

    $EditAccount = new Account($holdN,$bln);
    $EditAccount->modifierCompte($conn ,$id);
    header("location:index.php");
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
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
        <div class="div1_navbar">
            <img src="../images/compte.png" alt="" style="width:50px">
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
    <form class="Edit_form" action="" method="POST" class="p-4 border rounded shadow-sm">
        <div class="mb-3">
            <label for="holderName" class="form-label">Holder Name</label>
            <input type="text" name="EditholderName" id="holderName" class="form-control" placeholder="Holder Name"
                required>
        </div>

        <div class="mb-3">
            <label for="balance" class="form-label">Balance</label>
            <input type="number" name="Editbalance" id="balance" class="form-control" placeholder="Balance" required>
        </div>

        <div class="mb-3 overdraftLimit1" style="display:none">
            <label for="overdraftLimit" class="form-label">Overdraft Limit</label>
            <input class="overdraftLimit form-control" type="number" placeholder="Overdraft Limit" name="Editval1">
        </div>

        <div class="mb-3 interestRate1" style="display:none">
            <label for="interestRate" class="form-label">Interest Rate</label>
            <input class="interestRate form-control" type="number" placeholder="Interest Rate" name="Editval2">
        </div>

        <div class="mb-3 transactionFee1" style="display:none">
            <label for="transactionFee" class="form-label">Transaction Fee</label>
            <input class="transactionFee form-control" type="number" placeholder="Transaction Fee" name="Editval3">
        </div>

        <button type="submit" name="Edit" class="btn btn-primary" style="background-color:chartreuse; border:yellow;width:100px">
            <img src='./images/nouveau-compte.png' alt="" style="width:30px; margin:0;">
        </button>
    </form>
</main>
    <script src="./js/main.js"></script>
</body>
</html>