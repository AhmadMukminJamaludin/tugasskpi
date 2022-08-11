@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col">
                                    <h4>Makanan</h4>
                                </div>
                                <div class="col text-end">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal_tambah">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama makanan</th>
                                    <th>Jenis makanan</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list_data as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td>{{ $item->nama_makanan }}</td>
                                        <td>{{ $item->jenis_makanan }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td class="text-center">
                                            @if ($item->is_tersedia == 1)
                                                <span class="badge bg-success">Tersedia</span>
                                            @else
                                                <span class="badge bg-warning">Tidak tersedia</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('foods.destroy', $item->id) }}" method="post">
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_{{ $item->id }}" type="button">Edit</button>
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Data kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah makanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('foods.store') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Nama makanan</label>
                            <input type="text" name="nama_makanan" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Jenis makanan</label>
                            <select name="jenis_makanan" id="" class="form-control form-control-sm">
                                <option value="">--</option>
                                <option value="Makanan berat">Makanan berat</option>
                                <option value="Makanan ringan">Makanan ringan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Harga</label>
                            <input type="number" name="harga" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Apakah tersedia?</label>
                            <div class="row">
                                <div class="col d-flex">
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" name="is_tersedia" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        Tersedia
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" name="is_tersedia" id="flexRadioDefault2" value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                        Tidak tersedia
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Deskripsi makanan</label>
                            <textarea name="deskripsi" class="form-control form-control-sm" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($list_data as $value)
    <div class="modal fade" id="modal_edit_{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit makanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('foods.update', $value->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Nama makanan</label>
                            <input type="text" name="nama_makanan" id="" class="form-control form-control-sm" value="{{ $value->nama_makanan }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Jenis makanan</label>
                            <select name="jenis_makanan" id="" class="form-control form-control-sm">
                                <option value="Makanan berat" {{ ($value->jenis_makanan == 'Makanan berat') ? 'selected' : '' }}>Makanan berat</option>
                                <option value="Makanan ringan" {{ ($value->jenis_makanan == 'Makanan ringan') ? 'selected' : '' }}>Makanan ringan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Harga</label>
                            <input type="number" name="harga" id="" class="form-control form-control-sm" value="{{ $value->harga }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Apakah tersedia?</label>
                            <div class="row">
                                <div class="col d-flex">
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" name="is_tersedia" id="flexRadioDefault1" value="1" {{ ($value->is_tersedia == 1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        Tersedia
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" name="is_tersedia" id="flexRadioDefault2" value="0" {{ ($value->is_tersedia == 0) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                        Tidak tersedia
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Deskripsi makanan</label>
                            <textarea name="deskripsi" class="form-control form-control-sm" id="" cols="30" rows="5">{{ $value->deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection