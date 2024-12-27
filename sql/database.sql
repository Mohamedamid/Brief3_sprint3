CREATE DATABASE db_banque;
USE db_banque;

CREATE TABLE account(
    accountID INT PRIMARY KEY AUTO_INCREMENT ,
    accountNum VARCHAR(50) UNIQUE NOT NULL,
    holderName VARCHAR(50) NOT NULL,
    balance DECIMAL(15,2) NOT NULL
    );

CREATE TABLE savingAccount( 
    savingAccountID INT PRIMARY KEY AUTO_INCREMENT,
      interestRate DECIMAL(5, 2) NOT NULL,
       accountID INT,
      FOREIGN KEY(accountID) REFERENCES account(accountID) ON DELETE CASCADE
    );

CREATE TABLE currentAccount( 
    currentAcocuntID INT PRIMARY KEY AUTO_INCREMENT,
      overdraftLimit DECIMAL(15, 2) NOT NULL,
       accountID INT,
      FOREIGN KEY(accountID) REFERENCES account(accountID) ON DELETE CASCADE
    );

CREATE TABLE businessAccount( 
      businessAcocuntID INT PRIMARY KEY AUTO_INCREMENT,
      transactionFee DECIMAL(10, 2) NOT NULL,
       accountID INT,
      FOREIGN KEY(accountID) REFERENCES account(accountID) ON DELETE CASCADE
    );