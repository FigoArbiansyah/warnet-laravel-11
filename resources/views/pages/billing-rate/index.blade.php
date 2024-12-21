@extends('layouts.app')

@section('text-header', 'Harga Per Jam')

@section('breadcrumb')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Billing Rate</li>
    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
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
                    <div class="card-title">
                        <h2 id="rateValue" class="fw-bold">
                            Rp. {{ number_format($price->rate, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3 table-responsive p-0">
                    <form action="{{ route('billing-rates.update', $price->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group d-flex">
                            <input id="rateInput" type="number" class="form-control" name="rate" value="{{ old('rate', (int) $price->rate) }}">
                            <button type="submit" class="btn btn-primary ms-2">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->

                {{-- <div class="card-footer">
                    {{ $computers->links('pagination::bootstrap-5') }}
                </div> --}}
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@push('scripts')
    <script>
        const rateValue = document.getElementById('rateValue');
        const rateInput = document.getElementById('rateInput');

        rateInput.addEventListener('input', (e) => {
            rateValue.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(e.target.value ?? 0)}`;
        });

    </script>
@endpush
