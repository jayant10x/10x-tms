{{--    @if(!empty($all_team_members))--}}
<div class="row">
    @if(!empty($project_manager))
        @php
            $emp_photo = asset('images/users/dummy-avatar.jpg');
            if(!empty($project_manager['emp_photo'])) {
                $emp_photo = asset('storage/employees/'. $project_manager['emp_photo']);
            }
        @endphp
        <div class="col-xl-6 col-lg-6">
            <a href="{{route('team_member.view', ['called_from' => 'project_team', 'member_id' => my_encrypt($project_data['pro_manager']), 'pro_id' => my_encrypt($pro_id)])}}"
               target="_self">
                <div class="card team-members-card">
                    <div class="card-body">
                        <span class="team-member-role-pill">{!! \App\Enums\UserRoleEnum::tryFrom('manager')->badge() !!}</span>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <img src="{{$emp_photo}}"
                                 class="avatar-lg rounded-3 border border-light border-3">
                            <div>
                                <p class="text-dark fw-medium fs-16 mb-0">{{$project_manager['emp_full_name']}}</p>
                                <p class="mb-0 badge designation-badge rounded-pill me-1 fs-6">{{$project_manager['emp_designation']->label()}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endif

    {{--            @foreach($all_team_members as $member_key => $member_val)--}}
    @php
        $emp_photo = asset('images/users/dummy-avatar.jpg');
        /*if(!empty($member_val['emp_photo'])) {
            $emp_photo = asset('storage/employees/'. $member_val['emp_photo']);
        }*/
    @endphp
    <div class="col-xl-6 col-lg-6">
        <div class="card team-members-card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    @if(!empty($member_val['emp_photo']))
                        <a href="{{ $emp_photo }}" target="_blank"
                           rel="noopener noreferrer">
                            @endif
                            <img src="{{$emp_photo}}"
                                 class="avatar-lg rounded-3 border border-light border-3">
                            <div class="d-block">
                                <a href="#!"
                                   class="text-dark fw-medium fs-16">Member
                                    1{{--{{$member_val['emp_full_name']}}--}}</a>
                                <p class="mb-0">member1@gmail.com{{--{{$member_val['emp_email']}}--}}</p>
                                {{--<div class="mt-1"><span
                                        class="mb-0 text-primary"># 101--}}{{--{{$member_val['emp_internal_id']}}--}}{{--</span>
                                    <b> | </b><span
                                        class="badge badge-soft-primary badge-outline-primary rounded-pill me-1 fs-6">Designation--}}{{--{{\App\Enums\DesignationEnum::from($member_val['emp_designation'])->label()}}--}}{{--</span>
                                </div>--}}

                            </div>
                            @if(!empty($member_val['emp_photo']))
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{--            @endforeach--}}
</div>
{{--@else
    {!! generate_no_record_html() !!}
@endif--}}
