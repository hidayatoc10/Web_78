@extends('../layouts/sidebar')

@section('container')
    <link href="../vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <div class="main-content">
        <div class="title">
            Data Guru
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h4>Guru</h4>
                                <div>
                                    <button class="btn btn-primary btn-sm me-2" onclick="location.reload();">
                                        <i class="ti ti-reload"></i> Refresh
                                    </button>
                                    <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target="#modal_tambah_guru">
                                        <i class="ti ti-plus"></i> Tambah guru
                                    </button>
                                    <button class="btn btn-secondary btn-sm" onclick="printTable()">
                                        <i class="ti ti-printer"></i> Export
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
                                            <th>Name</th>
                                            <th>Nip</th>
                                            <th>Mata pelajaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->mata_pelajaran->nama_pelajaran }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" title="Edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_edit_guru_{{ $item->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal_edit_guru_{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="modal_edit_guruLabel_{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modal_edit_guruLabel_{{ $item->id }}">Edit Guru
                                                                {{ $item->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('update_guru', $item->nip) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label"><i
                                                                            class="fas fa-user"></i> Nama</label>
                                                                    <input type="text" placeholder="Masukkan nama"
                                                                        class="form-control @error('name') is-invalid @enderror"
                                                                        name="name" id="name"
                                                                        value="{{ old('name', $item->name) }}" required>
                                                                    @error('name')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nip" class="form-label"><i
                                                                            class="fas fa-id-card-alt"></i> NIP</label>
                                                                    <input type="text" placeholder="Masukkan NIP"
                                                                        class="form-control @error('nip') is-invalid @enderror"
                                                                        name="nip" id="nip"
                                                                        value="{{ old('nip', $item->nip) }}" required>
                                                                    @error('nip')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="no_telp" class="form-label"><i
                                                                            class="fas fa-phone-alt"></i> No Telp</label>
                                                                    <input type="text" placeholder="Masukkan No Telp"
                                                                        class="form-control @error('no_telp') is-invalid @enderror"
                                                                        name="no_telp" id="no_telp"
                                                                        value="{{ old('no_telp', $item->no_telp) }}"
                                                                        required>
                                                                    @error('no_telp')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="mapel_id" class="form-label"><i
                                                                            class="fas fa-book"></i> Mata Pelajaran</label>
                                                                    <select
                                                                        class="form-select @error('mapel_id') is-invalid @enderror"
                                                                        name="mapel_id" id="mapel_id" required>
                                                                        @foreach ($mapel as $mapelItem)
                                                                            <option value="{{ $mapelItem->id }}"
                                                                                @if ($item->mapel_id == $mapelItem->id) selected @endif>
                                                                                {{ $mapelItem->nama_pelajaran }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('mapel_id')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jenis_kelamin" class="form-label"><i
                                                                            class="fas fa-genderless"></i> Jenis
                                                                        Kelamin</label>
                                                                    <select
                                                                        class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                                        name="jenis_kelamin" id="jenis_kelamin" required>
                                                                        <option value="Laki Laki"
                                                                            @if ($item->jenis_kelamin == 'Laki Laki') selected @endif>
                                                                            Laki Laki</option>
                                                                        <option value="Perempuan"
                                                                            @if ($item->jenis_kelamin == 'Perempuan') selected @endif>
                                                                            Perempuan</option>
                                                                    </select>
                                                                    @error('jenis_kelamin')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
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
    <div class="modal fade" id="modal_tambah_guru" tabindex="-1" aria-labelledby="modal_tambah_guruLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_tambah_guruLabel">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="tambah_guru" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-id-badge"></i> Nama
                            </label>
                            <input type="text" placeholder="Masukkan nama"
                                class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                value="{{ old('name') }}" autofocus required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">
                                <i class="fas fa-id-card-alt"></i> NIP
                            </label>
                            <input type="number" placeholder="Masukkan nip"
                                class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip"
                                value="{{ old('nip') }}" required>
                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label" <i class="ti-headphone-alt"></i> Nomor telepon
                            </label>
                            <input type="number" placeholder="Masukkan nomor telepon"
                                class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
                                id="no_telp" value="{{ old('no_telp') }}" required>
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mapel_id" class="form-label">
                                <i class="fas fa-chalkboard-teacher"></i> Mata pelajaran
                            </label>
                            <select class="form-select @error('mapel_id') is-invalid @enderror" name="mapel_id"
                                id="mapel_id" required>
                                <option value="" disabled selected>Pilih mata pelajaran</option>
                                @foreach ($mapel as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_pelajaran }}</option>
                                @endforeach
                            </select>
                            @error('mapel_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">
                                <i class="fas fa-venus-mars"></i> Jenis Kelamin
                            </label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                id="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="Laki Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
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
                text: 'Guru berhasil dihapus',
                confirmButtonText: 'Ok',
            });
        @endif
        @if (session('datatidaknemu'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Guru tidak ditemukan, coba lagi',
                confirmButtonText: 'Ok',
            });
        @endif
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-danger').forEach(button => {
                button.addEventListener('click', function() {
                    const name = this.closest('tr').querySelector('td:nth-child(2)')
                        .innerText;
                    const nip = this.closest('tr').querySelector('td:nth-child(3)')
                        .innerText;
                    Swal.fire({
                        title: "Peringatan",
                        text: `Apakah anda ingin menghapus guru "${name}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                `/hapus_guru/${encodeURIComponent(nip)}`;
                        }
                    });
                });
            });
        });
        @if (session('berhasiledit'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Guru berhasil diubah',
                confirmButtonText: 'Ok',
            });
        @endif
    </script>
@endsection
