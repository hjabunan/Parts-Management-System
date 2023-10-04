<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Parts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartsController extends Controller
{
    public function getParts(Request $request){
        $part = DB::table('parts')
                    ->select('parts.id','parts.itemno','parts.partno','parts.partname','parts.brand','parts.price','parts.status')
                    ->leftJoin('parts_brands','parts.brand','parts_brands.id')
                    ->where('parts.id',$request->id)->first();

        $result = array(
            'PartID' => $part->id, 
            'PartINum' => $part->itemno, 
            'PartName' => $part->partname, 
            'PartNum' => $part->partno, 
            'PartBrand' => $part->brand, 
            'PartPrice' => $part->price, 
            'PartStatus' => $part->status, 
        );
        
        return json_encode($result);
    }

    public function saveParts(Request $request){
        if($request->PartID == ""){
            $part = new Parts();
            $part->itemno = $request->PartINum;
            $part->partno = $request->PartNum;
            $part->partname = $request->PartName;
            $part->brand = $request->PartBrand;
            $part->price = $request->PartPrice;
            $part->status = $request->PartStatus;
            $part->is_deleted = 0;
                $dirtyAttributes = $part->getDirty();
            $part->save();
            
            
                foreach($dirtyAttributes as $attribute => $newValue){
                    $oldValue = $part->getOriginal($attribute);
        
                    $field = ucwords(str_replace('_', ' ', $attribute));

                    $newLog = new ActivityLog();
                    $newLog->table = 'PartTable';
                    $newLog->table_key = $part->id;
                    $newLog->action = 'ADD';
                    $newLog->description = $part->itemno;
                    $newLog->field = $field;
                    $newLog->before = $oldValue;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress =  request()->ip();
                    $newLog->save();
                }

            return response()->json(['message' => 'New record added']);
        }else{
            $part = Parts::find($request->PartID);
            $part->itemno = $request->PartINum;
            $part->partno = $request->PartNum;
            $part->partname = $request->PartName;
            $part->brand = $request->PartBrand;
            $part->price = $request->PartPrice;
            $part->status = $request->PartStatus;
            
                $dirtyAttributes = $part->getDirty();
            
                foreach($dirtyAttributes as $attribute => $newValue){
                    $oldValue = $part->getOriginal($attribute);
        
                    $field = ucwords(str_replace('_', ' ', $attribute));

                    $newLog = new ActivityLog();
                    $newLog->table = 'PartTable';
                    $newLog->table_key = $request->PartID;
                    $newLog->action = 'UPDATE';
                    $newLog->description = $part->itemno;
                    $newLog->field = $field;
                    $newLog->before = $oldValue;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress =  request()->ip();
                    $newLog->save();
                }

            $part->update();
            return response()->json(['message' => 'Record updated']);
        }

        // $result = "";
            // $parts = DB::table('parts')
            //             ->select('parts.id','parts.partno','parts.partname','parts_brands.name','parts.price','parts.status','parts.is_deleted')
            //             ->leftJoin('parts_brands','parts.brand','parts_brands.id')
            //             ->where('parts.is_deleted','0')->get();
            
            // if(count($parts)>0){
            //     foreach ($parts as $part) {
            //         if($part->status == 0){
            //             $status = 'INACTIVE';
            //         }else{
            //             $status = 'ACTIVE';
            //         }

            //         $result .= '
            //             <tr class="bg-white border-b hover:bg-gray-50">
            //                 <td class="px-2 py-1">
            //                     '.$part->id.'
            //                 </td>
            //                 <td class="px-2 py-1 w-40">
            //                     '.$part->partno.'
            //                 </td>
            //                 <td class="text-xs px-2 py-1">
            //                     '.$part->partname.'
            //                 </td>
            //                 <td class="px-2 py-1">
            //                     '.$part->name.'
            //                 </td>
            //                 <td class="px-2 py-1">
            //                     '.$part->price.'
            //                 </td>
            //                 <td class="px-2 py-1">
            //                     '.$status.'
            //                 </td>
            //                 <td class="px-2 py-1">
            //                     <button type="button" data-id="'.$part->id.'" class="btnPartView" id="btnPartView"><svg fill="#000000" viewBox="-3.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"> <path d="M12.406 13.844c1.188 0 2.156 0.969 2.156 2.156s-0.969 2.125-2.156 2.125-2.125-0.938-2.125-2.125 0.938-2.156 2.125-2.156zM12.406 8.531c7.063 0 12.156 6.625 12.156 6.625 0.344 0.438 0.344 1.219 0 1.656 0 0-5.094 6.625-12.156 6.625s-12.156-6.625-12.156-6.625c-0.344-0.438-0.344-1.219 0-1.656 0 0 5.094-6.625 12.156-6.625zM12.406 21.344c2.938 0 5.344-2.406 5.344-5.344s-2.406-5.344-5.344-5.344-5.344 2.406-5.344 5.344 2.406 5.344 5.344 5.344z"></path></svg></button>
            //                     <button type="button" data-id="'.$part->id.'" class="btnPartEdit" id="btnPartEdit"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
            //                     <button type="button" data-id="'.$part->id.'" class="btnPOUDelete" id="btnPOUDelete"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M779.5 1002.7h-535c-64.3 0-116.5-52.3-116.5-116.5V170.7h768v715.5c0 64.2-52.3 116.5-116.5 116.5zM213.3 256v630.1c0 17.2 14 31.2 31.2 31.2h534.9c17.2 0 31.2-14 31.2-31.2V256H213.3z" fill="#ff3838"/><path d="M917.3 256H106.7C83.1 256 64 236.9 64 213.3s19.1-42.7 42.7-42.7h810.7c23.6 0 42.7 19.1 42.7 42.7S940.9 256 917.3 256zM618.7 128H405.3c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7h213.3c23.6 0 42.7 19.1 42.7 42.7S642.2 128 618.7 128zM405.3 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7S448 403 448 426.6v256c0 23.6-19.1 42.7-42.7 42.7zM618.7 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v256c-0.1 23.6-19.2 42.7-42.7 42.7z" fill="#5F6379"/></svg></button>
            //                 </td>
            //             </tr>
            //         ';
            //     }
        // };

    }

    public function deleteParts(Request $request){
        $part = Parts::find($request->id);
        $part->is_deleted = 1;
            
            $dirtyAttributes = $part->getDirty();
        
            foreach($dirtyAttributes as $attribute => $newValue){
                $oldValue = $part->getOriginal($attribute);

                $field = ucwords(str_replace('_', ' ', $attribute));

                $newLog = new ActivityLog();
                $newLog->table = 'PartTable';
                $newLog->table_key = $request->id;
                $newLog->action = 'DELETE';
                $newLog->description = $part->id;
                $newLog->field = $field;
                $newLog->before = $oldValue;
                $newLog->after = $newValue;
                $newLog->user_id = Auth::user()->id;
                $newLog->ipaddress =  request()->ip();
                $newLog->save();
            }

        $part->update();

        return response()->json(['message' => 'Record updated']);
    }

    public function search (Request $request){
        $query = $request->input('searchText');

        $parts = Parts::where('partname', 'like', '%' . $query . '%')
                    ->orWhere('partno', 'like', '%' . $query . '%')
                    ->orWhere('itemno', 'like', '%' . $query . '%')
                    ->paginate(25);

        $brands = DB::table('parts_brands')->get();    
        
        $tbody = view('partials', compact('parts'))->render();
        $pagination = $parts->links()->toHtml();
    
        return response()->json(['body' => $tbody, 'pagination' => $pagination]);
    }
}
