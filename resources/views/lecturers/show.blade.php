@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
    <div class="pagetitle">
        <h1>Detail Dosen</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('lecturers.index') }}">Daftar Dosen</a>
                </li>
                <li class="breadcrumb-item active">Detail Dosen</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Dosen</h5>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if ($lecturer->photo)
                                    <img src="{{ asset('storage/' . $lecturer->photo) }}" alt="Foto Dosen"
                                        class="img-fluid rounded-circle mb-3"
                                        style="width: 200px; height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 200px; height: 200px; margin: 0 auto;">
                                        <i class="bi bi-person-fill" style="font-size: 5rem;"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="width: 30%">Nama Lengkap</th>
                                                <td>{{ $lecturer->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $lecturer->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Induk Pegawai</th>
                                                <td>{{ $lecturer->nip ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Induk Karyawan</th>
                                                <td>{{ $lecturer->nik ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Program Studi</th>
                                                <td>{{ $lecturer->prodi ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('lecturers.edit', $lecturer->id) }}" class="btn btn-warning me-2">
                                        <i class="bi bi-pencil-fill"></i> Edit Data
                                    </a>
                                    <form action="{{ route('lecturers.destroy', $lecturer->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash-fill"></i> Hapus Data
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
