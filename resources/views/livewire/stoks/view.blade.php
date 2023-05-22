@section('title', __('Stoks'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="feather-database"></i>
                                Stok Barang</h4>
                        </div>
                        @if (session()->has('message'))
                        <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                            {{ session('message') }} </div>
                        @endif
                        <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                                placeholder="Search Stoks">
                        </div>
                        <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('livewire.stoks.modals')
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead text-center">
                                <tr class="text-center">
                                    <td>#</td>
                                    <th>Tgl Masuk</th>
                                    <th>Barang </th>
                                    <th>Jumlah Masuk</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                    <td>ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stoks as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->tgl_masuk }}</td>
                                    <td>{{ strtoupper($row->nama_barang) }}</td>
                                    <td>{{ $row->jumlah_masuk }} {{ $row->nama_satuan }}</td>
                                    <td>Rp. {{ number_format($row->harga_satuan, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                                    <td width="90">
                                        <a data-bs-toggle="modal" data-bs-target="#updateDataModal"
                                            class="btn btn-sm btn-warning" wire:click="edit({{$row->id}})"><i
                                                class="fa fa-edit"></i> Edit </a>
                                        <a class="btn btn-sm btn-danger"
                                            onclick="confirm('Confirm Delete Stok id {{$row->id}}? \nDeleted Stoks cannot be recovered!')||event.stopImmediatePropagation()"
                                            wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i>
                                            Delete </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="100%">No data Found. </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">{{ $stoks->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
