@extends('../layouts/sidebar')

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
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table display nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Guru</th>
                                            <th>Kelas</th>
                                            <th>Judul Materi</th>
                                            <th>Descripsi</th>
                                            <th>Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->user->name }}</td>
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
                                                                        Tambah Data
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
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="judul_materi"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-user me-2"></i> Nama Guru
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->user->name }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary">
                                                                <a href="{{ $filePath }}"
                                                                    download="{{ basename($item->upload_materi) }}"
                                                                    style="text-decoration: none; color: white;">
                                                                    Unduh Gambar
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
                    const materi = this.closest('tr').querySelector('td:nth-child(4)')
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
                                `/hapus_materii/${encodeURIComponent(materi)}`;
                        }
                    });
                });
            });
        });
    </script>
@endsection
