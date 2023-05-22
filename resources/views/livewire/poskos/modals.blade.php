<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Posko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="nama_posko"></label>
                        <input wire:model="nama_posko" type="text" class="form-control" id="nama_posko" placeholder="Nama Posko">@error('nama_posko') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_petugas"></label>
                        <input wire:model="nama_petugas" type="text" class="form-control" id="nama_petugas" placeholder="Nama Petugas">@error('nama_petugas') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_posko"></label>
                        <input wire:model="alamat_posko" type="text" class="form-control" id="alamat_posko" placeholder="Alamat Posko">@error('alamat_posko') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp"></label>
                        <input wire:model="no_hp" type="text" class="form-control" id="no_hp" placeholder="No Hp">@error('no_hp') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="latitude"></label>
                        <input wire:model="latitude" type="text" class="form-control" id="latitude" placeholder="Latitude">@error('latitude') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="longitude"></label>
                        <input wire:model="longitude" type="text" class="form-control" id="longitude" placeholder="Longitude">@error('longitude') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pengungsi"></label>
                        <input wire:model="jumlah_pengungsi" type="text" class="form-control" id="jumlah_pengungsi" placeholder="Jumlah Pengungsi">@error('jumlah_pengungsi') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_posko"></label>
                        <input wire:model="status_posko" type="text" class="form-control" id="status_posko" placeholder="Status Posko">@error('status_posko') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="bencana_id"></label>
                        <input wire:model="bencana_id" type="text" class="form-control" id="bencana_id" placeholder="Bencana Id">@error('bencana_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kecamatan_id"></label>
                        <input wire:model="kecamatan_id" type="text" class="form-control" id="kecamatan_id" placeholder="Kecamatan Id">@error('kecamatan_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_id"></label>
                        <input wire:model="user_id" type="text" class="form-control" id="user_id" placeholder="User Id">@error('user_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <h5 class="modal-title" id="updateModalLabel">Update Posko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="nama_posko"></label>
                        <input wire:model="nama_posko" type="text" class="form-control" id="nama_posko" placeholder="Nama Posko">@error('nama_posko') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_petugas"></label>
                        <input wire:model="nama_petugas" type="text" class="form-control" id="nama_petugas" placeholder="Nama Petugas">@error('nama_petugas') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_posko"></label>
                        <input wire:model="alamat_posko" type="text" class="form-control" id="alamat_posko" placeholder="Alamat Posko">@error('alamat_posko') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp"></label>
                        <input wire:model="no_hp" type="text" class="form-control" id="no_hp" placeholder="No Hp">@error('no_hp') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="latitude"></label>
                        <input wire:model="latitude" type="text" class="form-control" id="latitude" placeholder="Latitude">@error('latitude') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="longitude"></label>
                        <input wire:model="longitude" type="text" class="form-control" id="longitude" placeholder="Longitude">@error('longitude') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pengungsi"></label>
                        <input wire:model="jumlah_pengungsi" type="text" class="form-control" id="jumlah_pengungsi" placeholder="Jumlah Pengungsi">@error('jumlah_pengungsi') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_posko"></label>
                        <input wire:model="status_posko" type="text" class="form-control" id="status_posko" placeholder="Status Posko">@error('status_posko') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="bencana_id"></label>
                        <input wire:model="bencana_id" type="text" class="form-control" id="bencana_id" placeholder="Bencana Id">@error('bencana_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kecamatan_id"></label>
                        <input wire:model="kecamatan_id" type="text" class="form-control" id="kecamatan_id" placeholder="Kecamatan Id">@error('kecamatan_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_id"></label>
                        <input wire:model="user_id" type="text" class="form-control" id="user_id" placeholder="User Id">@error('user_id') <span class="error text-danger">{{ $message }}</span> @enderror
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

<div wire:ignore.self class="modal fade" id="kembalikanDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="kembalikanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kembalikanModalLabel">Tambahkan Kebutuhan Posko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="selected_id">
                    <div wire:ignore.self class="invoice-add-table">
                        <div class="table-responsive">
                            <table class="table table-center add-table-items">
                                <thead>
                                    <tr>
                                        <th width="40%">Barang</th>
                                        <th width="25%">Jumlah</th>
                                        <th width="35%">Satuan</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rows as $index => $row)
                                    <tr class="add-row">
                                        <td>
                                            <select class="form-control" wire:model="rows.{{ $index }}.barang_id">
                                                <option value="">-- Pilih --</option>
                                                @foreach($barangs as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                            @error('rows.{{ $index }}.barang_id') <span
                                                class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control"
                                                wire:model="rows.{{ $index }}.quantity">
                                            @error('rows.{{ $index }}.quantity') <span
                                                class="error text-danger">{{ $message }}</span>
                                            </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="form-control" wire:model="rows.{{ $index }}.satuan_id">
                                                <option value="">-- Pilih --</option>
                                                @foreach($satuans as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama_satuan }}</option>
                                                @endforeach
                                            </select>
                                            @error('rows.{{ $index }}.satuan_id') <span
                                                class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="add-remove text-end">
                                            <a href="javascript:void(0);" class="remove-btn"
                                                wire:click="removeRow({{ $index }})"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-primary mt-2" wire:click.prevent="addRow">Tambah
                                Baris</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="saveRow()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
