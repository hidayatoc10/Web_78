@extends('../layouts/sidebar_guru')

@section('container')
    <style>
        .icon-large {
            font-size: 50px;
        }

        .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
    <div class="main-content">
        <div class="title">
            Dashboard
        </div>
        <div class="content-wrapper">
            <div class="row same-height justify-content-center">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-primary">UNGGAHAN</h6>
                                <h2>-</h2>
                            </div>
                            <i class="fas fa-file-upload text-primary icon-large"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-success">KELAS</h6>
                                <h2>{{ $totalKelas }}</h2>
                            </div>
                            <i class="fas fa-chalkboard-teacher text-success icon-large"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-info">TASKS</h6>
                                <h2>50%</h2>
                            </div>
                            <i class="fas fa-tasks text-info icon-large"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-warning">MATERI</h6>
                                <h2>{{ $totalMateri }}</h2>
                            </div>
                            <i class="fas fa-book text-warning icon-large"></i>
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
    <style>
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body h6 {
            font-size: 0.9rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .card-body h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .progress {
            height: 8px;
            border-radius: 5px;
            background-color: #e9ecef;
        }
    </style>
@endsection
