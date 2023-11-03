<?php
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel{
    function loadOrderSheetXlsxToArray($inputFileName, $sheetname, $type){
        $inputFileType = $type;
        
        $reader = IOFactory::createReader($inputFileType);
        $reader->setLoadSheetsOnly($sheetname);
        $spreadsheet = $reader->load($inputFileName);
        
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        return $sheetData;
    }

    function saveOrderSheetXlsx($sheetData, $outPath){
        $spreadsheet = new Spreadsheet();

        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->fromArray($sheetData);
        $writer = new Xlsx($spreadsheet);

        $writer->save($outPath);
    }
}
?>