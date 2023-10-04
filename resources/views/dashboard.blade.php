<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    {{-- <div class="flex flex-row-reverse w-full"> --}}
                    <div class="grid grid-cols-2 w-full">
                        <div class="">
                            <button type="button" id="btnAParts" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-3 text-center">ADD PART</button>
                        </div>
                        <div class="relative w-[400px] justify-self-end">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="searchPart" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Parts..." required>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2 overflow-y-auto" style="height: calc(100vh - 230px);">
                        <table id="tableParts" class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50" style="position: sticky; top: 0;">
                                <tr>
                                    <th scope="col" class="px-2 py-1">
                                        ID
                                    </th>
                                    <th scope="col" class="px-2 py-2 w-4">
                                        PART NUMBER
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        PART NAME
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        BRAND
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        PRICE
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        STATUS
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        ACTION
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableBParts">
                                @foreach ($parts as $part)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-2 py-1">
                                            {{$part->id}}
                                        </td>
                                        <td class="px-2 py-1 w-40">
                                            {{$part->partno}}
                                        </td>
                                        <td class="text-xs px-2 py-1">
                                            {{$part->partname}}
                                        </td>
                                        <td class="px-2 py-1">
                                            {{$part->name}}
                                        </td>
                                        <td class="px-2 py-1">
                                            {{$part->price}}
                                        </td>
                                        <td class="px-2 py-1">
                                            {{-- {{$part->status}} --}}
                                            @if ($part->status === '0')
                                                INACTIVE
                                            @else
                                                ACTIVE
                                            @endif
                                        </td>
                                        <td class="px-2 py-1">
                                            <button type="button" data-id="{{$part->id}}" class="btnPartView" id="btnPartView"><svg fill="#000000" viewBox="-3.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"> <path d="M12.406 13.844c1.188 0 2.156 0.969 2.156 2.156s-0.969 2.125-2.156 2.125-2.125-0.938-2.125-2.125 0.938-2.156 2.125-2.156zM12.406 8.531c7.063 0 12.156 6.625 12.156 6.625 0.344 0.438 0.344 1.219 0 1.656 0 0-5.094 6.625-12.156 6.625s-12.156-6.625-12.156-6.625c-0.344-0.438-0.344-1.219 0-1.656 0 0 5.094-6.625 12.156-6.625zM12.406 21.344c2.938 0 5.344-2.406 5.344-5.344s-2.406-5.344-5.344-5.344-5.344 2.406-5.344 5.344 2.406 5.344 5.344 5.344z"></path></svg></button>
                                            <button type="button" data-id="{{$part->id}}" class="btnPartEdit" id="btnPartEdit"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                            <button type="button" data-id="{{$part->id}}" class="btnPartDelete" id="btnPartDelete"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M779.5 1002.7h-535c-64.3 0-116.5-52.3-116.5-116.5V170.7h768v715.5c0 64.2-52.3 116.5-116.5 116.5zM213.3 256v630.1c0 17.2 14 31.2 31.2 31.2h534.9c17.2 0 31.2-14 31.2-31.2V256H213.3z" fill="#ff3838"/><path d="M917.3 256H106.7C83.1 256 64 236.9 64 213.3s19.1-42.7 42.7-42.7h810.7c23.6 0 42.7 19.1 42.7 42.7S940.9 256 917.3 256zM618.7 128H405.3c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7h213.3c23.6 0 42.7 19.1 42.7 42.7S642.2 128 618.7 128zM405.3 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7S448 403 448 426.6v256c0 23.6-19.1 42.7-42.7 42.7zM618.7 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v256c-0.1 23.6-19.2 42.7-42.7 42.7z" fill="#5F6379"/></svg></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="paginationLinks" class="mt-2">
                        {{ $parts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL VIEW AND EDIT --}}
        <div id="ModalParts" tabindex="-1" class="fixed top-0 left-0 z-50 hidden w-screen p-4 overflow-x-hidden overflow-y-hidden md:inset-0 h-screen max-h-full bg-gray-800 bg-opacity-50">
            <div class="relative h-screen w-screen overflow-x-hidden">
                <!-- Modal content -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-1/2 bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-3 border-b rounded-t">
                        <h3 id="titleH" class="text-xl font-medium text-gray-900">
                            
                        </h3>
                        <button type="button" id="btnPartsEa" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form id="frmParts" action="">
                            @csrf
                            <div class="grid gap-3 mb-6 md:grid-cols-2">
                                <input type="hidden" id="PartID" name="PartID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <div>
                                    <label for="PartINum" class="block mb-2 text-sm font-medium text-gray-900">Item Number</label>
                                    <input type="text" id="PartINum" name="PartINum" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="PartName" class="block mb-2 text-sm font-medium text-gray-900">Item Description</label>
                                    <input type="text" id="PartName" name="PartName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="PartNum" class="block mb-2 text-sm font-medium text-gray-900">Part Number</label>
                                    <input type="text" id="PartNum" name="PartNum" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="PartBrand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                                    <select id="PartBrand" name="PartBrand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value=""></option>
                                        @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="PartPrice" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                                    <input type="text" id="PartPrice" name="PartPrice" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="PartStatus" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                    <select id="PartStatus" name="PartStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value=""></option>
                                        <option value="0">INACTIVE</option>
                                        <option value="1">ACTIVE</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="button" id="btnUParts" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"></button>
                        <button type="button" id="btnPartsEb" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- SUCCESS MODAL --}}
        <div id="modalSuccess" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                <div class="flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-12 w-12">
                        <circle cx="12" cy="12" r="11" fill="#4CAF50"/>
                        <path fill="#FFFFFF" d="M9.25 15.25L5.75 11.75L4.75 12.75L9.25 17.25L19.25 7.25L18.25 6.25L9.25 15.25Z"/>
                        </svg>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Success!</h3>
                    <p class="text-sm text-gray-500">Your changes have been saved.</p>
                </div>
                <div class="mt-5 sm:mt-6">
                    <button id="SCloseButton" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">Close</button>
                </div>
            </div>
        </div>
    {{-- FAILED MODAL --}}
        <div id="modalFail" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="bg-red-200 rounded-lg shadow-lg w-80 mx-auto p-4">
              <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-12 w-12">
                    <circle cx="12" cy="12" r="10" fill="#f44336"/>
                    <path d="M8.46 8.46L15.54 15.54M8.46 15.54L15.54 8.46" stroke="#fff" stroke-width="2"/>
                </svg>
              </div>
              <div class="mt-4 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Failed!</h3>
                <p class="text-xs text-gray-900">Your changes could not be saved. Please try again.</p>
              </div>
              <div class="mt-5 sm:mt-6">
                <button id="FCloseButton" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">Close</button>
              </div>
            </div>
        </div>
    {{-- CONFIRMATION MODAL --}}
        <div id="modalDelete" tabindex="-1" class="fixed top-0 left-0 z-50 hidden w-screen p-4 overflow-x-hidden overflow-y-hidden md:inset-0 h-screen max-h-full bg-gray-800 bg-opacity-50">
            <div class="relative h-screen w-screen overflow-x-hidden">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[30%] bg-white rounded-lg shadow">
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this record?</h3>
                        <button type="button" id="deleteConfirm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure.
                        </button>
                        <button id="btnCDelete" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel.</button>
                    </div>
                </div>
            </div>
        </div>
    
    <script>
        $(document).ready(function () {
            // Close View, Edit, Add
            $('#btnPartsEa, #btnPartsEb').click(function () { 
                $("#ModalParts").addClass("hidden");
                $("#ModalParts").removeClass("block");
                $('input, select, textarea, checkbox').prop('disabled', false);
            });

            // Close Success
            $('#SCloseButton').click(function () { 
                $("#modalSuccess").addClass("hidden");
                $("#modalSuccess").removeClass("block");
                location.reload();
            });

            // Close Fail
            $('#FCloseButton').click(function () { 
                $("#modalFail").addClass("hidden");
                $("#modalFail").removeClass("block");
            });

            // Close Delete
            $('#btnCDelete').click(function () { 
                $("#modalDelete").addClass("hidden");
                $("#modalDelete").removeClass("block");
            });
            
            // Add Part
            jQuery(document).on( "click", "#btnAParts", function(){
                $("#ModalParts").removeClass("hidden");
                $("#ModalParts").addClass("block");

                $('#frmParts')[0].reset();
                $('#PartID').val('');

                $('#titleH').html('ADD PARTS');
                $('#btnUParts').text('ADD');
            });

            // View Part
            jQuery(document).on( "click", ".btnPartView", function(){
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    type: "GET",
                    url: "{{route('dashboard.getParts')}}",
                    data: {id: id, _token: _token,},
                    dataType: "json",
                    success: function (result) {
                        $('#PartID').val(result.PartID);
                        $('#PartINum').val(result.PartINum);
                        $('#PartName').val(result.PartName);
                        $('#PartNum').val(result.PartNum);
                        $('#PartBrand').val(result.PartBrand);
                        $('#PartPrice').val(result.PartPrice);
                        $('#PartStatus').val(result.PartStatus);

                        $('#titleH').html('VIEW PARTS - <span class="text-blue-700">' + result.PartName + '</span>');

                        $("#ModalParts").removeClass("hidden");
                        $("#ModalParts").addClass("block");

                        $("#btnUParts").addClass("hidden");
                        $('input, select, textarea, checkbox').prop('disabled', true);
                    }
                });
            });

            // Edit Part
            jQuery(document).on( "click", ".btnPartEdit", function(){
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    type: "GET",
                    url: "{{route('dashboard.getParts')}}",
                    data: {id: id, _token: _token,},
                    dataType: "json",
                    success: function (result) {
                        $('#PartID').val(result.PartID);
                        $('#PartINum').val(result.PartINum);
                        $('#PartName').val(result.PartName);
                        $('#PartNum').val(result.PartNum);
                        $('#PartBrand').val(result.PartBrand);
                        $('#PartPrice').val(result.PartPrice);
                        $('#PartStatus').val(result.PartStatus);

                        $('#titleH').html('EDIT PARTS - <span class="text-blue-700">' + result.PartName + '</span>');
                        $('#btnUParts').text('UPDATE');

                        $("#ModalParts").removeClass("hidden");
                        $("#ModalParts").addClass("block");
                        $("#btnUParts").removeClass("hidden");
                    }
                });
            });

            // Update Part
            jQuery(document).on( "click", "#btnUParts", function(){

                $.ajax({
                    type: "POST",
                    url: "{{route('dashboard.saveParts')}}",
                    data:  $("#frmParts").serialize(),
                    success: function (result) {
                        $("#modalSuccess").addClass("block");
                        $("#modalSuccess").removeClass("hidden");

                        // if (result.message === 'Record updated') {
                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        // }else{
                        //     setTimeout(function() {
                        //         window.location.href = "{{ route('dashboard') }}";
                        //     }, 5000);
                        // }

                        $("#ModalParts").addClass("hidden");
                        $("#ModalParts").removeClass("block");
                        $('#frmParts')[0].reset();
                        $('#PartID').val('');
                    },
                    error: function(error) {
                        $("#modalFail").addClass("block");
                        $("#modalFail").removeClass("hidden");
                    }
                });
            });

            // Delete Part
            jQuery(document).on( "click", "#btnPartDelete", function(){
                var id = $(this).data('id');
                $('#deleteConfirm').data('id', id);

                $("#modalDelete").addClass("block");
                $("#modalDelete").removeClass("hidden");
            });
            
            // Delete Part
            jQuery(document).on( "click", "#deleteConfirm", function(){
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('dashboard.deleteParts')}}",
                    data: {id: id, _token: _token,},
                    dataType: "json",
                    success: function (result) {
                        $("#modalDelete").addClass("hidden");
                        $("#modalDelete").removeClass("block");

                        $("#modalSuccess").addClass("block");
                        $("#modalSuccess").removeClass("hidden");
                        
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    },
                    error: function(error) {
                        $("#modalFail").addClass("block");
                        $("#modalFail").removeClass("hidden");
                    }
                });
            });

            // Listen for input in the search bar
            $("#searchPart").on("input", function() {
                var searchText = $(this).val();
                
                $.ajax({
                    type: "GET",
                    url: "{{route('dashboard.search')}}",
                    data: { searchText: searchText },
                    success: function (result) {
                        $('#tableBParts').html(result.body);
                        $('#paginationLinks').html(result.pagination);
                    }
                });
            });
        });
    </script>
</x-app-layout>
