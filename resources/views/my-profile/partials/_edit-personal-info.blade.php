<form action="{{route('my_profile.update.personal_info')}}" method="post" id="profile_edit_form"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name <span
                                class="text-danger">*</span></label>
                        <input type="text" name="full_name" id="full_name"
                               class="form-control @error('full_name') is-invalid @enderror"
                               autocomplete="off"
                               value="{{$emp_data->emp_full_name ?? old('full_name')}}">
                        @error('full_name')
                        <span class="validation-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number"
                               class="form-control @error('phone_number') is-invalid @enderror"
                               autocomplete="off"
                               value="{{$emp_data->emp_phone_number ?? old('phone_number')}}">
                        @error('phone_number')
                        <span class="validation-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span
                                class="text-danger">*</span></label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               autocomplete="off"
                               value="{{$emp_data->emp_email ?? old('email')}}">
                        @error('email')
                        <span class="validation-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="profile_photo" class="form-label">Profile Photo {{--<span
                        class="text-danger">*</span>--}}</label>
                <input type="file" id="profile_photo" name="profile_photo"
                       class="filepond form-control"/>
            </div>
            <div>
                @error('profile_photo')
                <span class="validation-message">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    {!! generate_submit_reset_button() !!}
</form>
