<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Logistik</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="barang_id">Nama Barang</label>
                        <select wire:model="barang_id" class="form-control" id="barang_id">
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">
                                {{ strtoupper($barang->nama_barang) }}
                            </option>
                            @endforeach
                        </select>
                        @error('barang_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah</label>
                        <input wire:model="jumlah_barang" type="number" class="form-control" id="jumlah_barang" placeholder="Jumlah Barang">@error('jumlah_barang') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="satuan_id">Satuan</label>
                        <select wire:model="satuan_id" class="form-control" id="satuan_id">
                            <option value="">-- Pilih Satuan --</option>
                            @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->id }}">
                                {{ strtoupper($satuan->nama_satuan) }}
                            </option>
                            @endforeach
                        </select>
                        @error('satuan_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan</label>
                        <input wire:model="harga_satuan" type="number" class="form-control" id="harga_satuan" placeholder="Harga Satuan">@error('harga_satuan') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <h5 class="modal-title" id="updateModalLabel">Update Logistik</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="barang_id">Nama Barang</label>
                        <select wire:model="barang_id" class="form-control" id="barang_id">
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">
                                {{ strtoupper($barang->nama_barang) }}
                            </option>
                            @endforeach
                        </select>
                        @error('barang_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah</label>
                        <input wire:model="jumlah_barang" type="number" class="form-control" id="jumlah_barang" placeholder="Jumlah Barang">@error('jumlah_barang') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                        <div class="form-group">
                            <label for="satuan_id">Satuan</label>
                            <select wire:model="satuan_id" class="form-control" id="satuan_id">
                                <option value="">-- Pilih Satuan --</option>
                                @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->id }}">
                                    {{ strtoupper($satuan->nama_satuan) }}
                                </option>
                                @endforeach
                            </select>
                            @error('satuan_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan</label>
                        <input wire:model="harga_satuan" type="number" class="form-control" id="harga_satuan" placeholder="Harga Satuan">@error('harga_satuan') <span class="error text-danger">{{ $message }}</span> @enderror
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
