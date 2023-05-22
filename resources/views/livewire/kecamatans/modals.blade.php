<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Kecamatan</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="nama_kecamatan">Nama Kecamatan</label>
                        <input wire:model="nama_kecamatan" type="text" class="form-control" id="nama_kecamatan" placeholder="Nama Kecamatan">@error('nama_kecamatan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="luas_wilayah">Luas Wilayah</label>
                        <input wire:model="luas_wilayah" type="number" class="form-control" id="luas_wilayah" placeholder="Luas Wilayah">@error('luas_wilayah') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_penduduk">Jumlah Penduduk</label>
                        <input wire:model="jumlah_penduduk" type="number" class="form-control" id="jumlah_penduduk" placeholder="Jumlah Penduduk">@error('jumlah_penduduk') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <h5 class="modal-title" id="updateModalLabel">Update Kecamatan</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="nama_kecamatan">Nama Kecamatan</label>
                        <input wire:model="nama_kecamatan" type="text" class="form-control" id="nama_kecamatan" placeholder="Nama Kecamatan">@error('nama_kecamatan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="luas_wilayah">Luas Wilayah</label>
                        <input wire:model="luas_wilayah" type="number" class="form-control" id="luas_wilayah" placeholder="Luas Wilayah">@error('luas_wilayah') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_penduduk">Jumlah Penduduk</label>
                        <input wire:model="jumlah_penduduk" type="number" class="form-control" id="jumlah_penduduk" placeholder="Jumlah Penduduk">@error('jumlah_penduduk') <span class="error text-danger">{{ $message }}</span> @enderror
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
