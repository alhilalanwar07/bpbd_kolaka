@section('title', __('Dokumentasi'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="feather-camera"></i>
								Dokumentasi </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{
							session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
								placeholder="Search...">
						</div>
						@if(auth()->user()->role == 'kedaruratan')
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
							<i class="fa fa-plus"></i> Tambah Data
						</div>
						@endif
					</div>
				</div>

				<div class="card-body">
					@include('livewire.dokumentasis.modals')
					<div class="row">
						@forelse($dokumentasis as $row)
						<div class="col-md-5">
							<div class="card bg-light ">
								<img src="{{ asset('storage/dokumentasis/'.$row->gambar_penyerahan) }}" class="card-img-top mb-0 pb-0"
									alt="Gambar Penyerahan">
								<div class="card-body p-3">
									<h5 class="card-title mb-2">{{ $row->keterangan }}</h5>
									<table>
										<tr>
											<th>
												<i class="feather-calendar"></i>
											</th>
											<td>{{ Carbon\Carbon::parse($row->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
										</tr>
										<tr>
											<th>
												<i class="feather-user"></i>
											</th>
											<td>{{ $row->name }} ({{ ucwords($row->nama_posko) }})</td>
										</tr>
										<tr>
											<th>
												<i class="feather-activity"></i>
											</th>
											<td>{{ ucwords($row->nama_bencana) }}</td>
										</tr>
									</table>
									<div class="text-center justify-items-center align-items-center">
										<div class="d-flex mt-2 ">
											@if(auth()->user()->role == 'posko')
											<a href="{{ asset('storage/dokumentasis/'.$row->pdf_laporan) }}" target="_blank"
											class="btn btn-primary mx-1 btn-block">
											<i class="feather-file-text"></i>
											Lihat Laporan</a>
											<!-- BTN KONFIRMASI	 -->
											@if($row->status == 'pending')
											<button type="button" class="btn btn-success mx-1 btn-block" wire:click="konfirmasi({{$row->id}})" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Dokumentasi">
												<i class="fa fa-check"></i>
												Konfirmasi
											</button>
											@endif
											@elseif(auth()->user()->role == 'kedaruratan')
											@if(auth()->user()->id == $row->user_id)
											<a href="{{ asset('storage/dokumentasis/'.$row->pdf_laporan) }}" target="_blank"
											class="btn btn-primary mx-1 btn-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Laporan">
											<i class="feather-file-text"></i>
											</a>
											@if($row->status == 'pending')
											<a data-bs-toggle="modal" data-bs-target="#updateDataModal"
												class="btn btn-warning mx-1 btn-block" wire:click="edit({{$row->id}})" title="Edit Dokumentasi">
												<i class="feather-edit"></i>
											</a>
											<a class="btn btn-danger mx-1 btn-block"
												onclick="confirm('Confirm Delete Dokumentasi id {{$row->id}}? \nDeleted Dokumentasis cannot be recovered!')||event.stopImmediatePropagation()"
												wire:click="destroy({{$row->id}})" title="Hapus Dokumentasi">
												<i class="feather-trash"></i>
											</a>
											@endif
											@endif
											@else
											<a href="{{ asset('storage/dokumentasis/'.$row->pdf_laporan) }}" target="_blank"
											class="btn btn-primary mx-1 btn-block">
											<i class="feather-file-text"></i>
											Lihat Laporan</a>
											@endif
										</div>
									</div>									
								</div>
							</div>
						</div>
						@empty
						<div class="col-md-12">
							<div class="alert alert-warning">
								<h4 class="alert-heading">Tidak ada data!</h4>
								<p>Silahkan tambah data dokumentasi.</p>
								<hr>
								<p class="mb-0">Klik tombol tambah data untuk menambah data dokumentasi.</p>
							</div>
						</div>
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</div>