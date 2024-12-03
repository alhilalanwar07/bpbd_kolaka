<div class="login-right">
    <div class="login-right-wrap">
        <h1>Register</h1>
        <p class="account-subtitle">Masukkan detail informasi untuk mendaftar.</p>

        <form wire:submit.prevent="daftar()">
            @csrf
            <div class="form-group">
                <label>Nama Petugas <span class="login-danger">*</span></label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" wire:model="name">
                @error('name') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label>Nama Posko<span class="login-danger">*</span></label>
                <input class="form-control @error('nama_posko') is-invalid @enderror" type="text"
                    wire:model="nama_posko">
                @error('nama_posko') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label>No. Telepon<span class="login-danger">*</span></label>
                <input class="form-control @error('no_hp') is-invalid @enderror" type="text" wire:model="no_hp">
                @error('no_hp') <small class="text-danger">{{ $message }}</small>@enderror
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
                <select class="form-control @error('kecamatan_id') is-invalid @enderror" wire:model="kecamatan_id">
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
            <div class="login-or">
                <span class="or-line"></span>
                <span class="span-or">Lokasi</span>
            </div>
            <!-- button get lokasi for get long lat -->
            <div class="form-group">
                <!-- <button class="btn btnsm btn-block btn-primary" wire:click="getlokasi">Dapatkan Lokasi</button> -->
                <button type="button" class="btn btn-sm btn-block btn-primary" onclick="getLocation()">Dapatkan Lokasi</button>
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
                <input id="latitude" class="form-control @error('latitude') is-invalid @enderror"
                    type="text" wire:model.lazy="latitude" name="latitude" value="{{ old('latitude') ?? 0 }}">
                @error('latitude') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="login-or">
                <span class="or-line"></span>
                <span class="span-or">Akun</span>
            </div>
            <div class="form-group">
                <label>Email<span class="login-danger">*</span></label>
                <input class="form-control @error('email') is-invalid @enderror" type="text" wire:model="email">
                @error('email') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label>Password <span class="login-danger">*</span></label>
                <input class="form-control @error('password') is-invalid @enderror" type="password"
                    wire:model="password">
                <span class="profile-views feather-eye toggle-password"></span>
                @error('password') <small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class=" dont-have">Sudah terdaftar? <a href="/login">Login</a></div>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </form>
        <div class="login-or">
            <span class="or-line"></span>
            <span class="span-or"></span>
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
