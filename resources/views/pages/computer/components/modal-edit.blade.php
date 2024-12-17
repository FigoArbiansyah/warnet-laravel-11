<div class="modal fade" id="modalEdit-{{ $item->id }}" style="display: none;" aria-hidden="true">
    <form action="{{ route('computers.update', $item->id) }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Komputer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name_update" class="form-label">Nama Komputer</label>
                            <input type="text" id="name_update" name="name_update" class="form-control @error('name_update') is-invalid @enderror" value="{{ old('name_update', $item->name) }}">
                            @error('name_update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="status_update" class="form-label">Status</label>
                            <select name="status_update" id="status_update" class="form-control @error('status_update') is-invalid @enderror">
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
                                    <option value="{{ $status->value }}" @selected($item->status == $status->value)>{{ $status->label }}</option>
                                @endforeach
                            </select>
                            @error('status_update')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
