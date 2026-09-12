@extends('layouts.vertical', ['title' => 'View Team Member','subTitle' => 'View Team Member'])
@section('css')
    @vite('resources/css/team-members.css')
@endsection
@section('content')
    @php
        $member_photo = asset('images/users/dummy-avatar.jpg');
        if(!empty($member_info['emp_photo'])) {
            $member_photo = asset('storage/employees/'. $member_info['emp_photo']);
        }
    @endphp

    <div class="card p-2" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-2">
                            @if(!empty($member_info['emp_photo']))
                                <a href="{{$member_photo}}" target="_blank">
                                    @endif
                                    <img src="{{$member_photo}}"
                                         class="avatar-lg rounded-3 border border-light border-3"
                                         style="height: 120px; width: 120px; border-radius: 50% !important;">
                                    @if(!empty($member_info['emp_photo']))
                                </a>
                            @endif
                        </div>
                        <div class="col-md-10 align-content-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="fs-4 text-dark fw-bold">{{$member_info['emp_full_name']}}</span>
                                </div>
                                <div class="col-md-12"><span
                                        class="fs-5">{{\App\Enums\DesignationEnum::tryFrom($member_info['emp_designation'])->label()}}</span>
                                </div>
                                <div class="col-md-12"><span style="font-size: 14px"><iconify-icon
                                            icon="solar:letter-broken" class="align-middle fs-5"></iconify-icon> {{$member_info['emp_email']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-end align-content-center">
                    {!! \App\Enums\UserRoleEnum::tryFrom($member_info['admin_user_details']['adm_role'])->badge() !!}
                </div>
            </div>
        </div>
    </div>
    {{--    Statics card   --}}
    <div class="row g-3 mb-4">
        <!-- Active -->
        <div class="col-6 col-lg-3">
            <div class="team-stat-card stat-purple">
                <div class="team-stat-icon">
                    <i class="bi bi-list-task"></i>
                </div>
                <div class="team-stat-number">
                    8
                </div>
                <div class="team-stat-label">
                    Active Tasks
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="col-6 col-lg-3">
            <div class="team-stat-card stat-green">
                <div class="team-stat-icon">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <div class="team-stat-number">
                    47
                </div>
                <div class="team-stat-label">
                    Completed
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-6 col-lg-3">
            <div class="team-stat-card stat-yellow">
                <div class="team-stat-icon">
                    <i class="bi bi-fire"></i>
                </div>
                <div class="team-stat-number">
                    3
                </div>
                <div class="team-stat-label">
                    Pending
                </div>
            </div>
        </div>

        <!-- Completion -->
        <div class="col-6 col-lg-3">
            <div class="team-stat-card stat-pink">
                <div class="team-stat-icon">
                    <i class="bi bi-percent"></i>
                </div>
                <div class="team-stat-number">
                    81%
                </div>
                <div class="team-stat-label">
                    Completion Rate
                </div>
            </div>
        </div>
    </div>

    {{--  Task Table  --}}
    <div class="card">
        <div class="card-header">
            <span class="fs-5 fw-bold">Assigned Tasks</span>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle text-nowrap table-hover table-centered mb-0">
                    <thead class="table-light">
                    <tr>
                        <th width="4%">Sr. no.</th>
                        <th width="30%">Task</th>
                        <th width="15%">Project</th>
                        <th width="12%">Priority</th>
                        <th width="12%">Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1.{{--{{$loop->iteration}}--}}.</td>
                        <td>Redesign user authentication flow</td>
                        <td>Assignee</td>
                        <td>Priority</td>
                        <td>Due Date</td>
                        <td>Status</td>
                        <td>
                            <div class="d-flex gap-2">
                                {!! generate_view_button(route('employees.view', ['emp_id' => my_encrypt(1)])) !!}
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('module-right-section')
    @php
        if($called_from == 'project_team' && !empty($pro_id))
            $back_url = route('project.view',['pro_id' => $pro_id]);
        else
            $back_url = route('team_members.list');
    @endphp

    {!! generate_back_to_list_button($back_url) !!}
@endsection
