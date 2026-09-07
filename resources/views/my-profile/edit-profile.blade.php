@extends('layouts.vertical', ['title' => 'Edit Profile','subTitle' => 'Edit Profile'])

@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#profile_personal_info" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                        <span class="d-block d-sm-none"><i class="bx bx-home"></i></span>
                        <span class="d-none d-sm-block">Personal Info</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile_credential_info" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                        <span class="d-block d-sm-none"><i class="bx bx-user"></i></span>
                        <span class="d-none d-sm-block">Credential Info</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content text-muted">
                <div class="tab-pane show active" id="profile_personal_info">
                    @include('my-profile.partials._edit-personal-info')
                </div>
                <div class="tab-pane" id="profile_credential_info">
                    @include('my-profile.partials._edit-credential-info')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('module-right-section')
    {!! generate_back_to_list_button(route('my_profile')) !!}
@endsection

@push('script')
    <script>
        window.loggedInEmployeeData = @json(get_logged_in_user_employee_data());
    </script>
    @vite(['resources/js/pages/my-profile.js'])
@endpush
