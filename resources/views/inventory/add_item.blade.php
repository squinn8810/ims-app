<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg justify-between">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('inventory.add') }}">
                        @csrf


                        <!-- Item Name -->
                        <div class="mt-4">
                            <x-input-label for="itemName" :value="__('Item Name')" />
                            <x-text-input itemURL="itemName" class="block mt-1 w-full" type="text" name="itemName"
                                :value="old('itemName')" required autofocus autocomplete="" />
                            <x-input-error :messages="$errors->get('itemName')" class="mt-2" />
                        </div>

                        <!-- Item URL -->
                        <div class="mt-4">
                            <x-input-label for="itemURL" :value="__('Item Url')" />
                            <x-text-input itemURL="itemURL" class="block mt-1 w-full" type="text" name="itemURL"
                                :value="old('itemURL')" required autofocus autocomplete="" />
                            <x-input-error :messages="$errors->get('itemURL')" class="mt-2" />
                        </div>

                        <!-- Reorder Qty -->
                        <div class="mt-4">
                            <x-input-label for="reorderQty" :value="__('Suggested Reorder Quantity')" />
                            <x-text-input itemURL="reorderQty" class="block mt-1 w-full" type="text"
                                name="reorderQty" :value="old('reorderQty')" required autocomplete="" />
                            <x-input-error :messages="$errors->get('reorderQty')" class="mt-2" />
                        </div>

                        <!-- Vendor Name -->
                        <div class="mt-4">
                            <x-input-label for="vendor" :value="__('Select a vendor:')" />
                            <select name="vendor" id="vendor">
                                <option value="" disabled selected style="display:none;"></option>
                                @foreach ($vendors as $key => $value)
                                    <option class="block mt-1 w-full" value="{{ $key }}">{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Select the location:')" />
                            <select name="location" id="location">
                                <option value="" disabled selected style="display:none;"></option>
                                @foreach ($locations as $key => $value)
                                    <option class="block mt-1 w-full" value="{{ $key }}">{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-primary-button class="mt-4">
                                {{ __('Add Item') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        </x-guest-layout>
