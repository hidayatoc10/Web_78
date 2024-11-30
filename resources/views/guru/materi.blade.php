@extends('../layouts/sidebar_guru')

@section('container')
    <link href="../vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <div class="main-content">
        <div class="title">
            Data Materi
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Materi</h4>
                            <div>
                                <button class="btn btn-primary btn-sm me-2" onclick="location.reload();">
                                    <i class="ti ti-reload"></i> Refresh
                                </button>
                                <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#modal_tambah_materi">
                                    <i class="ti ti-plus"></i> Tambah materi
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table display nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Judul Materi</th>
                                            <th>Gambar</th>
                                            <th>Descripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kelas->kelas }}</td>
                                                <td>{{ $item->judul_materi }}</td>
                                                <td>{{ $item->descripsi }}</td>
                                                <td>
                                                    @php
                                                        $filePath = asset(
                                                            'storage/img_tugas/' . basename($item->upload_materi),
                                                        );
                                                        $fileExtension = pathinfo(
                                                            $item->upload_materi,
                                                            PATHINFO_EXTENSION,
                                                        );
                                                    @endphp

                                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modal_image_{{ $item->id }}">
                                                            <img src="{{ $filePath }}" alt="Materi Image"
                                                                width="30%">
                                                        </a>
                                                    @else
                                                        <i class="fa fa-file" style="font-size: 40px;"></i>
                                                    @endif
                                                </td>
                                                <div class="modal fade" id="modal_image_{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">Gambar Materi</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ $filePath }}" alt="Materi Image"
                                                                    class="img-fluid" style="transform: scale(2);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" title="Edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_edit_materi_{{ $item->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-success" title="View"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_view_materi_{{ $item->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal_view_materi_{{ $item->id }}"
                                                tabindex="-1" aria-labelledby="modal_view_materiLabel_{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modal_view_materiLabel_{{ $item->id }}">
                                                                Detail materi {{ $item->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="id"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-id-card me-2"></i> ID
                                                                    </label>
                                                                    <p class="form-control-plaintext">{{ $item->id }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="judul_materi"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-user me-2"></i> Judul Materi
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->judul_materi }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="descripsi"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-envelope me-2"></i> Descripsi
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->descripsi }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="created_at"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-calendar-alt me-2"></i> Tanggal
                                                                        Regis
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->created_at->format('d-m-Y H:i') }}</p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="Gambar"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-envelope me-2"></i> Gambar
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        <img src="{{ $filePath }}"
                                                                            style="margin-top: 20%;margin-bottom: 20px;"
                                                                            alt="Materi Image" width="50%">
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary">
                                                                <a href="{{ $filePath }}"
                                                                    download="{{ basename($item->upload_materi) }}"
                                                                    style="text-decoration: none; color: white;">
                                                                    Unduh Materi
                                                                </a>
                                                            </button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

    <style>
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem 0;
                border: none;
            }

            .table tbody td:before {
                content: attr(data-label);
                font-weight: bold;
            }
        }

        .modal-body img {
            transform: scale(2);
            margin: auto;
            display: block;
        }
    </style>

    <div class="settings">
        <div class="settings-icon-wrapper">
            <div class="settings-icon">
                <i class="ti ti-settings"></i>
            </div>
        </div>
        <div class="settings-content">
            <ul>
                <li class="fix-header">
                    <div class="fix-header-wrapper">
                        <div class="form-check form-switch lg">
                            <label class="form-check-label" for="settingsFixHeader">Fixed Header</label>
                            <input class="form-check-input toggle-settings" name="Header" type="checkbox"
                                id="settingsFixHeader">
                        </div>

                    </div>
                </li>
                <li class="fix-footer">
                    <div class="fix-footer-wrapper">
                        <div class="form-check form-switch lg">
                            <label class="form-check-label" for="settingsFixFooter">Fixed Footer</label>
                            <input class="form-check-input toggle-settings" name="Footer" type="checkbox"
                                id="settingsFixFooter">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="theme-switch">
                        <label for="">Theme Color</label>
                        <div>
                            <div class="form-check form-check-inline lg">
                                <input class="form-check-input lg theme-color" type="radio" name="ThemeColor"
                                    id="light" value="light">
                                <label class="form-check-label" for="light">Light</label>
                            </div>
                            <div class="form-check form-check-inline lg">
                                <input class="form-check-input lg theme-color" type="radio" name="ThemeColor"
                                    id="dark" value="dark">
                                <label class="form-check-label" for="dark">Dark</label>
                            </div>

                        </div>
                    </div>
                </li>
                <li>
                    <div class="fix-footer-wrapper">
                        <div class="form-check form-switch lg">
                            <label class="form-check-label" for="settingsFixFooter">Collapse Sidebar</label>
                            <input class="form-check-input toggle-settings" name="Sidebar" type="checkbox"
                                id="settingsFixFooter">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="modal fade" id="modal_tambah_materi" tabindex="-1" aria-labelledby="modal_tambah_materiLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_tambah_materiLabel">Tambah Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tambah_materi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kelas_id" class="form-label">
                                <i class="fas fa-school"></i> Kelas
                            </label>
                            <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id"
                                id="kelas_id" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="matapelajaran_id" class="form-label">
                                <i class="fas fa-book"></i> Mata Pelajaran
                            </label>
                            <select class="form-select @error('matapelajaran_id') is-invalid @enderror"
                                name="matapelajaran_id" id="matapelajaran_id" required>
                                <option value="" disabled selected>Pilih Mata Pelajaran</option>
                                @foreach ($pelajaran as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_pelajaran }}</option>
                                @endforeach
                            </select>
                            @error('matapelajaran_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul_materi" class="form-label">
                                <i class="fas fa-chalkboard-teacher"></i> Judul Materi
                            </label>
                            <input type="text" placeholder="Masukkan judul materi"
                                class="form-control @error('judul_materi') is-invalid @enderror" name="judul_materi"
                                id="judul_materi" value="{{ old('judul_materi') }}" required>
                            @error('judul_materi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripsi" class="form-label">
                                <i class="fas fa-info-circle"></i> Descripsi
                            </label>
                            <textarea class="form-control @error('descripsi') is-invalid @enderror" placeholder="Masukkan descripsi"
                                name="descripsi" id="descripsi" rows="3">{{ old('descripsi') }}</textarea>
                            @error('descripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="upload_materi" class="form-label">
                                <i class="fas fa-upload"></i> Upload Materi
                            </label>
                            <input type="file" class="form-control @error('upload_materi') is-invalid @enderror"
                                name="upload_materi" id="upload_materi" required>
                            @error('upload_materi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="../assets/js/pages/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Main.init()
    </script>
    <script>
        DataTable.init()
    </script>
    <script>
        function printTable() {
            var printContents = document.getElementById('example').outerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = "<table>" + printContents + "</table>";
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
@section('scripts')
    @parent
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok',
            });
        @endif
        @if (session('berhasil_hapus'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'materi berhasil dihapus',
                confirmButtonText: 'Ok',
            });
        @endif
        @if (session('datatidaknemu'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'materi tidak ditemukan, coba lagi',
                confirmButtonText: 'Ok',
            });
        @endif
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-danger').forEach(button => {
                button.addEventListener('click', function() {
                    const materi = this.closest('tr').querySelector('td:nth-child(3)')
                        .innerText;
                    Swal.fire({
                        title: "Peringatan",
                        text: `Apakah anda ingin menghapus materi "${materi}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                `/hapus_materi/${encodeURIComponent(materi)}`;
                        }
                    });
                });
            });
        });
        @if (session('berhasiledit'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Kelas berhasil diubah',
                confirmButtonText: 'Ok',
            });
        @endif
        @if ($errors->has('upload_materi'))
            Swal.fire({
                icon: 'error',
                title: 'Gambar gagal diupload',
                text: 'Ekstensi file tidak valid! Hanya file dengan format .png, .jpeg, .jpg, .pdf, .docx yang dapat diunggah.',
                confirmButtonText: 'Ok',
            });
        @endif
    </script>
@endsection
