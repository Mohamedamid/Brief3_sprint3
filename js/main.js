document.getElementById("type_account").addEventListener("change", function() {

    const accountType = this.value;

    const overdraftLimit = document.querySelector(".overdraftLimit1");
    const interestRate = document.querySelector(".interestRate1");
    const transactionFee = document.querySelector(".transactionFee1");

    // Hide all fields initially
    overdraftLimit.style.display = "none";
    interestRate.style.display = "none";
    transactionFee.style.display = "none";

    // Show relevant fields based on account type
    if (accountType === "currentaccount") {
        overdraftLimit.style.display = "block"; 
    } else if (accountType === "savingaccount") {
        interestRate.style.display = "block";  
    } else if (accountType === "businessaccount") {
        transactionFee.style.display = "block"; 
    }
});