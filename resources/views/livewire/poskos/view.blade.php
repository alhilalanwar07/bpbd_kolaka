@section('title', __('Poskos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="feather-home"></i>
                                Posko </h4>
                        </div>
                        @if (session()->has('message'))
                        <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                            {{ session('message') }} </div>
                        @endif
                        <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                                placeholder="Search Poskos">
                        </div>
                        <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('livewire.poskos.modals')
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead">
                                <tr>
                                    <td>#</td>
                                    <th>Bencana</th>
                                    <th>Nama Posko</th>
                                    <th>Nama Petugas</th>
                                    <th>Alamat Posko</th>
                                    <th>No Hp</th>
                                    <th>Long/Lat</th>
                                    <th>Jml Pengungsi</th>
                                    <th>Status Posko</th>
                                    <td>ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($poskos as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_bencana}}</td>
                                    <td>
                                        {{ strtoupper($row->nama_posko) }}
                                    </td>
                                    <td>{{ $row->nama_petugas }}</td>
                                    <td>{{ $row->alamat_posko }}
                                        <br> Kec. {{ $row->nama_kecamatan }}
                                    </td>
                                    <td>{{ $row->no_hp }}</td>
                                    <td>Lat: {{ $row->latitude }} <br> Long: {{ $row->longitude }}</td>
                                    <td>{{ $row->jumlah_pengungsi }} Orang</td>
                                    <td>
                                        <span class="badge badge-{{ $row->status_posko == 'aktif' ? 'success' : 'danger' }}">
                                            {{ $row->status_posko }}
                                    </td>
                                    <td width="90">
                                        @if ($row->status_posko == 'nonaktif' && Auth::user()->role == 'posko')
                                        <button class="btn btn-sm btn-success mb-1" wire:click="aktifkan({{$row->id}})"><i
                                                class="feather-check-circle"></i> Aktifkan </button> <br>
                                        @else
                                        <button class="btn btn-sm btn-primary mb-1" wire:click="edit({{$row->id}})"
                                            data-bs-toggle="modal" data-bs-target="#kembalikanDataModal">
                                        <i class="feather-plus-circle"></i> Kebutuhan</button> <br>
                                        @endif
                                        @if (Auth::user()->role == 'posko')
                                        <a data-bs-toggle="modal" data-bs-target="#updateDataModal"
                                            class="btn btn-sm btn-warning mb-1" wire:click="edit({{$row->id}})"><i
                                                class="fa fa-edit"></i> Edit </a> <br>
                                        <a class="btn btn-sm btn-danger"
                                            onclick="confirm('Confirm Delete Posko id {{$row->id}}? \nDeleted Poskos cannot be recovered!')||event.stopImmediatePropagation()"
                                            wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i>
                                            Delete </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="100%">No data Found </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">{{ $poskos->links() }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
