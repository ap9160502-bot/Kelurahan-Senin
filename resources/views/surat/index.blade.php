```blade
@extends('layouts.admin')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Pengajuan Surat Kelurahan</h3>

        <!-- Tombol Tambah -->
        <a href="{{ route('surat.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus-circle mr-1"></i> Tambah Pengajuan Surat
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('sukses') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="table-responsive mt-2">
        <table class="table table-striped table-bordered">
            <thead class="bg-light">
                <tr>
                    <th style="width:5%">No</th>
                    <th>No Surat</th>
                    <th>Jenis Surat</th>
                    <th>Nama Pemohon</th>
                    <th>NIK Pemohon</th>
                    <th>Tanggal Ajuan</th>
                    <th style="width:15%" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($semuaSurat as $index => $s)

                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $s->nomor_surat }}</td>
                    <td>{{ $s->jenis_surat }}</td>
                    <td><strong>{{ $s->penduduk->nama }}</strong></td>
                    <td>{{ $s->penduduk->nik }}</td>
                    <td>{{ \Carbon\Carbon::parse($s->tanggal_ajuan)->format('d-m-Y') }}</td>

                    <td class="text-center">

                        <a href="{{ route('surat.edit', $s->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('surat.destroy', $s->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data surat ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data pengajuan surat.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>
</div>
@endsection
```
