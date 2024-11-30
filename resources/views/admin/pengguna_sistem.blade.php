@extends('../layouts/sidebar')

@section('container')
    <link href="../vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <div class="main-content">
        <div class="title">
            Data Pengguna Sistem
        </div>
        <div class="modal fade" id="modal_tambah_pengguna" tabindex="-1" aria-labelledby="modal_tambah_penggunaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_tambah_penggunaLabel">Tambah Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('tambah_pengguna') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-id-card"></i> Nama
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
                                <label for="username" class="form-label">
                                    <i class="fas fa-circle"></i> Username
                                </label>
                                <input type="text" placeholder="Masukkan Username"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    id="username" value="{{ old('username') }}" autofocus required>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email" placeholder="Masukkan email"
                                    class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Masukkan password" required>
                                    <button class="input-group-text bg-light" id="showHidePw" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="password_error" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">
                                    <i class="fas fa-user-tag"></i> Keterangan
                                </label>
                                <select class="form-select @error('keterangan') is-invalid @enderror" name="keterangan"
                                    id="keterangan" required>
                                    <option value="" disabled selected>Pilih Keterangan</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Guru">Guru</option>
                                    <option value="Murid">Murid</option>
                                </select>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h4>Pengguna Sistem</h4>
                                <div>
                                    <button class="btn btn-primary btn-sm me-2" onclick="location.reload();">
                                        <i class="ti ti-reload"></i> Refresh
                                    </button>
                                    <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target="#modal_tambah_pengguna">
                                        <i class="ti ti-plus"></i> Tambah Pengguna
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
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" title="Edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_edit_pengguna_{{ $item->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-success" title="View"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_view_pengguna_{{ $item->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button </td>
                                            </tr>
                                            <div class="modal fade" id="modal_edit_pengguna_{{ $item->id }}"
                                                tabindex="-1"
                                                aria-labelledby="modal_edit_penggunaLabel_{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modal_edit_penggunaLabel_{{ $item->id }}">Edit
                                                                Pengguna
                                                                {{ $item->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('update_pengguna', $item->username) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">
                                                                        <i class="fas fa-id-card"></i> Nama
                                                                    </label>
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
                                                                    <label for="username" class="form-label">
                                                                        <i class="fas fa-circle"></i> Username
                                                                    </label>
                                                                    <input type="text" placeholder="Masukkan nama"
                                                                        class="form-control @error('username') is-invalid @enderror"
                                                                        name="username" id="username"
                                                                        value="{{ old('username', $item->username) }}"
                                                                        required>
                                                                    @error('username')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">
                                                                        <i class="fas fa-envelope"></i> Email
                                                                    </label>
                                                                    <input type="email" placeholder="Masukkan email"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        name="email" id="email"
                                                                        value="{{ old('email', $item->email) }}" required>
                                                                    @error('email')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password" class="form-label">
                                                                        <i class="fas fa-lock"></i> Password
                                                                    </label>
                                                                    <input type="password" placeholder="Masukkan password"
                                                                        class="form-control @error('password') is-invalid @enderror"
                                                                        name="password" id="password" required>
                                                                    @error('password')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="keterangan" class="form-label">
                                                                        <i class="fas fa-user-tag"></i> Keterangan
                                                                    </label>
                                                                    <select
                                                                        class="form-select @error('keterangan') is-invalid @enderror"
                                                                        name="keterangan" id="keterangan" required>
                                                                        <option value="Admin"
                                                                            @if ($item->keterangan == 'Admin') selected @endif>
                                                                            Admin</option>
                                                                        <option value="Guru"
                                                                            @if ($item->keterangan == 'Guru') selected @endif>
                                                                            Guru</option>
                                                                        <option value="Murid"
                                                                            @if ($item->keterangan == 'Murid') selected @endif>
                                                                            Murid</option>
                                                                    </select>
                                                                    @error('keterangan')
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
                                            <div class="modal fade" id="modal_view_pengguna_{{ $item->id }}"
                                                tabindex="-1"
                                                aria-labelledby="modal_view_penggunaLabel_{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modal_view_penggunaLabel_{{ $item->id }}">
                                                                Detail Pengguna {{ $item->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="id"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-id-card me-2"></i> ID
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->id }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="name"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-user me-2"></i> Nama
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->name }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="email"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-envelope me-2"></i> Email
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->email }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 
                                                            <div class="col-md-6
                                                                    mb-3">
                                                                    <label for="keterangan"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-user-tag me-2"></i> Keterangan
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->keterangan }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="created_at"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-calendar-alt me-2"></i>
                                                                        Tanggal
                                                                        Regis
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->created_at->format('d-m-Y H:i') }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="updated_at"
                                                                        class="form-label d-flex align-items-center">
                                                                        <i class="fas fa-sync-alt me-2"></i> Tanggal
                                                                        Update
                                                                    </label>
                                                                    <p class="form-control-plaintext">
                                                                        {{ $item->updated_at->format('d-m-Y H:i') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
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
    <script>
        @if ($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('modal_tambah_pengguna'), {});
            myModal.show();
        @endif
        @if ($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('modal_edit_pengguna'), {});
            myModal.show();
        @endif
    </script>
@endsection
@section('scripts')
    @parent
    <script>
        document.getElementById('showHidePw').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var icon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        });

        function cekPassword() {
            var password = document.getElementById("password").value;
            var errorContainer = document.getElementById("password_error");
            errorContainer.innerHTML = '';

            var temp = '';
            if (password.length < 8) {
                temp += '<p class="mb-0"><strong>- Minimal 8 karakter</strong></p>';
                console.log("kurang");

            }
            if (password.length > 100) {
                temp += '<p class="mb-0"><strong>- Maximal 100 karakter</strong></p>';
            }
            if (!/\d/.test(password)) {
                temp += '<p class="mb-0"><strong>- Harus memiliki angka</strong></p>';
            }
            if (!/[A-Z]/.test(password)) {
                temp += '<p class="mb-0"><strong>- Harus memiliki huruf kapital</strong></p>';
            }
            if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password)) {
                temp += '<p class="mb-0"><strong>- Harus terdapat karakter khusus</strong></p>';
            }

            if (temp !== '') {
                errorContainer.innerHTML = temp;
                errorContainer.style.display = 'block';
            } else {
                errorContainer.style.display = 'none';
            }
        }
        document.getElementById('password').addEventListener('keyup', cekPassword);

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok',
            });
        @endif
        @if (session('berhasiledit'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Pengguna sistem berhasil diupdate',
                confirmButtonText: 'Ok',
            });
        @endif
        @if (session('berhasil_hapus'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Pengguna sistem berhasil dihapus',
                confirmButtonText: 'Ok',
            });
        @endif
        @if (session('datatidaknemu'))
            Swal.fire({
                icon: 'error',
                title: 'Peringatan',
                text: 'Pengguna sistem tidak ditemukan',
                confirmButtonText: 'Ok',
            });
        @endif
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-danger').forEach(button => {
                button.addEventListener('click', function() {
                    const nisn = this.closest('tr').querySelector('td:nth-child(3)')
                        .innerText;
                    const name = this.closest('tr').querySelector('td:nth-child(2)')
                        .innerText;
                    Swal.fire({
                        title: "Peringatan",
                        text: `Apakah anda ingin menghapus pengguna "${name}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                `/hapus_pengguna/${encodeURIComponent(nisn)}`;
                        }
                    });
                });
            });
        });
    </script>
@endsection
