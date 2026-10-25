 <?php

 
function calculateDeposit($balance, $amount)
{
    return $balance + $amount;
}


function calculateWithdrawal($balance, $amount)
{
    return $balance - $amount;
}


 
function calculateTransactionFee($transaction, $amount)
{
    if ($transaction == "Deposit") {
        return 0;
    }
    elseif ($transaction == "Withdrawal" && $amount < 500) {
        return 2;
    }
    elseif ($transaction == "Withdrawal" && $amount >= 500) {
        return 5;
    }
    else {
        return 0;
    }
}



function calculateInterest($balance, $type, $years)
{
    if ($type == "Savings") {
        $rate = 0.03;
    }
    elseif ($type == "Current") {
        $rate = 0.05;
    }
    elseif ($type == "Business") {
        $rate = 0.02;
    }
    else {
        $rate = 0;
    }

    return $balance * $rate * $years;
}


 
function calculateTotalCharges($fee)
{
    return $fee;
}


function calculateFinalBalance(
    $balance,
    $amount,
    $transaction,
    $charges
) {
    if ($transaction == "Deposit") {
        return $balance + $amount - $charges;
    }
    else {
        return $balance - $amount - $charges;
    }
}


 
function checkAccountStatus($balance)
{
    if ($balance >= 5000) {
        return "High Balance";
    }
    elseif ($balance >= 1000) {
        return "Medium Balance";
    }
    else {
        return "Low Balance";
    }
}


function calculateFutureBalance($balance, $type, $years = 1)
{
    $interest = calculateInterest($balance, $type, $years);

    return $balance + $interest;
}

?>