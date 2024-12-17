@extends('layouts.app')

@section('text-header', 'Komputer')

@section('breadcrumb')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Computer</li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
    @include('pages.computer.components.modal-create')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ada kesalahan pada form input!',
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Komputer</h3>

                    <div class="card-tools d-flex align-items-center" style="gap: 10px;">
                        <div>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCreate"><i class="fas fa-plus me-2"></i> &nbsp; <span>Tambah</span></button>
                        </div>
                        <form action="{{ route('computers.index') }}" method="get">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="q" class="form-control float-right" placeholder="Cari">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3 table-responsive p-0" style="min-height: 300px;">
                    <table class="table table-bordered table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Komputer</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($computers as $item)
                            <tr>
                                <td>{{ ($computers->currentPage() - 1) * $computers->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                {{-- <td>
                                    @if ($item->status == \App\Models\Computer::STATUS_AVAILABLE)
                                    <span class="badge badge-success">Tersedia</span>
                                    @elseif ($item->status == \App\Models\Computer::STATUS_AVAILABLE)
                                    <span class="badge badge-secondary">Digunakan</span>
                                    @else
                                    <span class="badge badge-warning">Maintenance</span>
                                    @endif
                                </td> --}}
                                <td>
                                    <form action="{{ route('computers.update-status', $item->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <div>
                                            <select name="status" class="form-control" style="border-color: {{ $item->status == \App\Models\Computer::STATUS_AVAILABLE ? 'lightgreen' : ($item->status == \App\Models\Computer::STATUS_MAINTENANCE ? 'yellow' : '') }}" onchange="this.form.submit()">
                                                @foreach ([
                                                    (object) [
                                                        "label" => "Tersedia",
                                                        "value" => "available",
                                                    ],
                                                    (object) [
                                                        "label" => "Digunakan",
                                                        "value" => "in_use",
                                                    ],
                                                    (object) [
                                                        "label" => "Maintenance",
                                                        "value" => "maintenance",
                                                    ],
                                                ] as $status)
                                                    <option value="{{ $status->value }}" @selected($status->value == $item->status)>
                                                        {{ $status->label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-warning me-2" data-toggle="modal" data-target="#modalEdit-{{ $item->id }}">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.computer.components.modal-edit')
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    {{ $computers->links('pagination::bootstrap-5') }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
