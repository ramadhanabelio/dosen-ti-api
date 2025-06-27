@extends('layouts.app')

@section('title', 'Daftar Dosen')

@section('content')
    <div class="pagetitle">
        <h1>Daftar Dosen</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Daftar Dosen</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Action</h6>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('lecturers.create') }}"><i
                                                class="bi bi-plus"></i> Tambah Dosen</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Daftar Dosen</h5>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>NIK</th>
                                            <th>Program Studi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lecturers as $index => $lecturer)
                                            <tr>
                                                <td>{{ $index + 1 }}.</td>
                                                <td>{{ $lecturer->name }}</td>
                                                <td>{{ $lecturer->nip }}</td>
                                                <td>{{ $lecturer->nik }}</td>
                                                <td>{{ $lecturer->prodi }}</td>
                                                <td>
                                                    <a href="{{ route('lecturers.show', $lecturer->id) }}"
                                                        class="badge bg-primary text-white"><i class="bi bi-eye"></i>
                                                        Detail</a>
                                                    <a href="{{ route('lecturers.edit', $lecturer->id) }}"
                                                        class="badge bg-warning text-dark"><i class="bi bi-pencil-fill"></i>
                                                        Edit</a>
                                                    <form action="{{ route('lecturers.destroy', $lecturer->id) }}"
                                                        method="POST" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="badge bg-danger text-white border-0"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                                class="bi bi-trash-fill"></i> Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $lecturers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
