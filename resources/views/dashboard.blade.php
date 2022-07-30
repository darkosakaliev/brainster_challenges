<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container p-6">
        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h2>Vehicles</h2>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                <button class="btn btn-success" id="btn-add">
                    Add Vehicle
                </button>
            </div>
        </div>
        <div>
            <table class="table table-inverse">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Plate Number</th>
                        <th>Insurance Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="vehicle-list" name="vehicle-list">
                </tbody>
            </table>
            <div class="modal fade" id="formModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formModalLabel">Add Vehicle</h4>
                        </div>
                        <div class="modal-body">
                            <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Brand</label>
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="brand" name="brand"
                                        placeholder="Enter brand" value="">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Model</label>
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="model" name="model"
                                        placeholder="Enter model" value="">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Plate Number</label>
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="plate_number" name="plate_number"
                                        placeholder="Enter plate number" value="">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Insurance Date</label>
                                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="insurance_date" name="insurance_date"
                                        value="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" id="btn-save" value="">Save changes
                            </button>
                            <input type="hidden" id="vehicle_id" name="vehicle_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
