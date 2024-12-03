<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollabl modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Tambah Data Posko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Nama Posko<span class="login-danger">*</span></label>
                        <input class="form-control @error('nama_posko') is-invalid @enderror" type="text"
                            wire:model="nama_posko">
                        @error('nama_posko') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat Posko<span class="login-danger">*</span></label>
                        <input class="form-control @error('alamat_posko') is-invalid @enderror" type="text"
                            wire:model="alamat_posko">
                        @error('alamat_posko') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <!-- kecamatan_id -->
                    <div class="form-group">
                        <label>Kecamatan<span class="login-danger">*</span></label>
                        <select class="form-control @error('kecamatan_id') is-invalid @enderror"
                            wire:model="kecamatan_id">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatans as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <!-- jumlah pengungsi -->
                    <div class="form-group">
                        <label>Jumlah Pengungsi<span class="login-danger">*</span></label>
                        <input class="form-control @error('jumlah_pengungsi') is-invalid @enderror" type="text"
                            wire:model="jumlah_pengungsi">
                        @error('jumlah_pengungsi') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <!-- bencana_id -->
                    <div class="form-group">
                        <label>Bencana<span class="login-danger">*</span></label>
                        <select class="form-control @error('bencana_id') is-invalid @enderror" wire:model="bencana_id">
                            <option value="">-- Pilih Bencana --</option>
                            @foreach($bencanas as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_bencana }}</option>
                            @endforeach
                        </select>
                        @error('bencana_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <!-- button get lokasi for get long lat -->
                    <div class="form-group">
                        <!-- <button class="btn btnsm btn-block btn-primary" wire:click="getlokasi">Dapatkan Lokasi</button> -->
                        <button type="button" class="btn btnsm btn-block btn-primary" onclick="getLocation()">Dapatkan
                            Lokasi</button>
                    </div>
                    <!-- longitude & latitude -->
                    <div class="form-group">
                        <label>Longitude<span class="login-danger">*</span></label>
                        <input id="longitude" class="form-control @error('longitude') is-invalid @enderror" type="text"
                            wire:model.lazy="longitude" name="longitude" value="{{ old('longitude') ?? 0 }}">
                        @error('longitude') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label>Latitude<span class="login-danger">*</span></label>
                        <input id="latitude" class="form-control @error('latitude') is-invalid @enderror" type="text"
                            wire:model.lazy="latitude" name="latitude" value="{{ old('latitude') ?? 0 }}">
                        @error('latitude') <small class="text-danger">{{ $message }}</small>@enderror
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
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollabl modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Posko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label>Nama Posko<span class="login-danger">*</span></label>
                        <input class="form-control @error('nama_posko') is-invalid @enderror" type="text"
                            wire:model="nama_posko">
                        @error('nama_posko') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat Posko<span class="login-danger">*</span></label>
                        <input class="form-control @error('alamat_posko') is-invalid @enderror" type="text"
                            wire:model="alamat_posko">
                        @error('alamat_posko') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <!-- kecamatan_id -->
                    <div class="form-group">
                        <label>Kecamatan<span class="login-danger">*</span></label>
                        <select class="form-control @error('kecamatan_id') is-invalid @enderror"
                            wire:model="kecamatan_id">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatans as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <!-- jumlah pengungsi -->
                    <div class="form-group">
                        <label>Jumlah Pengungsi<span class="login-danger">*</span></label>
                        <input class="form-control @error('jumlah_pengungsi') is-invalid @enderror" type="text"
                            wire:model="jumlah_pengungsi">
                        @error('jumlah_pengungsi') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <!-- bencana_id -->
                    <div class="form-group">
                        <label>Bencana<span class="login-danger">*</span></label>
                        <select class="form-control @error('bencana_id') is-invalid @enderror" wire:model="bencana_id">
                            <option value="">-- Pilih Bencana --</option>
                            @foreach($bencanas as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_bencana }}</option>
                            @endforeach
                        </select>
                        @error('bencana_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <!-- button get lokasi for get long lat -->
                    <div class="form-group">
                        <!-- <button class="btn btnsm btn-block btn-primary" wire:click="getlokasi">Dapatkan Lokasi</button> -->
                        <button type="button" class="btn btnsm btn-block btn-primary" onclick="getLocation()">Dapatkan
                            Lokasi</button>
                    </div>
                    <!-- longitude & latitude -->
                    <div class="form-group">
                        <label>Longitude<span class="login-danger">*</span></label>
                        <input id="longitude" class="form-control @error('longitude') is-invalid @enderror" type="text"
                            wire:model.lazy="longitude" name="longitude" value="{{ old('longitude') ?? 0 }}">
                        @error('longitude') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group">
                        <label>Latitude<span class="login-danger">*</span></label>
                        <input id="latitude" class="form-control @error('latitude') is-invalid @enderror" type="text"
                            wire:model.lazy="latitude" name="latitude" value="{{ old('latitude') ?? 0 }}">
                        @error('latitude') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
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
                <!-- alert session -->
                @if (session()->has('message'))
                <div class="alert alert-success" wire:poll.750ms>
                    {{ session('message') }}
                </div>
                @endif
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
                                    <!-- alert -->

                                    <tr class="add-row">
                                        <td>
                                            <select class="form-control" wire:model="rows.{{ $index }}.barang_id">
                                                <option value="">-- Pilih --</option>
                                                @foreach($barangs as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama_barang }} (Stok:{{ $item->stok }})
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="" wire:poll.750ms>
                                                @error('rows.'.$index.'.barang_id') <span class="error text-danger">{{
                                                    $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" min="0"
                                                wire:model="rows.{{ $index }}.quantity">
                                            @error('rows.'.$index.'.quantity') <span wire:poll.750ms
                                                class="error text-danger">{{ $message }}
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
                                            @error('rows.'.$index.'.satuan_id') <span wire:poll.750ms
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
     <script>
        var latitudeInput = document.getElementById("latitude");
        var longitudeInput = document.getElementById("longitude");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {

                    latitudeInput.value = position.coords.latitude;
                    longitudeInput.value = position.coords.longitude;

                    var longitude = position.coords.latitude
                    var latitude = position.coords.longitude

                    Livewire.emit('get-location', latitude, longitude);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }
    </script>
</div>