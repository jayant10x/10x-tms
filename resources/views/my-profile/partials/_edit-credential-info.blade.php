<form action="{{route('my_profile.update.credentials')}}" method="post" id="profile_credential_form">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="profile_user_name" class="form-label">User Name</label>
                <input type="text" id="profile_user_name" name="user_name"
                       class="form-control @error('profile_user_name') is-invalid @enderror"
                       autocomplete="off"
                       value="{{$admin_data->adm_user_name ?? old('user_name')}}">
                @error('user_name')
                <span class="validation-message">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="profile_password" class="form-label">Password</label>
                <input type="password" id="profile_password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       autocomplete="off">
                @error('password')
                <span class="validation-message">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    {!! generate_submit_reset_button() !!}
</form>
