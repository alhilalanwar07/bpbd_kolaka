@section('title', __('Kebutuhan Poskos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="feather-layers"></i>
                                Distribusi </h4>
                        </div>
                        @if (session()->has('message'))
                        <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                            {{ session('message') }} </div>
                        @endif
                        <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                                placeholder="Search Kebutuhan Poskos">
                        </div>
                        <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('livewire.kebutuhan-poskos.modals')
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead">
                                <tr>
                                    <td>#</td>
                                    <th>Tanggal Permintaan</th>
                                    <th>Posko </th>
                                    <th>Barang </th>
                                    <th>Jml Kebutuhan</th>
                                    <th>Status</th>
                                    @if (Auth::user()->role == 'logistik' || Auth::user()->role == 'posko')
                                    <td>ACTIONS</td>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kebutuhanPoskos as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ Carbon\Carbon::parse($row->created_at)->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                    <td>
                                        {{ strtoupper($row->nama_posko) }} | {{ strtoupper($row->nama_petugas) }}
                                    </td>
                                    <td>{{ strtoupper($row->nama_barang) }} </td>
                                    <td>
                                        {{ $row->jumlah_kebutuhan }} {{ ucfirst($row->nama_satuan) }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $row->status_kebutuhan == 'pending' ? 'warning' : 'success' }}">
                                            {{ ucfirst($row->status_kebutuhan) }} </span>
                                    </td>
                                    @if (Auth::user()->role == 'logistik' || Auth::user()->role == 'posko')
                                    <td width="90" class="text-center">
                                        <!-- jika pending tampilkan checkbox, jika terdistribusi maka checkbox nya disable dan terceklis-->
                                        @if ($row->status_kebutuhan == 'pending')
                                        <input type="checkbox" wire:click="distribusi({{ $row->id }})"
                                            class="form-check-input">
                                        @else
                                        <input type="checkbox" wire:click="distribusi({{ $row->id }})"
                                            class="form-check-input" checked disabled>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="100%">No data Found </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">{{ $kebutuhanPoskos->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
