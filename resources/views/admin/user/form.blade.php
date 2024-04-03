{!! Form::hidden('redirects_to', URL::previous()) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
            <label class="control-label" for="full_name">Full Name :<span class="text-red">*</span></label>
            {!! Form::text('full_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'id' => 'full_name']) !!}
            @if ($errors->has('full_name'))
                <span class="text-danger">
                    <strong>{{ $errors->first('full_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label" for="email">Email :<span class="text-red">*</span></label>
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'id' => 'email']) !!}
            @if ($errors->has('email'))
                <span class="text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label" for="password">Password :@if (empty($agent))<span class="text-red">*</span>@endif</label>
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'id' => 'password']) !!}
            @if ($errors->has('password'))
                <span class="text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label" for="password">Confirm Password :@if (empty($agent))<span class="text-red">*</span>@endif</label>
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm password', 'id' => 'password-confirm']) !!}
            @if ($errors->has('password_confirmation'))
                <span class="text-danger">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('country_code') ? ' has-error' : '' }}">
            <label class="control-label" for="country_code">Country Code :</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">+</span>
                </div>
                {!! Form::text('country_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Country Code', 'id' => 'country_code']) !!}
            </div>
            @if ($errors->has('country_code'))
                <span class="text-danger">
                    <strong>{{ $errors->first('country_code') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label class="control-label" for="phone">Phone :</label>
            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone', 'id' => 'phone']) !!}
            @if ($errors->has('phone'))
                <span class="text-danger">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label class="control-label" for="image">Image :</label>
            <div class="">
                <div class="fileError">
                    {!! Form::file('image', ['class' => '', 'id'=> 'image','accept'=>'image/*', 'onChange'=>'AjaxUploadImage(this)']) !!}
                </div>
                
                @if(!empty($agents['image']) && file_exists(public_path($agents['image'])))
                    <img src="{{asset($agents['image'])}}" alt="Agent Image" style="border: 1px solid #ccc;margin-top: 5px;" width="150" id="DisplayImage">
                @else
                    <img src="{{url('assets/admin/dist/img/no-image.png')}}" alt="Agent Image" style="border: 1px solid #ccc;margin-top: 5px;padding: 20px;" width="150" id="DisplayImage">
                @endif

                @if ($errors->has('image'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label class="control-label" for="status">Status :<span class="text-red">*</span></label><br>
            @foreach (\App\Models\Agent::$status as $key => $value)
                @php $checked = !isset($agent) && $key == 'active' ? 'checked' : ''; @endphp
                <label class="radio-inline">
                    {!! Form::radio('status', $key, null, ['class' => 'flat-red', $checked]) !!} {{ $value }}
                </label>
            @endforeach
            @if ($errors->has('status'))
                <span class="text-danger">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

