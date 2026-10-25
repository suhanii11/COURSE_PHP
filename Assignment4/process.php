 <?php

require_once "functions.php";
 
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$account = isset($_POST["account"]) ? $_POST["account"] : "";
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$type = isset($_POST["type"]) ? $_POST["type"] : "";
$balance = isset($_POST["balance"]) ? $_POST["balance"] : "";
$transaction = isset($_POST["transaction"]) ? $_POST["transaction"] : "";
$amount = isset($_POST["amount"]) ? $_POST["amount"] : "";
$years = isset($_POST["years"]) ? $_POST["years"] : "";

$fileName = isset($_FILES["document"]["name"])
    ? $_FILES["document"]["name"] : "";

$fileSize = isset($_FILES["document"]["size"])
    ? $_FILES["document"]["size"] : 0;

$fileType = isset($_FILES["document"]["type"])
    ? $_FILES["document"]["type"] : "";

$tempName = isset($_FILES["document"]["tmp_name"])
    ? $_FILES["document"]["tmp_name"] : "";

$fileError = isset($_FILES["document"]["error"])
    ? $_FILES["document"]["error"] : 4;


$errors = "";


if (empty($name)) {
    $errors .= "<li>Customer name is required.</li>";
}
elseif (strspn(
    $name,
    "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ "
) != strlen($name)) {
    $errors .= "<li>Name must contain letters and spaces only.</li>";
}



if (empty($account)) {
    $errors .= "<li>Account number is required.</li>";
}


 
if (empty($gender)) {
    $errors .= "<li>Please select gender.</li>";
}


if (empty($type)) {
    $errors .= "<li>Please select account type.</li>";
}
elseif (
    $type != "Savings" &&
    $type != "Current" &&
    $type != "Business"
) {
    $errors .= "<li>Invalid account type.</li>";
}



if ($balance === "") {
    $errors .= "<li>Opening balance is required.</li>";
}
elseif ($balance < 0) {
    $errors .= "<li>Opening balance cannot be negative.</li>";
}


 
if (empty($transaction)) {
    $errors .= "<li>Please select transaction type.</li>";
}
elseif (
    $transaction != "Deposit" &&
    $transaction != "Withdrawal"
) {
    $errors .= "<li>Invalid transaction type.</li>";
}


 
if ($amount === "") {
    $errors .= "<li>Transaction amount is required.</li>";
}
elseif ($amount <= 0) {
    $errors .= "<li>Amount must be greater than zero.</li>";
}


if ($years === "") {
    $errors .= "<li>Account duration is required.</li>";
}
elseif ($years < 0 || $years != floor($years)) {
    $errors .= "<li>Duration must be a whole number of years.</li>";
}


if ($fileError == 4 || empty($fileName)) {
    $errors .= "<li>Please select an identification document.</li>";
}
elseif ($fileError != 0) {
    $errors .= "<li>There was a problem uploading the document.</li>";
}
elseif ($fileSize > 2097152) {
    $errors .= "<li>File size must not exceed 2 MB.</li>";
}

 
$fee = 0;

if (
    !empty($transaction) &&
    $amount !== "" &&
    $amount > 0
) {
    $fee = calculateTransactionFee($transaction, $amount);
}


 
if (
    $transaction == "Withdrawal" &&
    $balance !== "" &&
    $amount !== "" &&
    $amount > 0 &&
    $balance >= 0
) {
    if ($amount + $fee > $balance) {
        $errors .= "<li>Withdrawal amount and fee exceed the opening balance.</li>";
    }
}


 
$destination = "uploads/" . $fileName;

if (
    $fileError == 0 &&
    !empty($fileName) &&
    file_exists($destination)
) {
    $errors .= "<li>A file with this name already exists. Rename your file.</li>";
}


 
if (!empty($errors)) {

    echo "<h2>Please correct the following errors:</h2>";

    echo "<ul>";
    echo $errors;
    echo "</ul>";

    echo '<a href="index.html">Back to Banking Form</a>';

    exit;
}


if (
    !move_uploaded_file($tempName, $destination)
) {
    echo "<h2>Document upload failed.</h2>";

    echo '<a href="index.html">Back to Banking Form</a>';

    exit;
}



if ($transaction == "Deposit") {

    $transactionBalance = calculateDeposit(
        $balance,
        $amount
    );

}
else {

    $transactionBalance = calculateWithdrawal(
        $balance,
        $amount
    );

}


$totalCharges = calculateTotalCharges($fee);


 
$finalBalance = calculateFinalBalance(
    $balance,
    $amount,
    $transaction,
    $totalCharges
);


$interest = calculateInterest(
    $finalBalance,
    $type,
    $years
);


 
$futureBalance = calculateFutureBalance(
    $finalBalance,
    $type,
    $years
);


 
$status = checkAccountStatus($finalBalance);


 
if ($type == "Savings") {
    $rate = "3%";
}
elseif ($type == "Current") {
    $rate = "5%";
}
else {
    $rate = "2%";
}

?>


<!DOCTYPE html>
<html>
<head>

    <title>Banking Transaction Receipt</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            background-color: white;
            width: 85%;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: darkblue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid gray;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: darkblue;
            color: white;
        }

        .success {
            color: green;
        }
    </style>

</head>

<body>

<div class="container">

    <h2>Banking Transaction Receipt</h2>

    <p class="success">
        Transaction completed successfully.
    </p>

    <p>
        This is a practice simulation. No real banking transaction
        has been processed.
    </p>

    <table>

        <tr>
            <th>Banking Information</th>
            <th>Result</th>
        </tr>

        <tr>
            <td>Customer Full Name</td>
            <td><?php echo $name; ?></td>
        </tr>

        <tr>
            <td>Account Number</td>
            <td><?php echo $account; ?></td>
        </tr>

        <tr>
            <td>Gender</td>
            <td><?php echo $gender; ?></td>
        </tr>

        <tr>
            <td>Account Type</td>
            <td><?php echo $type; ?></td>
        </tr>

        <tr>
            <td>Opening Balance</td>
            <td>$<?php echo number_format($balance, 2); ?></td>
        </tr>

        <tr>
            <td>Transaction Type</td>
            <td><?php echo $transaction; ?></td>
        </tr>

        <tr>
            <td>Transaction Amount</td>
            <td>$<?php echo number_format($amount, 2); ?></td>
        </tr>

        <tr>
            <td>Balance After Transaction Before Charges</td>
            <td>$<?php echo number_format($transactionBalance, 2); ?></td>
        </tr>

        <tr>
            <td>Transaction Fee</td>
            <td>$<?php echo number_format($fee, 2); ?></td>
        </tr>

        <tr>
            <td>Total Banking Charges</td>
            <td>$<?php echo number_format($totalCharges, 2); ?></td>
        </tr>

        <tr>
            <td>Final Balance</td>
            <td>$<?php echo number_format($finalBalance, 2); ?></td>
        </tr>

        <tr>
            <td>Account Status</td>
            <td><?php echo $status; ?></td>
        </tr>

        <tr>
            <td>Account Duration</td>
            <td><?php echo $years; ?> year(s)</td>
        </tr>

        <tr>
            <td>Annual Interest Rate</td>
            <td><?php echo $rate; ?></td>
        </tr>

        <tr>
            <td>Calculated Interest</td>
            <td>$<?php echo number_format($interest, 2); ?></td>
        </tr>

        <tr>
            <td>Projected Future Balance</td>
            <td>$<?php echo number_format($futureBalance, 2); ?></td>
        </tr>

        <tr>
            <td>Document Name</td>
            <td><?php echo $fileName; ?></td>
        </tr>

        <tr>
            <td>File Type</td>
            <td><?php echo $fileType; ?></td>
        </tr>

        <tr>
            <td>File Size</td>
            <td><?php echo $fileSize; ?> bytes</td>
        </tr>

        <tr>
            <td>Temporary Filename</td>
            <td><?php echo $tempName; ?></td>
        </tr>

        <tr>
            <td>Upload Status</td>
            <td class="success">Successful</td>
        </tr>

    </table>

    <br>

    <a href="index.html">Back to Banking Form</a>

</div>

</body>
</html>