<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risks;
use Carbon\Carbon;

class ExtractController extends Controller
{
//NEW RISKS EXTRACT TO EXCEL
public function filter(Request $request)
{
    if ($request->query('action') === 'extract') {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $endDatePlusOne = date('Y-m-d', strtotime($endDate . ' +1 day'));

        $data = Risks::join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
            ->where('Risks.Date_Time', '>=', $startDate)
            ->where('Risks.Date_Time', '<', $endDatePlusOne)
            ->select('Risks.*', 'Treatment_Data.Activity', 'Treatment_Data.Action_Owner_Name', 'Treatment_Data.Status')
            ->get();

        $filename = 'extracted_data_' . date('YmdHis') . '.csv';

        $output = fopen($filename, 'w');
        $excludedFields = [
            'Company_Id', 'Department_Id', 'Division_Id', 'Owner_Username', 'Risk_Division_Name',
            'Risk_Division_Id', 'Acceptance', 'File_Name', 'File_Path', 'Request_Status',
            'Created_Username', 'Request_Type', 'Email_Status'
        ];
        $headerKeys = array_diff(array_keys($data[0]->toArray()), $excludedFields);

        fputcsv($output, $headerKeys);
        foreach ($data as $row) {
            $rowData = array_diff_key($row->toArray(), array_flip($excludedFields));
            fputcsv($output, $rowData);
        }

        fclose($output);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        readfile($filename);
        unlink($filename);

        exit;
    }
}
//CLOSED RISKS EXTRACT TO EXCEL 
public function filterClosedRisk(Request $request)
  {
    if ($request->query('action') === 'extract') {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $endDatePlusOne = date('Y-m-d', strtotime($endDate . ' +1 day'));

        $data = Risks::join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
            ->where('Risks.Date_Time', '>=', $startDate)
            ->where('Risks.Date_Time', '<', $endDatePlusOne)
            ->select('Risks.*', 'Treatment_Data.Activity', 'Treatment_Data.Action_Owner_Name', 'Treatment_Data.Status')
            ->get();

        $filename = 'extracted_data_' . date('YmdHis') . '.csv';

        $output = fopen($filename, 'w');
        $excludedFields = [
            'Company_Id', 'Department_Id', 'Division_Id', 'Owner_Username', 'Risk_Division_Name',
            'Risk_Division_Id', 'Acceptance', 'File_Name', 'File_Path', 'Request_Status',
            'Created_Username', 'Request_Type', 'Email_Status'
        ];
        $headerKeys = array_diff(array_keys($data[0]->toArray()), $excludedFields);

        fputcsv($output, $headerKeys);
        foreach ($data as $row) {
            $rowData = array_diff_key($row->toArray(), array_flip($excludedFields));
            fputcsv($output, $rowData);
        }

        fclose($output);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        readfile($filename);
        unlink($filename);

        exit;
    }
  }
//NOT ATTENDED EXTRACT EXCEL SHEET
public function FilterNotAttendedRisk(Request $request)
  {
    if ($request->query('action') === 'extract') {
        $startDate = $request->query('start_date_1');
        $endDate = $request->query('end_date_1');

        $endDatePlusOne = date('Y-m-d', strtotime($endDate . ' +1 day'));

        $data = Risks::join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
            ->where('Risks.Date_Time', '>=', $startDate)
            ->where('Risks.Date_Time', '<', $endDatePlusOne)
            ->select('Risks.*', 'Treatment_Data.Activity', 'Treatment_Data.Action_Owner_Name', 'Treatment_Data.Status')
            ->get();

        $filename = 'extracted_data_' . date('YmdHis') . '.csv';

        $output = fopen($filename, 'w');
        $excludedFields = [
            'Company_Id', 'Department_Id', 'Division_Id', 'Owner_Username', 'Risk_Division_Name',
            'Risk_Division_Id', 'Acceptance', 'File_Name', 'File_Path', 'Request_Status',
            'Created_Username', 'Request_Type', 'Email_Status'
        ];
        $headerKeys = array_diff(array_keys($data[0]->toArray()), $excludedFields);

        fputcsv($output, $headerKeys);
        foreach ($data as $row) {
            $rowData = array_diff_key($row->toArray(), array_flip($excludedFields));
            fputcsv($output, $rowData);
        }

        fclose($output);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        readfile($filename);
        unlink($filename);

        exit;
    }
  }
}