<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Scarborough Fire - Supply Management') }}
        </h2>
    </x-slot>

    @if (request()->has('scanActive') && request('scanActive') == 'true')
        <x-scanner></x-scanner>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg justify-between">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        @if (session()->has('scannedList'))
                            <ul>
                                @foreach (session('scannedList') as $transaction)
                                    <li>{{ $transaction->getMessage() }}</li>
                                @endforeach
                            </ul>
                        @elseif (session()->has('success'))
                            {{ session('success') }}
                        @elseif (session()->has('fail'))
                            {{ session('fail') }}
                        @else
                            Start by scanning an item.
                        @endif
                    </div>

                    @if (session()->has('scanSuccess'))
                        <a href="#" id="scan-button"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3">
                            {{ __('Scan Another Item') }}
                        </a>
                    @else
                        <a href="#" id="scan-button"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3">
                            {{ __('Scan An Item') }}
                        </a>
                    @endif

                    @if (session()->has('scanSuccess'))
                        <a href="#" id="email-button"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3">
                            {{ __('Notify via Email') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in :name!", ['name' => auth()->user()->firstName]) }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const scanButton = document.getElementById("scan-button");
        const emailButton = document.getElementById("email-button");

        if (scanButton !== null) {
            scanButton.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the default link behavior
                window.location.href = "{{ route('scan') }}?scanActive=true";
            });
        }

        if (emailButton !== null) {
            emailButton.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the default link behavior
                window.location.href = "{{ route('restock-notification') }}";
            });
        }
    });
</script>
