@section('title', __('Laporan Penyerahan'))
<div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <h4><i class="feather-printer"></i>
                                    Laporan Penyerahan</h4>
                            </div>
                            @if (session()->has('message'))
                            <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                                {{ session('message') }} </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="posko_id">Posko</label>
                                <select wire:model="posko_id" class="form-control" id="posko_id">
                                    <option value="">-- Pilih Posko --</option>
                                    @foreach ($poskos as $posko)
                                    <option value="{{ $posko->id }}">{{ $posko->nama_posko }} -
                                        {{ $posko->nama_petugas }} </option>
                                    @endforeach
                                </select>
                                @error('posko_id') <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_permintaan">Tanggal Permintaan </label>
                                <input wire:model="tanggal_permintaan" type="date" class="form-control"
                                    id="tanggal_permintaan" placeholder="Masukkan Tanggal Permintaan">
                                @error('tanggal_permintaan') <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_penerima">Nama Penerima</label>
                                <input wire:model="nama_penerima" type="text" class="form-control"
                                    id="nama_penerima" placeholder="Masukkan Nama Penerima">
                                @error('nama_penerima') <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="button" wire:click.prevent="cetak()" class="btn btn-primary">
                                    <i class="feather-save"></i> Cetak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
