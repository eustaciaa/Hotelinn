@extends('layouts.app')

@section('content')

<script>
  function triggerClick(){
    document.querySelector('#input_photo').click();
  }

  function displayImage(e){
    if(e.files[0]){
      var reader = new FileReader();

      reader.onload = function(e){
        document.querySelector('#display_photo').setAttribute('src',e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }
</script>

<div class="container">
    <div class="row justify-content-center">
    
        <div class="col-md-8">

                <div class="card my-5">
                    <div class="card-header justify-content-center"><i>{{__('Ubah Profil')}}</i></div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="/updateProfile" method="POST">
                                @csrf
                                <div class="form-group col">
                                @if (Auth::user()->photo != NULL)
                                    <img src="images/profile/{{ Auth::user()->photo }}" class="img-thumbnail" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;"  onclick="triggerClick()" id="display_photo"></img>
                                @else
                                    <img src="images/profile/default.png" class=" img-thumbnail" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;" onclick="triggerClick()" id="display_photo"></img>
                                @endif
                                <input type="file"  onchange="displayImage(this)" name="photo" id="input_photo">
                                </div>

                                <div class="form-group row">
                                    <label for="fName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Depan') }}</label>
                            
                                    <div class="col-md-6">
                                        <input id="fName" type="text" class="form-control" name="fName" value="{{ Auth::user()->fName }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Belakang') }}</label>

                                    <div class="col-md-6">
                                        <input id="lName" type="text" class="form-control" name="lName" value="{{ Auth::user()->lName }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right"><i>{{ __('Email') }}</i></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right"><i>{{ __('Jenis Kelamin') }}</i></label>

                                    <div class="col-md-6">
                                        <select class="form-control" id="gender" name="gender">
                                        @if (Auth::user()->gender=='M')
                                            <option value="M" selected>Pria</option>
                                            <option value="F">Wanita</option>
                                        @elseif (Auth::user()->gender=='F')
                                            <option value="M">Pria</option>
                                            <option value="F" selected>Wanita</option>
                                        @endif
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="birtdate" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                    <div class="col-md-6">
                                        <input id="date" type="date" class="form-control" name="birthdate" value="{{ Auth::user()->birthdate }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <button id="submit" class="btn btn-primary offset-md-4 " type="submit">Ubah Profil</button>
                                </div>
                        </form>
                    </div>
                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

        <!-- Accordion card -->
        <div class="card">

            <!-- Card header -->
            <div class="btn card-header" role="tab" id="headingOne1">
            <div data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                aria-controls="collapseOne1">
                <h5 class="mb-0">
                Ubah Kata Sandi <i class="fas fa-angle-down rotate-icon" style="padding-left: 530px"></i>
                </h5>
            </div>
            </div>

    <!-- Card body -->
            <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
            <div class="card-body">
                    <form action="/changePass" method="post">
                        @csrf
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Kata Sandi Saat Ini</label>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                
                                @if($errors->has('current_password'))
                                    <span class="help-block alert-danger">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Kata Sandi Baru</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                @if($errors->has('new_password'))
                                    <span class="help-block alert-danger">{{ $errors->first('new_password') }}</span>
                                @endif
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Konfirmasi Kata Sandi Baru</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                @if($errors->has('new_confirm_password'))
                                    <span class="help-block alert-danger">{{ $errors->first('new_confirm_password') }}</span>
                                @endif
                            </div>
                        </div>
   

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Ubah Kata Sandi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    </div>
    </div>
        
    </div>
</div>
@endsection
