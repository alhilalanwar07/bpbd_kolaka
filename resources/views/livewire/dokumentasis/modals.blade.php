<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Tambah Dokumentasi</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea wire:model="keterangan" type="text" class="form-control" id="keterangan" placeholder="Keterangan"></textarea>@error('keterangan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar_penyerahan">Gambar Penyerahan</label>
                        <input wire:model="gambar_penyerahan" type="file" class="form-control" id="gambar_penyerahan" placeholder="Gambar Penyerahan">@error('gambar_penyerahan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="pdf_laporan">PDF Laporan</label>
                        <input wire:model="pdf_laporan" type="file" class="form-control" id="pdf_laporan" placeholder="Pdf Laporan">@error('pdf_laporan') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <h5 class="modal-title" id="updateModalLabel">Update Dokumentasi</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="keterangan"></label>
                        <input wire:model="keterangan" type="text" class="form-control" id="keterangan" placeholder="Keterangan">@error('keterangan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar_penyerahan"></label>
                        <input wire:model="gambar_penyerahan" type="text" class="form-control" id="gambar_penyerahan" placeholder="Gambar Penyerahan">@error('gambar_penyerahan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="pdf_laporan"></label>
                        <input wire:model="pdf_laporan" type="text" class="form-control" id="pdf_laporan" placeholder="Pdf Laporan">@error('pdf_laporan') <span class="error text-danger">{{ $message }}</span> @enderror
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
