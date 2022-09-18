@extends('layouts.member')

@section('title', e(__('Settings')))

@section('content')

    <h4>{{ __('Personal Settings') }}</h4>

    <form action="{{ route('member.settings') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">{{ __('Username') }}</label>

            <div class="col-sm-9">
                <span class="form-control-plaintext">{{ $user->username }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">{{ __('Name') }}</label>

            <div class="col-sm-9">
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                @if ($errors->has('name'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-sm-3 col-form-label">{{ __('Biography') }}</label>

            <div class="col-sm-9">
                <textarea id="description" name="description"
                          class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description', $user->description) }}</textarea>
                @if ($errors->has('description'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="upload_featured_image" class="col-sm-3 col-form-label">
                {{ __('Profile Image') }}
            </label>
            <div class="col-sm-9">
                @if($user->image->file)
                    <img src="{{ $user->profileImage() }}" style="max-width: 100%;">
                @endif
                {{ Form::file('upload_image', ['accept' => '.jpg,.jpeg,.png,.gif']) }}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">{{ __('Social Networks') }}</label>

            <div class="col-sm-9">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-facebook-f fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[facebook]" placeholder="{{ __('Facebook') }}"
                           value="{{ old('social_networks.facebook', $user->socialNetwork('facebook')) }}"
                           class="form-control{{ $errors->has('social_networks.facebook') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.facebook'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.facebook') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-twitter fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[twitter]" placeholder="{{ __('Twitter') }}"
                           value="{{ old('social_networks.twitter', $user->socialNetwork('twitter')) }}"
                           class="form-control{{ $errors->has('social_networks.twitter') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.twitter'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.twitter') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-linkedin-in fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[linkedin]" placeholder="{{ __('LinkedIn') }}"
                           value="{{ old('social_networks.linkedin', $user->socialNetwork('linkedin')) }}"
                           class="form-control{{ $errors->has('social_networks.linkedin') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.linkedin'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.linkedin') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-youtube fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[youtube]" placeholder="{{ __('YouTube') }}"
                           value="{{ old('social_networks.youtube', $user->socialNetwork('youtube')) }}"
                           class="form-control{{ $errors->has('social_networks.youtube') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.youtube'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.youtube') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-vimeo-v fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[vimeo]" placeholder="{{ __('Vimeo') }}"
                           value="{{ old('social_networks.vimeo', $user->socialNetwork('vimeo')) }}"
                           class="form-control{{ $errors->has('social_networks.vimeo') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.vimeo'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.vimeo') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-instagram fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[instagram]" placeholder="{{ __('Instagram') }}"
                           value="{{ old('social_networks.instagram', $user->socialNetwork('instagram')) }}"
                           class="form-control{{ $errors->has('social_networks.instagram') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.instagram'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.instagram') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-pinterest fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[pinterest]" placeholder="{{ __('Pinterest') }}"
                           value="{{ old('social_networks.pinterest', $user->socialNetwork('pinterest')) }}"
                           class="form-control{{ $errors->has('social_networks.pinterest') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.pinterest'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.pinterest') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-vk fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[vk]" placeholder="{{ __('VK') }}"
                           value="{{ old('social_networks.vk', $user->socialNetwork('vk')) }}"
                           class="form-control{{ $errors->has('social_networks.vk') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.vk'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.vk') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-github fa-fw"></i></span>
                    </div>
                    <input type="url" name="social_networks[github]" placeholder="{{ __('Github') }}"
                           value="{{ old('social_networks.github', $user->socialNetwork('github')) }}"
                           class="form-control{{ $errors->has('social_networks.github') ? ' is-invalid' : '' }}">
                    @if ($errors->has('social_networks.github'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('social_networks.github') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="withdrawal_method" class="col-sm-3 col-form-label">{{ __('Withdrawal Method') }}</label>
            <div class="col-sm-9">
                <select class="form-control" name="withdrawal_method" id="withdrawal_method">
                    <option value="">{{ __('Choose') }}</option>
                    @foreach(array_column(get_withdrawal_methods(), 'name', 'id') as $key=>$val)
                        <option value="{{ $key }}" {{ (($key === old('withdrawal_method', $user->withdrawal_method))? "selected":"") }}>{{$val}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="withdrawal_account" class="col-sm-3 col-form-label">{{ __('Withdrawal Account') }}</label>
            <div class="col-sm-9">
                <input type="text" id="withdrawal_account" name="withdrawal_account"
                       value="{{ old('withdrawal_account', $user->withdrawal_account) }}"
                       class="form-control{{ $errors->has('withdrawal_account') ? ' is-invalid' : '' }}">
                @if ($errors->has('withdrawal_account'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('withdrawal_account') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}">
        </div>

    </form>

    <hr>

    <h4>{{ __('Email Change') }}</h4>

    <form action="{{ route('member.email.change.request') }}" method="post">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">{{ __('Current Email') }}</label>

            <div class="col-sm-9">
                <span class="form-control-plaintext">{{ $user->email }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="tmp_email" class="col-sm-3 col-form-label">{{ __('New Email') }}</label>

            <div class="col-sm-9">
                <input type="email" id="tmp_email" name="tmp_email" value="{{ old('tmp_email') }}"
                       class="form-control{{ $errors->has('tmp_email') ? ' is-invalid' : '' }}" required>
                @if ($errors->has('tmp_email'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tmp_email') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="tmp_email_confirmation" class="col-sm-3 col-form-label">{{ __('Confirm New Email') }}</label>

            <div class="col-sm-9">
                <input type="email" id="tmp_email_confirmation" name="tmp_email_confirmation"
                       value="{{ old('tmp_email_confirmation') }}"
                       class="form-control{{ $errors->has('tmp_email_confirmation') ? ' is-invalid' : '' }}" required>
                @if ($errors->has('tmp_email_confirmation'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tmp_email_confirmation') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}">
        </div>

    </form>

    <hr>

    <h4>{{ __('Password Change') }}</h4>

    <form action="{{ route('member.password.change') }}" method="post">
        @csrf

        <div class="form-group row">
            <label for="current_password" class="col-sm-3 col-form-label">{{ __('Current Password') }}</label>

            <div class="col-sm-9">
                <input type="password" id="current_password" name="current_password"
                       value="{{ old('current_password') }}"
                       class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" required>
                @if ($errors->has('current_password'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('current_password') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="new_password" class="col-sm-3 col-form-label">{{ __('New Password') }}</label>

            <div class="col-sm-9">
                <input type="password" id="new_password" name="new_password" value="{{ old('new_password') }}"
                       class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" required>
                @if ($errors->has('new_password'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('new_password') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="new_password_confirmation"
                   class="col-sm-3 col-form-label">{{ __('Confirm New Password') }}</label>

            <div class="col-sm-9">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                       value="{{ old('new_password_confirmation') }}"
                       class="form-control{{ $errors->has('new_password_confirmation') ? ' is-invalid' : '' }}"
                       required>
                @if ($errors->has('new_password_confirmation'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}">
        </div>

    </form>

@endsection
