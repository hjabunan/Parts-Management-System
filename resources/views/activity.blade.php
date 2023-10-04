<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Logs') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    <div class="grid grid-cols-6 gap-x-5">
                        <div class="col-span-2">
                            <label class="mb-4 text-3xl font-extrabold text-gray-900"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ACTIVITY LOGS</span></label>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2 overflow-y-auto" style="height: calc(100vh - 170px);">
                                <table id="tableAL" class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50" style="position: sticky; top: 0;">
                                        <tr>
                                            <th scope="col" class="px-2 py-1 text-center">
                                                ID
                                            </th>
                                            <th scope="col" class="px-2 py-2 text-center">
                                                TABLE KEY
                                            </th>
                                            <th scope="col" class="px-2 py-3 text-center">
                                                USER
                                            </th>
                                            <th scope="col" class="px-2 py-3 text-center">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBAL">
                                        @php
                                            $x=1;   
                                        @endphp
                                        @foreach ($activity as $act)
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="px-2 py-1 text-center">
                                                    {{ $x++ }}
                                                </td>
                                                <td class="px-2 py-1 w-30 text-center">
                                                    {{$act->table_key}}
                                                </td>
                                                <td class="px-2 py-1 text-center">
                                                    {{$act->name}}
                                                </td>
                                                <td class="px-2 py-1 text-center">
                                                    <button type="button" data-id="{{$act->table_key}}" class="btnActView" id="btnActView"><svg fill="#000000" viewBox="-3.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"> <path d="M12.406 13.844c1.188 0 2.156 0.969 2.156 2.156s-0.969 2.125-2.156 2.125-2.125-0.938-2.125-2.125 0.938-2.156 2.125-2.156zM12.406 8.531c7.063 0 12.156 6.625 12.156 6.625 0.344 0.438 0.344 1.219 0 1.656 0 0-5.094 6.625-12.156 6.625s-12.156-6.625-12.156-6.625c-0.344-0.438-0.344-1.219 0-1.656 0 0 5.094-6.625 12.156-6.625zM12.406 21.344c2.938 0 5.344-2.406 5.344-5.344s-2.406-5.344-5.344-5.344-5.344 2.406-5.344 5.344 2.406 5.344 5.344 5.344z"></path></svg></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label class="mb-4 text-3xl font-extrabold text-gray-900"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">HISTORY</span></label>
                            <div class="p-5 relative overflow-x-auto shadow-md sm:rounded-lg mt-2 overflow-y-auto" style="height: calc(100vh - 170px);">
                                <ol id="viewActivity" class="relative border-l border-gray-200">                  
                                    {{-- <li class="mb-10 ml-6">            
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" id="user">
                                                <path fill="#C4E6FF" fill-rule="evenodd" d="M3 20C3 16.8289 5.10851 14.1503 8 13.2898V18C8 18.5522 8.44772 19 9 19C11.1785 19 20.9291 19 20.9291 19C20.9758 19.3266 21 19.6604 21 20C21 21.6568 19.6569 23 18 23H6C4.34315 23 3 21.6568 3 20Z" clip-rule="evenodd"></path>
                                                <path fill="#1E93FF" fill-rule="evenodd" d="M12 3C10.3431 3 9 4.34315 9 6C9 7.65685 10.3431 9 12 9C13.6569 9 15 7.65685 15 6C15 4.34315 13.6569 3 12 3ZM7 6C7 3.23858 9.23858 1 12 1C14.7614 1 17 3.23858 17 6C17 8.76142 14.7614 11 12 11C9.23858 11 7 8.76142 7 6Z" clip-rule="evenodd"></path>
                                                <path fill="#024493" fill-rule="evenodd" d="M3 20C3 16.134 6.13401 13 10 13H14C17.866 13 21 16.134 21 20C21 21.6569 19.6569 23 18 23H6C4.34315 23 3 21.6569 3 20ZM10 15C7.23858 15 5 17.2386 5 20C5 20.5523 5.44772 21 6 21H18C18.5523 21 19 20.5523 19 20C19 17.2386 16.7614 15 14 15H10Z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex">
                                            <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">just now</time>
                                            <div class="text-sm font-normal text-gray-500">Bonnie moved <a href="#" class="font-semibold text-blue-600 hover:underline">Jese Leos</a> to <span class="bg-gray-100 text-gray-800 text-xs font-normal mr-2 px-2.5 py-0.5 rounded">Funny Group</span></div>
                                        </div>
                                    </li> --}}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".btnActView").click(function() {
                var tableKey = $(this).data("id");
                var _token = $('input[name="_token"]').val();
                $("#viewActivity").empty();

                $.ajax({
                    type: "GET",
                    url: "{{route('activity.getLogs')}}",
                    data: {tableKey: tableKey, _token: _token,},
                    dataType: "json",
                    success: function (result) {
                        $("#viewActivity").append(result);
                    }
                });
            });
        });
    </script>
</x-app-layout>
