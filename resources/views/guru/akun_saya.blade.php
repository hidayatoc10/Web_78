@extends('../layouts/sidebar_guru')

@section('container')
    <div class="main-content">
        <div class="title">
            Dashboard
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Akun {{ auth()->user()->keterangan }}</h4>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table display nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ auth()->user()->name }}</td>
                                        <td>{{ auth()->user()->username }}</td>
                                        <td>{{ auth()->user()->email }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" title="Edit" data-bs-toggle="modal"
                                                data-bs-target="#modal_edit_akun_{{ auth()->user()->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <style>
                            .h7 {
                                color: red;
                                margin-left: 20px;
                                margin-bottom: 5px;
                            }

                            .h8 {
                                color: red;
                                margin-left: 20px;
                                margin-bottom: 20px;
                            }
                        </style>
                        <h6 style="font-weight: bold;color: red; margin-left: 20px;">Note*</h6>
                        <h7 class="h7">- Sebelum mengubah akun, harap konfirmasi terlebih dahulu.</h7>
                        <h7 class="h7">- Pastikan perubahan akun dilakukan dengan benar.</h7>
                        <h7 class="h7">- Hanya ubah akun jika ada masalah.</h7>
                        <h7 class="h8">- Akun ini adalah super {{ auth()->user()->keterangan }}.</h7>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_edit_akun_{{ auth()->user()->id }}" tabindex="-1"
        aria-labelledby="modal_edit_akunLabel_{{ auth()->user()->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Akun Saya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_update_akun" action="{{ route('update_akunn', auth()->user()->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="old_password" class="form-label">
                                <i class="fas fa-lock"></i> Password Lama
                            </label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> Nama
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Password Baru
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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
        @if ($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('modal_edit_akun'), {});
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
        
        document.getElementById('form_update_akun').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Peringatan",
                text: "Apakah anda yakin ingin mengubah akun ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok',
            });
        @endif
        @if (session('old_password'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Password lama yang Anda masukkan salah.',
                confirmButtonText: 'Ok',
            });
        @endif
    </script>
@endsection
