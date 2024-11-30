@extends('../layouts/sidebar')

@section('container')
    <link href="../vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <div class="main-content">
        <div class="title">
            Data Kelas
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h4 class="mb-3 mb-md-0">Kelas</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="btn btn-primary btn-sm" onclick="location.reload();">
                                        <i class="ti ti-reload"></i> Refresh
                                    </button>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal_tambah_kelas">
                                        <i class="ti ti-plus"></i> Tambah Kelas
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table display nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Tambah</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kelas }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" title="Edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_edit_kelas_{{ $item->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
    @foreach ($data as $item)
        <div class="modal fade" id="modal_edit_kelas_{{ $item->id }}" tabindex="-1"
            aria-labelledby="modal_edit_kelasLabel_{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_edit_kelasLabel_{{ $item->id }}">Edit Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="update_kelas/{{ $item->kelas }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_kelas_{{ $item->id }}" class="form-label">
                                    <i class="fas fa-chalkboard"></i> Kelas
                                </label>
                                <input type="text" placeholder="Masukkan Kelas"
                                    class="form-control @error('kelas') is-invalid @enderror" name="kelas"
                                    id="edit_kelas_{{ $item->id }}" value="{{ $item->kelas }}" required>
                                @error('kelas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="edit_keterangan_{{ $item->id }}" class="form-label">
                                    <i class="fas fa-info-circle"></i> Keterangan
                                </label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan"
                                    name="keterangan" id="edit_keterangan_{{ $item->id }}" rows="3" required>{{ $item->keterangan }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="modal_tambah_kelas" tabindex="-1" aria-labelledby="modal_tambah_kelasLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_tambah_kelasLabel">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tambah_kelas') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">
                                <i class="fas fa-chalkboard"></i> Kelas
                            </label>
                            <input type="text" placeholder="Masukkan Kelas"
                                class="form-control @error('kelas') is-invalid @enderror" name="kelas" id="kelas"
                                value="{{ old('kelas') }}" autofocus required>
                            @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">
                                <i class="fas fa-info-circle"></i> Keterangan
                            </label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan"
                                name="keterangan" id="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
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
    {{-- <script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Main.init()
    </script>
    <script>
        DataTable.init()
    </script>
    <script>
        @if ($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('modal_tambah_kelas'), {});
            myModal.show();
        @endif
        @if ($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('modal_edit_kelas'), {});
            myModal.show();
        @endif
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
                text: 'Kelas berhasil dihapus',
                confirmButtonText: 'Ok',
            });
        @endif
        @if (session('datatidaknemu'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Kelas tidak ditemukan, coba lagi',
                confirmButtonText: 'Ok',
            });
        @endif
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-danger').forEach(button => {
                button.addEventListener('click', function() {
                    const kelas = this.closest('tr').querySelector('td:nth-child(2)')
                        .innerText;
                    Swal.fire({
                        title: "Peringatan",
                        text: `Apakah anda ingin menghapus kelas "${kelas}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                `/hapus_kelas/${encodeURIComponent(kelas)}`;
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
    </script>
@endsection
