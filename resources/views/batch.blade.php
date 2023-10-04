<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Batch Upload') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <form action="{{ route('parts.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col gap-y-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                            <input class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" id="csv_file" name="csv_file">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none w-1/4">UPLOAD</button>
                        </div>
                    </form>
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
            var successMessage = '{{ session('success') }}';
            if (successMessage) {
                $("#modalSuccess").addClass("block");
                $("#modalSuccess").removeClass("hidden");
            }

            var errorMessage = '{{ session('error') }}';
            if (errorMessage) {
                $("#modalFail").addClass("block");
                $("#modalFail").removeClass("hidden");
            }
    
            $("#SCloseButton").click(function () {
                $("#modalSuccess").addClass("hidden");
                $("#modalSuccess").removeClass("block");
            });
    
            $("#FCloseButton").click(function () {
                $("#modalFail").addClass("hidden");
                $("#modalFail").removeClass("block");
            });
        });
    </script>
</x-app-layout>
