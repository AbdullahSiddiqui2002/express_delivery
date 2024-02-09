<?php
require 'vendor/autoload.php'; // Adjust the path to autoload.php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

session_start();
if(isset($_SESSION['email'])){

    if($_GET['parcel_status'] && $_GET['from_date'] && $_GET['to_date'] && $_GET['agent_id']){

require("../../include/connection.php");


$agent_id= $_GET['agent_id'];
$parcel_status=$_GET['parcel_status'];
$from_date=$_GET['from_date'];
$to_date=$_GET['to_date'];
if($_GET['parcel_status'] == "5"){
    $status_show = "Unsuccessful Delivery Attempt";
}
elseif($_GET['parcel_status'] == "1"){
    $status_show = "Item Accepted by Courier";
}
elseif($_GET['parcel_status'] == "2"){
    $status_show = "Collected";
}
elseif($_GET['parcel_status'] == "3"){
    $status_show = "Shipped";
}
elseif($_GET['parcel_status'] == "4"){
    $status_show = "Delivered";
}
else{
    $status_show = "All";
}


$sql = "SELECT * FROM parcel WHERE `agent_id` = '$agent_id' AND date(date_created) BETWEEN '$from_date' AND '$to_date'" . ($parcel_status != 'ALL' ? " AND parcel_status = $parcel_status" : "") . " ORDER BY unix_timestamp(date_created) ASC;";
$status_arr = array("All","Item Accepted by Courier","Collected","Shipped","Delivered","Unsuccessfull Delivery Attempt");
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set title
    $sheet->setCellValue('A1', 'Report');
    $sheet->mergeCells('A1:F1');
    $sheet->getStyle('A1:F1')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getRowDimension(1)->setRowHeight(30);

    $sheet->mergeCells('A2:F2');

    $sheet->setCellValue('A3', 'Range: ' . $from_date . ' to ' . $to_date);
    $sheet->mergeCells('A3:F3');
    $sheet->getStyle('A3:F3')->getFont()->setSize(12);
    $sheet->getRowDimension(1)->setRowHeight(30);

    $sheet->mergeCells('A4:F4');

    $sheet->setCellValue('A5', 'Status: ' . $status_show);
    $sheet->mergeCells('A5:F5');
    $sheet->getStyle('A5:F5')->getFont()->setSize(12);
    $sheet->getRowDimension(1)->setRowHeight(30);

    // Set column headers
    $sheet->setCellValue('A7', '#');
    $sheet->setCellValue('B7', 'Date');
    $sheet->setCellValue('C7', 'Sender');
    $sheet->setCellValue('D7', 'Recepient');
    $sheet->setCellValue('E7', 'Amount');
    $sheet->setCellValue('F7', 'Status');

    // Style headers
    $headerStyle = [
        'font' => ['bold' => true],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'CCCCCC']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    ];
    $sheet->getStyle('A7:F7')->applyFromArray($headerStyle);

    // Set data starting row
    $row = 8;
    $i=1;
    while ($row_data = $result->fetch_assoc()) {
        $sender_name = $row_data["sender_name"];
        $recipient_name = $row_data["recipient_name"];
        $date_created = date("M d, Y",strtotime($row_data["date_created"]));
        $status = $status_arr[$row_data["parcel_status"]];
        $amount = number_format($row_data["amount"]);

        $sheet->setCellValue('A' . $row, $i);
        $sheet->setCellValue('B' . $row, $date_created);
        $sheet->setCellValue('C' . $row, $sender_name);
        $sheet->setCellValue('D' . $row, $recipient_name);
        $sheet->setCellValue('E' . $row, $amount);
        $sheet->setCellValue('F' . $row, $status);

        foreach (range('A', 'F') as $columnID) {
            $sheet->getStyle($columnID . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        $row++;
        $i++;
    }

    // Auto-size columns
    foreach(range('A', 'F') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
        // $sheet->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="report.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
} else {
    echo "0 results";
}

$connection->close();

}
else{
    echo "<script>alert('Please select the dates')
                      window.location.href = 'reports.php'
                      </script>";
}
}
else{
    header("location: login.php");
}
?>
