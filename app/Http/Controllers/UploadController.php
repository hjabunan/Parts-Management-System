<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Parts;
use App\Models\PBrands;
use Egulias\EmailValidator\Parser\PartParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    // public function upload(Request $request){
    //     $file = $request->file('csv_file');

    //     if ($file) {
    //         $path = $file->getRealPath();
    //         $data = array_map('str_getcsv', file($path));
            
    //         foreach ($data as $row) {
    //             $uniqueIdentifier = $row[0];
                
    //             $existingRecord = Parts::where('itemno', $uniqueIdentifier)->first();
    //             $maxID = Parts::select('id')->max('id');
    //             $brand = PBrands::select('id')->where('name',$row[3])->first();
                
    //             if ($existingRecord) {
    //                 $existingRecord->update([
    //                     'partno' => $row[1],
    //                     'partname' => $row[2],
    //                     'brand' => $brand->id,
    //                     'price' => $row[4],
    //                     'status' => ($row[5] == "INACTIVE") ? 0 : 1,
    //                     'updated_at' => date("Y-m-d H:i:s", strtotime($row[6])),
    //                 ]);
    //             } else {
    //                 Parts::create([
    //                     'id' => $maxID,
    //                     'itemno' => $row[0],
    //                     'partno' => $row[1],
    //                     'partname' => $row[2],
    //                     'brand' => $brand->id,
    //                     'price' => $row[4],
    //                     'status' => ($row[5] == "INACTIVE") ? 0 : 1,
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ]);
    //             }
    //         }
    //         return redirect()->back()->with('success', 'CSV file uploaded and data updated/inserted successfully.');
    //     }
    //     return redirect()->back()->with('error', 'No file selected.');
    // }

    public function upload(Request $request){
        $file = $request->file('csv_file');
    
        if ($file) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
    
            foreach ($data as $row) {
                $uniqueIdentifier = $row[0];
    
                $existingRecord = Parts::where('itemno', $uniqueIdentifier)->first();
                $maxID = Parts::select('id')->max('id');
                $brand = PBrands::select('id')->where('name',$row[3])->first();
                if (!$brand) {
                    continue;
                }
    
                if ($existingRecord) {
                    $dirtyAttributes = [];
    
                    // Check and record changes for each field
                    if ($existingRecord->partno !== $row[1]) {
                        $dirtyAttributes['partno'] = $existingRecord->partno;
                    }
                    if ($existingRecord->partname !== $row[2]) {
                        $dirtyAttributes['partname'] = $existingRecord->partname;
                    }
                    if ($existingRecord->brand !== $brand->id) {
                        $dirtyAttributes['brand'] = $existingRecord->brand;
                    }
                    if ($existingRecord->price !== $row[4]) {
                        $dirtyAttributes['price'] = $existingRecord->price;
                    }
                    $status = ($row[5] == "INACTIVE") ? 0 : 1;
                    if ($existingRecord->status !== $status) {
                        $dirtyAttributes['status'] = $existingRecord->status;
                    }
                    $updatedAt = date("Y-m-d H:i:s", strtotime($row[6]));
                    if ($existingRecord->updated_at !== $updatedAt) {
                        $dirtyAttributes['updated_at'] = $existingRecord->updated_at;
                    }
                    
                    // Update the record if there are changes
                    if (!empty($dirtyAttributes)) {
                        $existingRecord->update([
                            'partno' => $row[1],
                            'partname' => $row[2],
                            'brand' => $brand->id,
                            'price' => $row[4],
                            'status' => $status,
                            'updated_at' => $updatedAt,
                        ]);
    
                        // Log only the fields that were updated
                        foreach ($dirtyAttributes as $attribute => $oldValue) {
                            $newValue = $existingRecord->$attribute;
                            $field = ucwords(str_replace('_', ' ', $attribute));
        
                            $newLog = new ActivityLog();
                            $newLog->table = 'PartTable';
                            $newLog->table_key = $existingRecord->id;
                            $newLog->action = 'UPDATE';
                            $newLog->description = $existingRecord->itemno;
                            $newLog->field = $field;
                            $newLog->before = $oldValue;
                            $newLog->after = $newValue;
                            $newLog->user_id = Auth::user()->id;
                            $newLog->ipaddress = request()->ip();
                            $newLog->save();
                        }
                    }
                } else {
                    $newPart = Parts::create([
                        'id' => $maxID,
                        'itemno' => $row[0],
                        'partno' => $row[1],
                        'partname' => $row[2],
                        'brand' => $brand->id,
                        'price' => $row[4],
                        'status' => ($row[5] == "INACTIVE") ? 0 : 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
    
                    // Log the creation for each field
                    $fieldNames = ['itemno', 'partno', 'partname', 'brand', 'price', 'status'];
                    foreach ($fieldNames as $fieldName) {
                        $fieldLabel = ucwords(str_replace('_', ' ', $fieldName));
                        $fieldValue = $newPart->$fieldName;

                        $newLog = new ActivityLog();
                        $newLog->table = 'PartTable';
                        $newLog->table_key = $newPart->id;
                        $newLog->action = 'ADD';
                        $newLog->description = $newPart->itemno;
                        $newLog->field = $fieldLabel;
                        $newLog->before = null;
                        $newLog->after = $fieldValue;
                        $newLog->user_id = Auth::user()->id;
                        $newLog->ipaddress = request()->ip();
                        $newLog->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'CSV file uploaded, and data updated/inserted successfully.');
        }
        return redirect()->back()->with('error', 'No file selected.');
    }
}
