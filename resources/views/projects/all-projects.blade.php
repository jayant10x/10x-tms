@extends('layouts.vertical', ['title' => 'All Projects','subTitle' => 'All Projects'])
@section('content')
    <style>
        .project-first-char-count {
            padding: 10px;
            text-align: center;
            border-radius: 9px;
            font-size: larger;
            font-weight: 700;
            color: white;
        }
    </style>
    <div class="row">
        @foreach($all_projects as $pro_id => $project)
            <a href="{{route('project.view', ['pro_id' => my_encrypt($pro_id)])}}" target="_self">
                <div class="col-xl-4 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row p-2">
                                <div class="col-md-2 bg-primary project-first-char-count align-content-center">
                                    {{get_initials_char($project['pro_name'], 1)}}
                                </div>
                                <div class="col-md-7 align-content-center">
                                    <span class="fw-bold">{{$project['pro_name']}}</span><br>
                                    <span>{{!empty($project['pro_manager']) ? get_employee_data($project['pro_manager']) : '-'}}</span>
                                </div>
                                <div
                                    class="col-md-3 align-content-center">{!! \App\Enums\ProjectStatus::tryFrom($project['pro_status'])->badge() !!}</div>
                            </div>
                            @if(!empty($project['pro_description']))
                                <div class="row">
                                    <div
                                        class="col-md-12">{{generate_shorten_string($project['pro_description'], 50)}}</div>
                                </div>
                            @endif
                            <div>
                                <div class="mt-2">
                                    <div class="row justify-content-between mb-1">
                                        <div class="col-md-4 fs-12">18/24 Tasks</div>
                                        <div class="col-md-2 fs-12 text-success fw-bold">75%</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                             role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-around mt-2">
                                <div class="col-md-8">
                                    <div class="text-primary fw-bold fs-5">
                                        8
                                    </div>
                                </div>
                                <div class="col-md-4 fs-12">
                                    <iconify-icon icon="solar:calendar-bold"
                                                  class="align-middle fs-12"></iconify-icon> {{$project['pro_deadline']}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection

@if(!is_admin())
    @section('module-right-section')
        {!! generate_add_button(route('projects.add'), title:' Project', text: ' Project') !!}
    @endsection
@endif
