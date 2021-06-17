@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data Siswa</h3>
                                <div class="right">
                                     <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
                                </div>
                            </div>
                            @if (session()->has('message'))
                            <div class="alert alert-success">
                                <strong>{{ session()->get('message') }}</strong>
                                <button class="close" type="button" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="panel-body">
                                <table class="table table-hover table-stripped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>Alamat</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $s)
                                        <tr>
                                            <td><a href="{{ route('siswa.profile', ['id' => $s->id]) }}">{{$s->nama_depan. " ". $s->nama_belakang}}</a></td>
                                            <td class="text-align: center">{{ $s->jenis_kelamin }}</td>
                                            <td>{{ $s->agama }}</td>
                                            <td>{{ $s->alamat}}</td>
                                            <td>
                                                <a href="{{ route('siswa.hapus', ['id' => $s->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus {{$s->nama_depan}} {{$s->nama_belakang}} ?')">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form action=" {{ route('siswa.tambah') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('nama_depan') ? 'has-error' : '' }}">
                        <label for="nama_depan">Nama Depan</label>
                        <input name="nama_depan" id="nama_depan" type="text" class="form-control" placeholder="Masukan nama depan" value="{{ old('nama_depan') }}">
                        @if($errors->has('nama_depan'))
                            <span class="help-block">{{ $errors->first('nama_depan') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nama_belakang">Nama Belakang</label>
                        <input name="nama_belakang" id="nama_belakang" type="text" class="form-control" placeholder="Masukan nama belakang">
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email</label>
                        <input name="email" id="email" type="email" class="form-control" placeholder="Masukan Email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="" >Pilih Jenis Kelamin</option>
                            <option value="L"{{ (old('jenis_kelamin') == 'L') ? 'selected' : ''}}>Laki-Laki</option>
                            <option value="P"{{ (old('jenis_kelamin') == 'P') ? 'selected' : ''}}>Perempuan</option>
                        </select>
                        @if($errors->has('jenis_kelamin'))
                        <span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                        <label for="agama">Agama</label>
                        <input name="agama" id="agama" type="text" class="form-control" placeholder="Masukan Agama" value="{{ old('nama_depan') }}">
                        @if($errors->has('agama'))
                        <span class="help-block">{{ $errors->first('agama') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" type="text" class="form-control" placeholder="Masukan alamat"></textarea>
                        @if($errors->has('alamat'))
                        <span class="help-block">{{ $errors->first('alamat') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="form-control">
                        @if($errors->has('avatar'))
                        <span class="help-block">{{ $errors->first('avatar') }}</span>
                        @endif
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@top
@endsection