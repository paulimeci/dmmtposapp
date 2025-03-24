<div>
    <!-- Button to Open Modal -->
    <button type="button" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;" data-bs-toggle="modal" data-bs-target="#productModal">
        <i class="fas fa-plus-circle"></i> Shto Product
    </button>
    <br><br>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveProduct">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
                            <div class="form-group col-sm-10">
                                <input wire:model="name" class="form-control" type="text">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Furnitoret</label>
                            <div class="col-sm-10">
                                <select wire:model="furnitori_id" class="form-select" aria-label="Default select example">
                                    <option value="">Open this select menu</option>
                                    @foreach($furnitoret as $fu)
                                        <option value="{{ $fu->id }}">{{ $fu->name }}</option>
                                    @endforeach
                                </select>
                                @error('furnitori_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Unit Name</label>
                            <div class="col-sm-10">
                                <select wire:model="unit_id" class="form-select" aria-label="Default select example">
                                    <option value="">Open this select menu</option>
                                    @foreach($njesia as $nj)
                                        <option value="{{ $nj->id }}">{{ $nj->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-10">
                                <select wire:model="category_id" class="form-select" aria-label="Default select example">
                                    <option value="">Open this select menu</option>
                                    @foreach($kategoria as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Cmimi i shitjes</label>
                            <div class="form-group col-sm-10">
                                <input wire:model="cmimi_produktit" class="form-control" type="number" step="any">
                                @error('cmimi_produktit') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light" data-bs-dismiss="modal">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Listen for Livewire events to show/hide the modal
        Livewire.on('openModal', () => {
            $('#productModal').modal('show');
        });

        Livewire.on('closeModal', () => {
            $('#productModal').modal('hide');
        });
    </script>
@endpush
