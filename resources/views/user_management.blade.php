<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <div class="grid grid-cols-2 w-full">
                        <div class="">
                            <button type="button" id="btnAUser" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-3 text-center">ADD USER</button>
                        </div>
                        <div class="relative w-[400px] justify-self-end">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="searchUser" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search User..." required>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2 overflow-y-auto" style="height: calc(100vh - 230px);">
                        <table id="tableUser" class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50" style="position: sticky; top: 0;">
                                <tr>
                                    <th scope="col" class="px-2 py-1 text-center">
                                        ID
                                    </th>
                                    <th scope="col" class="px-8 py-2 text-center">
                                        NAME
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        EMAIL
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        USERNAME
                                    </th>
                                    <th scope="col" class="px-2 py-3 text-center">
                                        ROLE
                                    </th>
                                    <th scope="col" class="px-2 py-3 text-center">
                                        STATUS
                                    </th>
                                    <th scope="col" class="px-2 py-3 text-center">
                                        ACTION
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableBUser">
                                @foreach ($users as $user)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-2 py-1 text-center">
                                            {{$user->id}}
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            {{$user->name}}
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            {{$user->email}}
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            {{$user->idnum}}
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            @if ($user->role == '0')
                                                USER
                                            @else
                                                ADMIN
                                            @endif
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            @if ($user->status == '0')
                                                INACTIVE
                                            @else
                                                ACTIVE
                                            @endif
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            <button type="button" data-id="{{$user->id}}" class="btnUserView" id="btnUserView"><svg fill="#000000" viewBox="-3.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"> <path d="M12.406 13.844c1.188 0 2.156 0.969 2.156 2.156s-0.969 2.125-2.156 2.125-2.125-0.938-2.125-2.125 0.938-2.156 2.125-2.156zM12.406 8.531c7.063 0 12.156 6.625 12.156 6.625 0.344 0.438 0.344 1.219 0 1.656 0 0-5.094 6.625-12.156 6.625s-12.156-6.625-12.156-6.625c-0.344-0.438-0.344-1.219 0-1.656 0 0 5.094-6.625 12.156-6.625zM12.406 21.344c2.938 0 5.344-2.406 5.344-5.344s-2.406-5.344-5.344-5.344-5.344 2.406-5.344 5.344 2.406 5.344 5.344 5.344z"></path></svg></button>
                                            <button type="button" data-id="{{$user->id}}" class="btnUserEdit" id="btnUserEdit"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL VIEW AND EDIT --}}
        <div id="modalUser" tabindex="-1" class="fixed top-0 left-0 z-50 hidden w-screen p-4 overflow-x-hidden overflow-y-hidden md:inset-0 h-screen max-h-full bg-gray-800 bg-opacity-50">
            <div class="relative h-screen w-screen overflow-x-hidden">
                <!-- Modal content -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-1/2 bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-3 border-b rounded-t">
                        <h3 id="titleH" class="text-xl font-medium text-gray-900">
                            
                        </h3>
                        <button type="button" id="btnUserEa" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form id="frmUser" action="">
                            @csrf
                            <div class="grid gap-3 mb-6 md:grid-cols-2">
                                <input type="hidden" id="UserID" name="UserID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <div>
                                    <label for="UserName" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                                    <input type="text" id="UserName" name="UserName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="UserEmail" class="block mb-2 text-sm font-medium text-gray-900">User Email</label>
                                    <input type="text" id="UserEmail" name="UserEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="UserUName" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                    <input type="text" id="UserUName" name="UserUName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="UserRole" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                                    <select id="UserRole" name="UserRole" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value=""></option>
                                        <option value="1">ADMIN</option>
                                        <option value="0">USER</option>
                                    </select>
                                </div>
                                <div id="cpword" class="flex items-center">
                                    <input id="cbCPassword" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="cbCPassword" class="ml-2 text-sm font-medium text-gray-900">Change Password?</label>
                                </div>
                                <div id="cpword1" class=""></div>
                                <div id="upword">
                                    <label for="UserPassword" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                    <input type="password" id="UserPassword" name="UserPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div id="ucpword">
                                    <label for="UserCPassword" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                                    <input type="password" id="UserCPassword" name="UserCPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="UserStatus" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                    <select id="UserStatus" name="UserStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                        <button type="button" id="btnUUser" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"></button>
                        <button type="button" id="btnUserEb" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Close</button>
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
    <script>
        $(document).ready(function () {
            $("#btnUserEa, #btnUserEb").click(function () {
                $("#modalUser").addClass("hidden");
                $("#modalUser").removeClass("block");
            });
            $("#SCloseButton").click(function () {
                $("#modalSuccess").addClass("hidden");
                $("#modalSuccess").removeClass("block");
                location.reload();
            });
    
            $("#FCloseButton").click(function () {
                $("#modalFail").addClass("hidden");
                $("#modalFail").removeClass("block");
            });
            
            // Add User
            jQuery(document).on( "click", "#btnAUser", function(){
                $("#modalUser").removeClass("hidden");
                $("#modalUser").addClass("block");

                $('#frmUser')[0].reset();
                $('#UserID').val('');

                $('#titleH').html('ADD USER');cpword
                $('#btnUUser').text('ADD');
                $("#cpword, #cpword1").addClass("hidden");
            });

            // Save User
            jQuery(document).on( "click", "#btnUUser", function(){
                $.ajax({
                    type: "POST",
                    url: "{{route('user_management.saveUser')}}",
                    data: $("#frmUser").serialize(),
                    success: function (result) {
                        $("#modalSuccess").addClass("block");
                        $("#modalSuccess").removeClass("hidden");

                            setTimeout(function() {
                                location.reload();
                            }, 5000);

                        $("#modalUser").addClass("hidden");
                        $("#modalUser").removeClass("block");
                        $('#frmUser')[0].reset();
                        $('#UserID').val('');
                    },
                    error: function(error) {
                        $("#modalFail").addClass("block");
                        $("#modalFail").removeClass("hidden");
                    }
                });
            });

            // View User
            jQuery(document).on( "click", "#btnUserView", function(){
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('user_management.viewUser')}}",
                    data: {id: id, _token: _token,},
                    dataType: "json",
                    success: function (result) {
                        $('#UserID').val(result.UserID);
                        $('#UserName').val(result.UserFName);
                        $('#UserEmail').val(result.UserEmail);
                        $('#UserUName').val(result.UserUName);
                        $('#UserRole').val(result.UserRole);
                        $('#UserStatus').val(result.UserStatus);

                        $('#titleH').html('VIEW USER - <span class="text-blue-700">' + result.UserFName + '</span>');

                        $("#modalUser").addClass("block");
                        $("#modalUser").removeClass("hidden");

                        $("#btnUUser").addClass("hidden");
                        $("#upword").addClass("hidden");
                        $("#ucpword").addClass("hidden");
                        $("#cpword, #cpword1").addClass("hidden");
                        $('input, select, textarea, checkbox').prop('disabled', true);
                    }
                });
            });

            jQuery(document).on( "click", "#btnUserEdit", function(){
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    type: "POST",
                    url: "{{route('user_management.viewUser')}}",
                    data: {id: id, _token: _token,},
                    dataType: "json",
                    success: function (result) {
                        $('#UserID').val(result.UserID);
                        $('#UserName').val(result.UserFName);
                        $('#UserEmail').val(result.UserEmail);
                        $('#UserUName').val(result.UserUName);
                        $('#UserRole').val(result.UserRole);
                        $('#UserStatus').val(result.UserStatus);

                        $('#titleH').html('EDIT USER - <span class="text-blue-700">' + result.UserFName + '</span>');

                        $("#modalUser").addClass("block");
                        $("#modalUser").removeClass("hidden");

                        $('#btnUUser').text('UPDATE');
                        $("#upword").addClass("hidden");
                        $("#ucpword").addClass("hidden");
                        $("#cpword, #cpword1").removeClass("hidden");
                    }
                });
            });

            jQuery(document).on( "click", "#cbCPassword", function(){
                if ($(this).is(":checked")) {
                    $("#upword").removeClass("hidden");
                    $("#ucpword").removeClass("hidden");
                } else {
                    $("#upword").addClass("hidden");
                    $("#ucpword").addClass("hidden");
                }
            });
        });
    </script>
</x-app-layout>
