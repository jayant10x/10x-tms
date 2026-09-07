<div class="row">
    <div class="col-md-9 col-lg-9">
        <div class="row my-4">
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Email :</p>
                <p class="mb-0">{{get_dash_on_empty($emp_data->emp_email)}}</p>
            </div>
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Phone Number :</p>
                <p class="mb-0">{{$emp_data->emp_phone_number}}</p>
            </div>
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Employment Type :</p>
                <p class="mb-0">{{$emp_data->emp_employment_type?->label() ?? '-'}} </p>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Department :</p>
                <p class="mb-0">{{$emp_data->emp_department?->label() ?? '-'}} </p>
            </div>
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Sub Department :</p>
                <p class="mb-0">{{$emp_data->emp_sub_department?->label() ?? '-'}} </p>
            </div>
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Designation :</p>
                <p class="mb-0">{{$emp_data->emp_designation?->label() ?? '-'}} </p>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Reporting To :</p>
                <p class="mb-0">{{get_dash_on_empty($emp_data->reporting_to?->emp_full_name)}}
                </p>
            </div>
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Joining Date :</p>
                <p class="mb-0">{{get_date_time_format($emp_data->emp_created_on)}}
                </p>
            </div>
            <div class="col-lg-4">
                <p class="text-dark fw-semibold fs-16 mb-0">Status :</p>
                <p class="mb-0">{!! generate_status_html($emp_data->emp_status) !!}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3 text-center align-content-center">
        @if(!empty($emp_data->emp_photo))
            <a href="{{ asset('storage/employees/' . $emp_data->emp_photo) }}"
               target="_blank"
               rel="noopener noreferrer">
                <img
                    src="{{ asset('storage/employees/' . $emp_data->emp_photo) }}"
                    alt="Employee Photo"
                    class="rounded-circle avatar-xl img-thumbnail"
                >
            </a>
        @else
            <img src="{{ asset('images/users/dummy-avatar.jpg') }}"
                 class="rounded-circle avatar-xl img-thumbnail">
        @endif
        <div>
            <h3 class="fw-semibold mb-1 mt-1">{{$emp_data->emp_full_name}}</h3>
            <span
                class="link-primary fw-medium fs-14"><b>#</b>{{$emp_data->emp_internal_id}} | {{$emp_data->emp_department?->label() ?? '-'}}</span>
        </div>
    </div>
</div>
{!! generate_created_updated_label($emp_data) !!}
