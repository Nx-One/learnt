<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class UserImportController extends Controller
{
    public function import(Request $request)
    {
        // Validate file upload
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls,txt',
        ]);

        try {
            // Import the data from the file
            $result = Excel::import(new UsersImport, $request->file('file'));

            // Check the result and return appropriate feedback
            // You can send the $result array from UsersImport as feedback
            $successMessage = "Users imported successfully. {$result['success']} users added.";
            if ($result['failed'] > 0) {
                $failureMessage = "{$result['failed']} user(s) failed to import.";
                // Combine success and failure messages
                $message = $successMessage . ' ' . $failureMessage;
            } else {
                $message = $successMessage;
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            // Log the error and return a failure message
            return redirect()->back()->with('error', 'There was an issue with the import. Please try again.');
        }
    }
}
