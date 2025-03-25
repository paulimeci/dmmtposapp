<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Furnitoret</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"
                           data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                            <i class="fas fa-plus-circle"> Shto furnitor </i>
                        </a>
                        <h4 class="card-title">Lista e furnitoreve </h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Emri</th>
                                <th>Telefoni</th>
                                <th>Email</th>
                                <th>Adresa fizike</th>
                                <th>Veprimi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($furnitoret as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->adresa }}</td>
                                    <td>
                                        <button class="btn btn-info sm"
                                                data-bs-toggle="modal"
                                                data-bs-toggle="modal"
                                                wire:click="editFurnitor({{ $item->id }})"
                                                data-bs-target="#editSupplierModal{{ $item->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button wire:click="fshijFurnitor({{ $item->id }})"
                                                class="btn btn-danger sm"
                                                title="Delete Data"
                                                onclick="return confirm('Are you sure you want to delete this furnitor?') || event.stopImmediatePropagation()">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Supplier Modal -->
        <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSupplierModalLabel">Add Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="storeFurnitor" id="myForm">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Emri</label>
                                <div class="col-sm-9">
                                    <input wire:model="name" class="form-control" type="text">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone" class="col-sm-3 col-form-label">Nr Tel</label>
                                <div class="col-sm-9">
                                    <input wire:model="phone" class="form-control" type="text">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input wire:model="email" class="form-control" type="email">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-sm-3 col-form-label">Adresa</label>
                                <div class="col-sm-9">
                                    <input wire:model="address" class="form-control" type="text">
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mbyll</button>
                        <button type="submit" form="myForm" class="btn btn-primary">Ruaj furnitorin</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modals -->
        @foreach($furnitoret as $item)
            <div class="modal fade" id="editSupplierModal{{ $item->id }}" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="updateFurnitor" id="editForm{{ $item->id }}">
                                <div class="row mb-3">
                                    <label for="edit_name" class="col-sm-3 col-form-label">Emri</label>
                                    <div class="col-sm-9">
                                        <input wire:model="edit_name" class="form-control" type="text">
                                        @error('edit_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="edit_phone" class="col-sm-3 col-form-label">Nr Tel</label>
                                    <div class="col-sm-9">
                                        <input wire:model="edit_phone" class="form-control" type="text">
                                        @error('edit_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="edit_email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input wire:model="edit_email" class="form-control" type="email">
                                        @error('edit_email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="edit_address" class="col-sm-3 col-form-label">Adresa</label>
                                    <div class="col-sm-9">
                                        <input wire:model="edit_address" class="form-control" type="text">
                                        @error('edit_address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mbyll</button>
                            <button type="submit" form="editForm{{ $item->id }}" class="btn btn-primary">Perditeso furnitorin</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            // Initialize DataTable
            let dataTable = $('#datatable').DataTable({
                "paging": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "responsive": true
            });

            // Refresh DataTable when Livewire updates
            Livewire.on('refreshDatatable', () => {
                dataTable.destroy();
                setTimeout(() => {
                    dataTable = $('#datatable').DataTable({
                        "paging": true,
                        "pageLength": 10,
                        "lengthMenu": [10, 25, 50, 100],
                        "responsive": true
                    });
                }, 100);
            });

            // Close modal handler
            Livewire.on('close-modal', (data) => {
                $('#' + data.id).modal('hide');
            });
        });
    </script>
@endpush
