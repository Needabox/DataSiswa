@extends('layouts.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Data Siswa</h3>
                        </div>
                        <div class="panel-body">
                            <form action=" {{ route('siswa.update', ['id' => $siswa->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_depan">Nama Depan</label>
                                    <input name="nama_depan" id="nama_depan" type="text" class="form-control" value="{{ $siswa->nama_depan}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_belakang">Nama Belakang</label>
                                    <input name="nama_belakang" id="nama_belakang" type="text" class="form-control" value="{{ $siswa->nama_belakang}}">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                        <option value="" >Pilih Jenis Kelamin</option>
                                        <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
                                        <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input name="agama" id="agama" type="text" class="form-control" value="{{ $siswa->agama}}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" type="text" class="form-control">{{ $siswa->alamat}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" name="avatar" id="avatar" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <a href="{{ route('siswa') }}" class="btn btn-primary btn-sm">Kembali</a>
                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@top
@endsection
@section('content1') 
    <div class="card mt-5">
        <div class="card-header">
            <h3>Edit Siswa</h3>
        </div>
            <div class="card-body">
                    <form action=" {{ route('siswa.update', ['id' => $siswa->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_depan">Nama Depan</label>
                            <input name="nama_depan" id="nama_depan" type="text" class="form-control" value="{{ $siswa->nama_depan}}">
                        </div>
                        <div class="form-group">
                            <label for="nama_belakang">Nama Belakang</label>
                            <input name="nama_belakang" id="nama_belakang" type="text" class="form-control" value="{{ $siswa->nama_belakang}}">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="" >Pilih Jenis Kelamin</option>
                                <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
                                <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <input name="agama" id="agama" type="text" class="form-control" value="{{ $siswa->agama}}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" type="text" class="form-control">{{ $siswa->alamat}}</textarea>
                        </div>
                    </div>
                        <div class="form-group mb-0">
                            <a href="{{ route('siswa') }}" class="btn btn-primary btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                </form>
            </div>
@endsection