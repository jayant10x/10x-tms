<div class="row my-4">
    <div class="col-md-6">
        <p class="text-dark fw-semibold fs-16 mb-0">Username :</p>
        <p class="mb-0">{{$emp_data->admin_user_details->adm_user_name}}</p>
    </div>
    <div class="col-md-6">
        <p class="text-dark fw-semibold fs-16 mb-0">Role :</p>
        <p class="mb-0">{!! \App\Enums\UserRoleEnum::tryFrom($emp_data->admin_user_details->adm_role)->badge() !!}</p>
    </div>
</div>
{!! generate_created_updated_label($emp_data->admin_user_details) !!}
