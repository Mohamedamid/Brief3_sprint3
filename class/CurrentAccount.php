<?php 

include('./../config/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP crud</title>
  <!-- <link rel="stylesheet" href="./../style/style.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">NeoBank</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="accounts.php">Saving Accounts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transactions.php">Current account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="business.php">business account</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
<!-- add a modal user -------------------------------------------------------->
<div class="modal fade" tabindex="-1" id="addNewUserModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">add a new account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<form id="add-user-form" class="p-2" novalidate>
  
<div class="row mb-3">
<div class="col">
  <input type="text" name="acountNumF"  class="form-control form-control-lg" placeholder="enter acountNumF" required>
  <div class="invalid-feedback">acountNum is required</div>
</div>
<div class="col">
  <input type="text" name="holderNameF"  class="form-control form-control-lg" placeholder="enter holderNameF" required>
  <div class="invalid-feedback">holderName is required</div>
</div>
</div>
<div class="mb-3">
  <input type="number" name="balanceF"  class="form-control form-control-lg " placeholder="enter balanceF"required>
  <div class="invalid-feedback">balance is required</div>

</div>
<div class="mb-3">
  <select name="accountTypeF" class="form-control form-control-lg" required>
    <option value="" disabled selected>Select account type</option>
    <option value="1">Business account</option>
    <option value="2">Current account</option>
    <option value="3">Saving account</option>
  </select>
  <div class="invalid-feedback">Account type is required</div>
</div>

<div class="mb-3">
  <input type="submit" value="Add User" class="btn btn-primary btn-block btn-lg" id="add-user-btn">
</div>
</form>

    </div>
      
    </div>
  </div>
</div>
<!-- end a modal user------------------------------------------------------ -->







<!-- edit ---------(----------------------------------------------------------------------------- -->
<div class="modal fade" tabindex="-1" id="editNewUserModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">edit account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<form id="edit-user-form" class="p-2" novalidate>

<input type="hidden" name="id" id="id">
  
<div class="row mb-3">
<div class="col">
  <input type="text" name="accountNum" id="accountNum" class="form-control form-control-lg" placeholder="enter acountNumF" required>
  <div class="invalid-feedback">acountNum is required</div>
</div>
<div class="col">
  <input type="text" name="holderName" id="holderName" class="form-control form-control-lg" placeholder="enter holderNameF" required>
  <div class="invalid-feedback">holderName is required</div>
</div>
</div>
<div class="mb-3">
  <input type="number" name="balanceF" id="balanceF" class="form-control form-control-lg " placeholder="enter balanceF"required>
  <div class="invalid-feedback">balance is required</div>

</div>
<!-- <div class="mb-3">
  <select name="accountTypeF" class="form-control form-control-lg" required>
    <option value="" disabled selected>Select account type</option>
    <option value="1">Business account</option>
    <option value="2">Current account</option>
    <option value="3">Saving account</option>
  </select>
  <div class="invalid-feedback">Account type is required</div>
</div> -->

<div class="mb-3">
  <input type="submit" value="update User" class="btn btn-success btn-block btn-lg" id="edit-user-btn">
</div>
</form>

    </div>
      
    </div>
  </div>
</div>
<!-- ---edit---------- ------------------------------------------------------------------------->
<d class="container">
  <div class="row mt-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
      <div>
        <h4 class="text-primary" >all accounts in Neobank</h4>
      </div>
      <div>
      <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNewUserModal">
    add account
</button>

      </div>
    </div>
  </div>
  <hr>

<div class="row">
  <div class="col-lg-12">
    <div id="showAlert">

    </div>
  </div>
</div>

  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
          <thead>
            <tr>
            <th>Account ID</th>

              <th>Account Number</th>
              <th>Holder Name </th>
              <th>Balance</th>
              <!-- <th>Account Type</th> -->
              <th>action</th>
             
            </tr>
          </thead>
          <tbody>
          
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
<script src="main.js"></script>
</html>