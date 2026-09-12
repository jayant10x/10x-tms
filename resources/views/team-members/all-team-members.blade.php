@extends('layouts.vertical', ['title' => 'Team Members','subTitle' => 'Team Members'])
@section('content')
    <style>
        .member-task-count {
            background: #f5f6f8;
            text-align: center;
            /*margin: 0 5px 0 3px;*/
            padding: 10px 0 10px;
            border-radius: 8px;
        }
    </style>
    @if(!empty($all_team_members))
        <div class="row">
            @foreach($all_team_members as $member_key => $member_val)
                @php
                    $emp_photo = asset('images/users/dummy-avatar.jpg');
                    if(!empty($member_val['emp_photo'])) {
                        $emp_photo = asset('storage/employees/'. $member_val['emp_photo']);
                    }
                @endphp
                <div class="col-xl-4 col-lg-6">
                    @if(permission('team_members', 'view'))
                        <a href="{{route('team_member.view', ['called_from' => 'team', 'member_id' => my_encrypt($member_key)])}}"
                           target="_self">
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center gap-2 pb-3">
                                        <img src="{{$emp_photo}}"
                                             class="avatar-lg rounded-3 border border-light border-3">
                                        <div class="d-block">
                                            <p class="text-dark fw-medium fs-16 mb-0">{{$member_val['emp_full_name']}}</p>
                                            <p class="mb-0">{{$member_val['emp_email']}}</p>
                                            <div class="mt-1"><span
                                                    class="mb-0 text-primary"># {{$member_val['emp_internal_id']}}</span>
                                                <b> | </b><span
                                                    class="badge designation-badge rounded-pill me-1 fs-6">{{\App\Enums\DesignationEnum::from($member_val['emp_designation'])->label()}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-around">
                                        <div class="col-md-3 member-task-count">
                                            <div class="text-primary fw-bold fs-5">
                                                8
                                            </div>
                                            <div class="fs-11">
                                                Active
                                            </div>
                                        </div>
                                        <div class="col-md-3 member-task-count">
                                            <div class="text-success fw-bold fs-5">
                                                47
                                            </div>
                                            <div class="fs-12">
                                                Completed
                                            </div>
                                        </div>
                                        <div class="col-md-3 member-task-count">
                                            <div class="text-warning fw-bold fs-5">
                                                3
                                            </div>
                                            <div class="fs-12">
                                                pending
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class=" mt-4">
                                            <div class="row justify-content-between mb-1">
                                                <div class="col-md-4 fs-12">Workload</div>
                                                <div class="col-md-2 fs-12 text-success fw-bold">75%</div>
                                            </div>
                                            <div class="progress">
                                                <div
                                                    class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                                    role="progressbar" style="width: 75%" aria-valuenow="75"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(permission('team_members', 'view'))
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        {!! generate_no_record_html() !!}
    @endif
@endsection
