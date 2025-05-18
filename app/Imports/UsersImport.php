<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Role;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    *
    * @return mixed
    */
    public function collection(Collection $rows)
    {
        $result = [
            'success' => 0,
            'failed' => 0,
            'errors' => [],
        ];

        foreach ($rows as $row) {
            try {
                $name = $row['name'];
                $nisn = $row['nisn'];
                $email = $row['email'];
                $password = $row['password'];
                $role_id = $row['role_id'];

                // Handle the case where the role does not exist
                $role = Role::where('id', $role_id)->first();
                if (!$role) {
                    $result['failed']++;
                    $result['errors'][] = "Role with ID $role_id not found for NISN: $nisn";
                    continue; // Skip this row
                }

                // Check if the user already exists by email
                $existingUser = User::where('email', $email)->first();
                if ($existingUser) {
                    $existingUser->name = $name;
                    $existingUser->nisn = $nisn;
                    $existingUser->password = Hash::make($password);
                    $existingUser->save();
                    $existingUser->roles()->sync([$role_id]); // Sync the role
                    $result['success']++;
                } else {
                    // Check if the NISN already exists
                    $existingUserByNisn = User::where('nisn', $nisn)->first();
                    if ($existingUserByNisn) {
                        $existingUserByNisn->name = $name;
                        $existingUserByNisn->email = $email;
                        $existingUserByNisn->password = Hash::make($password);
                        $existingUserByNisn->save();
                        $existingUserByNisn->roles()->sync([$role_id]);
                        $result['success']++;
                    } else {
                        // Create a new user if no match found
                        $user = User::create([
                            'name' => $name,
                            'nisn' => $nisn,
                            'email' => $email,
                            'password' => Hash::make($password),
                        ]);
                        // Assign the role to the new user
                        $user->roles()->attach($role->id);
                        $result['success']++;
                    }
                }
            } catch (\Exception $e) {
                // Log the error and update failed counter
                Log::error("Error processing row: " . $e->getMessage(), [
                    'row' => $row,
                ]);
                $result['failed']++;
                $result['errors'][] = "Error processing NISN: $nisn, Error: " . $e->getMessage();
            }
        }

        // Return the result after processing all rows
        return $result;
    }
}
