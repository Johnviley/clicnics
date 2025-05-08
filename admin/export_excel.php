<?php
session_start();

// Check admin login
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
    header("Location: ../login.php");
    exit();
}

include("../connection.php");


$months = [
    'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
    'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
    'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
];

// Fetch data
$sql = "SELECT name, expdate, quantity, date FROM inventory";
$result = $database->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $expdate = trim($row["expdate"]);
        $quantity = (int)$row["quantity"];
        $month = date("F", strtotime($row["date"]));
        $key = $name . '|' . $expdate;

        if (!isset($data[$key])) {
            $data[$key] = [
                'name' => $name,
                'expdate' => $expdate,
                'months' => array_fill_keys(array_keys($months), 0)
            ];
        }

        $data[$key]['months'][$month] += $quantity;
    }
}

// Force download as Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=inventory_report.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr><th>NAME OF MEDICINE</th><th>EXPIRATION DATE</th>";

foreach ($months as $month => $num) {
    echo "<th>$month</th>";
}

echo "<th>REMARKS</th>"; // REMARKS column at the end
echo "</tr>";

foreach ($data as $entry) {
    $name = $entry['name'];

    $sqlmainexpdate = "SELECT expdate FROM history WHERE name='$name';";
    $expdateResult = $database->query($sqlmainexpdate);
    $expdateList = [];

    if ($expdateResult->num_rows > 0) {
        while ($rowexpdate = $expdateResult->fetch_assoc()) {
            $expdateFormatted = "'" . date("F j, Y", strtotime($rowexpdate["expdate"]));
            $expdateList[] = $expdateFormatted;
        }
        $expdateDisplay = implode("/", $expdateList);
    } else {
        $expdateDisplay = "No Expiry Date";
    }

    echo "<tr style='text-align: center;'>";
    echo "<td style='padding: 8px; font-weight: 600;'>" . htmlspecialchars($entry['name']) . "</td>";
    echo "<td style='padding: 8px; font-weight: 600;'>" . htmlspecialchars($expdateDisplay) . "</td>";

    foreach ($months as $month => $num) {
        $qty = $entry['months'][$month] ?: '';
        echo "<td style='padding: 8px;'>$qty</td>";
    }

    echo "<td style='padding: 8px;'></td>"; // Empty REMARKS cell at the end
    echo "</tr>";
}
echo "</table>";

exit();
?>