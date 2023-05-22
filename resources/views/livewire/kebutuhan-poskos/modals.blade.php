<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Kebutuhan Posko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="posko_id"></label>
                        <input wire:model="posko_id" type="text" class="form-control" id="posko_id" placeholder="Posko Id">@error('posko_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="barang_id"></label>
                        <input wire:model="barang_id" type="text" class="form-control" id="barang_id" placeholder="Barang Id">@error('barang_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_kebutuhan"></label>
                        <input wire:model="jumlah_kebutuhan" type="text" class="form-control" id="jumlah_kebutuhan" placeholder="Jumlah Kebutuhan">@error('jumlah_kebutuhan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kebutuhan"></label>
                        <input wire:model="jenis_kebutuhan" type="text" class="form-control" id="jenis_kebutuhan" placeholder="Jenis Kebutuhan">@error('jenis_kebutuhan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_kebutuhan"></label>
                        <input wire:model="status_kebutuhan" type="text" class="form-control" id="status_kebutuhan" placeholder="Status Kebutuhan">@error('status_kebutuhan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Kebutuhan Posko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="posko_id"></label>
                        <input wire:model="posko_id" type="text" class="form-control" id="posko_id" placeholder="Posko Id">@error('posko_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="barang_id"></label>
                        <input wire:model="barang_id" type="text" class="form-control" id="barang_id" placeholder="Barang Id">@error('barang_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_kebutuhan"></label>
                        <input wire:model="jumlah_kebutuhan" type="text" class="form-control" id="jumlah_kebutuhan" placeholder="Jumlah Kebutuhan">@error('jumlah_kebutuhan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kebutuhan"></label>
                        <input wire:model="jenis_kebutuhan" type="text" class="form-control" id="jenis_kebutuhan" placeholder="Jenis Kebutuhan">@error('jenis_kebutuhan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_kebutuhan"></label>
                        <input wire:model="status_kebutuhan" type="text" class="form-control" id="status_kebutuhan" placeholder="Status Kebutuhan">@error('status_kebutuhan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
            </div>
       </div>
    </div>
</div>
