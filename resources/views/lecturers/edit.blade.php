@extends('layouts.app')

@section('title', 'Edit Dosen')

@section('content')
    <div class="pagetitle">
        <h1>Edit Dosen</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('lecturers.index') }}">Daftar Dosen</a>
                </li>
                <li class="breadcrumb-item active">Edit Dosen</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Dosen</h5>
                        <form action="{{ route('lecturers.update', $lecturer->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $lecturer->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $lecturer->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nip" class="form-label">Nomor Induk Pegawai</label>
                                <input type="text" name="nip" id="nip"
                                    class="form-control @error('nip') is-invalid @enderror"
                                    value="{{ old('nip', $lecturer->nip) }}" required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nik" class="form-label">Nomor Induk Karyawan (Opsional)</label>
                                <input type="text" name="nik" id="nik"
                                    class="form-control @error('nik') is-invalid @enderror"
                                    value="{{ old('nik', $lecturer->nik) }}">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="prodi" class="form-label">Program Studi</label>
                                <select name="prodi" id="prodi"
                                    class="form-select @error('prodi') is-invalid @enderror" required>
                                    <option value="">Pilih Program Studi</option>
                                    @foreach ($studyPrograms as $prodi)
                                        <option value="{{ $prodi }}"
                                            {{ old('prodi', $lecturer->prodi) == $prodi ? 'selected' : '' }}>
                                            {{ $prodi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="photo" class="form-label">Foto (Opsional)</label>
                                <input type="file" name="photo" id="photo"
                                    class="form-control @error('photo') is-invalid @enderror">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($lecturer->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $lecturer->photo) }}" alt="Foto Dosen"
                                            class="img-thumbnail" width="100">
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('lecturers.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
