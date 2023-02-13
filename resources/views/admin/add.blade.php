@extends('layouts.admin')
@section("title","Add New Admin")

@section('content')


<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Now! -- Have an account as Admin ? <a href="{{route('admin.login')}}"> login</a>
                </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.store') }}" aria-label="{{ __('Register') }}">
                            @csrf

                        
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __(' Name') }}</label>

                                <div class="col-md-6">
       <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >

                                   
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="role"> 
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Super Admin</option>
                                    </select>

                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    
                                </div>
                            </div>

                             


                            <div class="form-group row">
                                <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>

                                <div class="col-md-6">
                                    <input id="bio" type="text" class="form-control" name="bio" value="{{ old('bio') }}" >

                                   
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" value="+20" class="form-control" name="phone" value="{{ old('phone') }}" >

                                   
                                </div>  
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" >

                                   
                                </div>
                            </div>


                          

                             


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary text-center">
                                        {{ __('Add new') }}
                                    </button>
                                </div>
                            </div>








                   
</div>





                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
