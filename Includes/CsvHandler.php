<?php
interface ICsvHandler
{
    public function GetAllRecords($filePath);
}

class CsvHandler implements ICsvHandler
{
    public function GetAllRecords($filePath)
    {
        $handle = fopen($filePath, "r");
        $rows = [];

        // Add each row to rows
        while($row = fgetcsv($handle, 0, ",", "\""))
        {
            $rows[] = $row;
        }

        fclose($handle);
        return $rows;
    }
}
?>
