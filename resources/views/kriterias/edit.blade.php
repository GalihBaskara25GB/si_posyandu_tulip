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
          <form class="form-sample" action="{{ route('kriterias.update', $kriteria->id) }}" method="POST" name="formData" id="formData">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kader</label>
                  <div class="col-sm-6">
                    <input 
                    type="hidden" 
                    name="kader_id" 
                    id="kader_id" 
                    value="{{ $kriteria->kader->id }}">
                    <input 
                      name="kader_nama"
                      id="kader_nama" 
                      type="text" 
                      class="form-control" 
                      placeholder="Pilih Kader"
                      value="{{ $kriteria->kader->nama }}"
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
                      <option value="1" {{ ($kriteria->penyakit_berat) ? 'selected' : '' }}>Ya</option>
                      <option value="0" {{ (!$kriteria->penyakit_berat) ? 'selected' : '' }}>Tidak</option>
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
                      <option value="sd" {{ (strtolower($kriteria->pendidikan) == 'sd') ? 'selected' : '' }}>SD</option>
                      <option value="smp" {{ (strtolower($kriteria->pendidikan) == 'smp') ? 'selected' : '' }}>SMP</option>
                      <option value="sma" {{ (strtolower($kriteria->pendidikan) == 'sma') ? 'selected' : '' }}>SMA</option>
                      <option value="d3" {{ (strtolower($kriteria->pendidikan) == 'd3') ? 'selected' : '' }}>D3</option>
                      <option value="strata-1" {{ (strtolower($kriteria->pendidikan) == 'strata-1') ? 'selected' : '' }}>Strata-1</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pengetahuan Dasar Kesehatan</label>
                  <div class="col-sm-9">
                    <select name="pengetahuan_kesehatan" class="form-control text-dark" required>
                      <option value="baik" {{ (strtolower($kriteria->pengetahuan_kesehatan) == 'baik') ? 'selected' : '' }}>Baik</option>
                      <option value="cukup" {{ (strtolower($kriteria->pengetahuan_kesehatan) == 'cukup') ? 'selected' : '' }}>Cukup</option>
                      <option value="kurang" {{ (strtolower($kriteria->pengetahuan_kesehatan) == 'kurang') ? 'selected' : '' }}>Kurang</option>
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
                      <option value="baik" {{ (strtolower($kriteria->keaktifan_sosial) == 'baik') ? 'selected' : '' }}>Baik</option>
                      <option value="cukup" {{ (strtolower($kriteria->keaktifan_sosial) == 'cukup') ? 'selected' : '' }}>Cukup</option>
                      <option value="kurang" {{ (strtolower($kriteria->keaktifan_sosial) == 'kurang') ? 'selected' : '' }}>Kurang</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keahlian Komputer</label>
                  <div class="col-sm-9">
                    <select name="keahlian_komputer" class="form-control text-dark" required>
                      <option value="1" {{ ($kriteria->keahlian_komputer) ? 'selected' : '' }}>Ya</option>
                      <option value="0" {{ (!$kriteria->keahlian_komputer) ? 'selected' : '' }}>Tidak</option>
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
                      <option value="baik" {{ (strtolower($kriteria->kepribadian) == 'baik') ? 'selected' : '' }}>Baik</option>
                      <option value="cukup" {{ (strtolower($kriteria->kepribadian) == 'cukup') ? 'selected' : '' }}>Cukup</option>
                      <option value="kurang" {{ (strtolower($kriteria->kepribadian) == 'kurang') ? 'selected' : '' }}>Kurang</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kepemilikan HP</label>
                  <div class="col-sm-9">
                    <select name="mempunyai_hp" class="form-control text-dark" required>
                      <option value="1" {{ ($kriteria->mempunyai_hp) ? 'selected' : '' }}>Ya</option>
                      <option value="0" {{ (!$kriteria->mempunyai_hp) ? 'selected' : '' }}>Tidak</option>
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