<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLog extends Controller
{
    public function getLogs(Request $request){
        $activity = DB::table('pms_activity_logs')
        ->select('table', 'table_key', 'action', 'description', 'field', 'before', 'after', 'name', 'ipaddress','pms_activity_logs.created_at','pms_activity_logs.updated_at')
        ->leftJoin('pms_users', 'pms_activity_logs.user_id', 'pms_users.id')
        ->where('table_key',$request->tableKey)
        ->orderBy('pms_activity_logs.created_at', 'desc') 
        ->get();

        $result = '';
        $content = '';

        $x = 1;
        foreach ($activity as $act) {
            $ndate = $act->created_at;
            if ($x == 1) {
                $cdate = $act->created_at;
            }

            if ($ndate == $cdate) {
                if($act->field == 'Itemno'){
                    $label = "Item Number";
                }else if($act->field == 'Partno'){
                    $label = "Part Number";
                }else if($act->field == 'Partname'){
                    $label = "Part Name";
                }else{
                    $label = $act->field;
                }

                if($act->action == "ADD"){
                    $additionalClass = "bg-blue-300";
                    if($act->field != 'Is Deleted'){
                        if($act->field == "Status"){
                            if($act->after == 0){
                                $value = "INACTIVE";
                            }else{
                                $value = "ACTIVE";
                            }
                        }else{
                            $value = $act->after;
                        }
                        $content .= '
                                    <div>
                                        <div class="">'.$label.': '.$value.' </div>
                                    </div>
                        ';
                    }
                }else if($act->action == "UPDATE"){
                    $additionalClass = "bg-green-300";
                    $content .= '
                                <div>
                                    <div class="">'.$label.': '.$act->before.' ⇒ '.$act->after.'</div>
                                </div>
                    ';
                }else{
                    $additionalClass = "bg-red-300";
                    $content .= 'Deleted.';
                }
                
                $action = $act->action;
            }
            if($ndate != $cdate || $x == $activity->count()){
                $result .='
                            <li class="mb-10 ml-6">
                                    <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" id="user">
                                            <path fill="#C4E6FF" fill-rule="evenodd" d="M3 20C3 16.8289 5.10851 14.1503 8 13.2898V18C8 18.5522 8.44772 19 9 19C11.1785 19 20.9291 19 20.9291 19C20.9758 19.3266 21 19.6604 21 20C21 21.6568 19.6569 23 18 23H6C4.34315 23 3 21.6568 3 20Z" clip-rule="evenodd"></path>
                                            <path fill="#1E93FF" fill-rule="evenodd" d="M12 3C10.3431 3 9 4.34315 9 6C9 7.65685 10.3431 9 12 9C13.6569 9 15 7.65685 15 6C15 4.34315 13.6569 3 12 3ZM7 6C7 3.23858 9.23858 1 12 1C14.7614 1 17 3.23858 17 6C17 8.76142 14.7614 11 12 11C9.23858 11 7 8.76142 7 6Z" clip-rule="evenodd"></path>
                                            <path fill="#024493" fill-rule="evenodd" d="M3 20C3 16.134 6.13401 13 10 13H14C17.866 13 21 16.134 21 20C21 21.6569 19.6569 23 18 23H6C4.34315 23 3 21.6569 3 20ZM10 15C7.23858 15 5 17.2386 5 20C5 20.5523 5.44772 21 6 21H18C18.5523 21 19 20.5523 19 20C19 17.2386 16.7614 15 14 15H10Z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="items-center justify-between mb-3 sm:flex">
                                        <div class="text-sm font-normal text-gray-500 lex">'.$act->name.' <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">'.$act->created_at.'</time></div>
                                        <div class="text-sm font-normal text-gray-500 lex">'.$action.'</div>
                                    </div>
                                    <div class="p-3 text-xs italic font-normal text-gray-500 border border-gray-200 rounded-lg ' . $additionalClass . '">
                                        '.$content.'
                                    </div>
                                </div>
                            </li>
                    ';

                $content = "";
                if($ndate != $cdate && $x == $activity->count()){
                    if($act->field == 'Itemno'){
                        $label = "Item Number";
                    }else if($act->field == 'Partno'){
                        $label = "Part Number";
                    }else if($act->field == 'Partname'){
                        $label = "Part Name";
                    }
    
                    if($act->action == "ADD"){
                        $additionalClass = "bg-blue-300";
                        $content .= '
                                    <div>
                                        <div class="">'.$label.': '.$act->after.' </div>
                                    </div>
                        ';
                    }else if($act->action == "UPDATE"){
                        $additionalClass = "bg-green-300";
                        $content .= '
                                    <div>
                                        <div class="">'.$label.': '.$act->before.' ⇒ '.$act->after.'</div>
                                    </div>
                        ';
                    }else{
                        $additionalClass = "bg-red-300";
                        $content .= 'Deleted.';
                    }
                    $action = $act->action;

                    $result .='
                                <li class="mb-10 ml-6">
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" id="user">
                                                <path fill="#C4E6FF" fill-rule="evenodd" d="M3 20C3 16.8289 5.10851 14.1503 8 13.2898V18C8 18.5522 8.44772 19 9 19C11.1785 19 20.9291 19 20.9291 19C20.9758 19.3266 21 19.6604 21 20C21 21.6568 19.6569 23 18 23H6C4.34315 23 3 21.6568 3 20Z" clip-rule="evenodd"></path>
                                                <path fill="#1E93FF" fill-rule="evenodd" d="M12 3C10.3431 3 9 4.34315 9 6C9 7.65685 10.3431 9 12 9C13.6569 9 15 7.65685 15 6C15 4.34315 13.6569 3 12 3ZM7 6C7 3.23858 9.23858 1 12 1C14.7614 1 17 3.23858 17 6C17 8.76142 14.7614 11 12 11C9.23858 11 7 8.76142 7 6Z" clip-rule="evenodd"></path>
                                                <path fill="#024493" fill-rule="evenodd" d="M3 20C3 16.134 6.13401 13 10 13H14C17.866 13 21 16.134 21 20C21 21.6569 19.6569 23 18 23H6C4.34315 23 3 21.6569 3 20ZM10 15C7.23858 15 5 17.2386 5 20C5 20.5523 5.44772 21 6 21H18C18.5523 21 19 20.5523 19 20C19 17.2386 16.7614 15 14 15H10Z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <div class="items-center justify-between mb-3 sm:flex">
                                            <div class="text-sm font-normal text-gray-500 lex">'.$act->name.' <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">'.$act->created_at.'</time></div>
                                            <div class="text-sm font-normal text-gray-500 lex">'.$action.'</div>
                                        </div>
                                        <div class="p-3 text-xs italic font-normal text-gray-500 border border-gray-200 rounded-lg ' . $additionalClass . '">
                                            '.$content.'
                                        </div>
                                    </div>
                                </li>
                        ';
                }

                if($x != $activity->count()){
                    if($act->field == 'Itemno'){
                        $label = "Item Number";
                    }else if($act->field == 'Partno'){
                        $label = "Part Number";
                    }else if($act->field == 'Partname'){
                        $label = "Part Name";
                    }
    
                    if($act->action == "ADD"){
                        $additionalClass = "bg-blue-300";
                        $content .= '
                                    <div>
                                        <div class="">'.$label.': '.$act->after.' </div>
                                    </div>
                        ';
                    }else if($act->action == "UPDATE"){
                        $additionalClass = "bg-green-300";
                        $content .= '
                                    <div>
                                        <div class="">'.$label.': '.$act->before.' ⇒ '.$act->after.'</div>
                                    </div>
                        ';
                    }else{
                        $additionalClass = "bg-red-300";
                        $content .= 'Deleted.';
                    }
                    $action = $act->action;
                }
                $cdate = $ndate;
            }
            $x++;
        }
        return response()->json($result);
    }
}
