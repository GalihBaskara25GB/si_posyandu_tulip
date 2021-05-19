@extends('templateContent')

@section('content')

  @if (Session::get('success') || Session::get('errors'))
    @include('partials.alert')
  @endif

  @include('partials.quickaction')
  @include('modals.kader')

  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ ucfirst(Request::segment(3).' '.substr(Request::segment(1), 0, -1)) }}</h4>
          <form class="form-sample" action="{{ route('users.update', $user->id) }}" method="POST" name="formData" id="formData">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input 
                      name="username" 
                      type="text" 
                      class="form-control" 
                      placeholder="Username"
                      value="{{ $user->username }}" 
                      required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Role</label>
                  <div class="col-sm-9">
                    <select name="role" class="form-control text-dark" required>
                      <option 
                        value="administrator"
                        {{ ($user->role == 'administrator') ? 'selected' : '' }}>
                        Administrator
                      </option>
                      <option 
                        value="user"
                        {{ ($user->role == 'user') ? 'selected' : '' }}>
                        User
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kader</label>
                  <div class="col-sm-6"> 
                    <input type="hidden" name="kader_id" id="kader_id" value="{{ $user->kader_id }}">
                    <input 
                      name="kader_nama"
                      id="kader_nama" 
                      type="text" 
                      class="form-control" 
                      placeholder="Pilih Kader"
                      value="{{ $user->kader->nama }}" 
                      readonly 
                      required>
                  </div>
                  <div class="col-sm-3">
                    <button 
                      class="btn btn-sm btn-primary form-control" 
                      type="button"
                      data-toggle="modal" 
                      data-target="#kaderModal">
                      Pilih Kader
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <p class="card-description"> Ketik password baru jika ingin mengganti password </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input 
                      name="password" 
                      type="password" 
                      class="form-control" 
                      placeholder="Password Minimal 5 Karakter"
                      minLength="5"
                      value="{{ $user->password }}"
                      required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                  <div class="col-sm-9">
                    <input 
                      name="password_confirmation" 
                      type="password" 
                      class="form-control" 
                      placeholder="Ketik Ulang Password"
                      minLength="5"
                      value="{{ $user->password }}"
                      required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 ml-auto text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-outline-danger">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection