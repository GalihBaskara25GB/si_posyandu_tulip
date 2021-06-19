@extends('templateContent')

@section('content')

  @if (Session::get('success') || Session::get('errors'))
    @include('partials.alert')
  @endif

  @include('partials.quickaction')
  @include('modals.kader')

  <!-- <div class="row">
    <div class="col-12">
    <a href="" button type="buttons" class="btn btn-success">Import Exel</a> -->
        <!-- <form action="{{ route('kaders.import') }}" method="POST" enctype="multipart/form-data"> -->
        <!-- @csrf -->
        <!-- <label for="file">Pilih File Excel</label> -->
        <!-- <input type="file" class="form-control" id="file" name="file"> -->
        <!-- <button type="submit" class="btn btn-outline-info">Import</button> -->
        <!-- </form> -->
    <!-- </div> -->
  <!-- </div> -->
  
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{ ucfirst(Request::segment(2).' '.substr(Request::segment(1), 0, -1)) }}</h4>
          <form class="form-sample" action="{{ route('kriterias.store') }}" method="POST" name="formData" id="formData">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kader</label>
                  <div class="col-sm-6">
                    <input type="hidden" name="kader_id" id="kader_id">
                    <input 
                      name="kader_nama"
                      id="kader_nama" 
                      type="text" 
                      class="form-control" 
                      placeholder="Pilih Kader"
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
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Mempunyai Penyakit Berat</label>
                  <div class="col-sm-9">
                    <select name="penyakit_berat" class="form-control text-dark" required>
                      <option value="1">Ya</option>
                      <option value="0">Tidak</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                  <div class="col-sm-9">
                    <select name="pendidikan" class="form-control text-dark" required>
                      <option value="sd">SD</option>
                      <option value="smp">SMP</option>
                      <option value="sma">SMA</option>
                      <option value="d3">D3</option>
                      <option value="strata-1">Strata-1</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pengetahuan Dasar Kesehatan</label>
                  <div class="col-sm-9">
                    <select name="pengetahuan_kesehatan" class="form-control text-dark" required>
                      <option value="baik">Baik</option>
                      <option value="cukup">Cukup</option>
                      <option value="kurang">Kurang</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keaktifan Sosial</label>
                  <div class="col-sm-9">
                    <select name="keaktifan_sosial" class="form-control text-dark" required>
                      <option value="baik">Baik</option>
                      <option value="cukup">Cukup</option>
                      <option value="kurang">Kurang</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keahlian Komputer</label>
                  <div class="col-sm-9">
                    <select name="keahlian_komputer" class="form-control text-dark" required>
                      <option value="1">Ya</option>
                      <option value="0">Tidak</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nilai Kepribadian</label>
                  <div class="col-sm-9">
                    <select name="kepribadian" class="form-control text-dark" required>
                      <option value="baik">Baik</option>
                      <option value="cukup">Cukup</option>
                      <option value="kurang">Kurang</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kepemilikan HP</label>
                  <div class="col-sm-9">
                    <select name="mempunyai_hp" class="form-control text-dark" required>
                      <option value="1">Ya</option>
                      <option value="0">Tidak</option>
                    </select>
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

