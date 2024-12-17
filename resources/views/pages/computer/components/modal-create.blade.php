<div class="modal fade" id="modalCreate" style="display: none;" aria-hidden="true">
    <form action="{{ route('computers.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Komputer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="form-label">Nama Komputer</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
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
                                ] as $item)
                                    <option value="{{ $item->value }}">{{ $item->label }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
