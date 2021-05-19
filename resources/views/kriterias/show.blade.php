@extends('templateContent')

@section('content')

@include('partials.quickaction')

<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ ucfirst(Request::segment(3).' '.substr(Request::segment(1), 0, -1)) }}</h4>
        <form class="form-sample">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kader</label>
                <div class="col-sm-9">
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
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Mempunyai Penyakit Berat</label>
                <div class="col-sm-9">
                  <input 
                    name="penyakit_berat" 
                    type="text" 
                    class="form-control" 
                    value="{{ ($kriteria->penyakit_berat) ? 'Ya' : 'Tidak' }}" 
                    readonly>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                <div class="col-sm-9">
                  <input 
                    name="pendidikan" 
                    type="text" 
                    class="form-control" 
                    value="{{ strtoupper($kriteria->pendidikan) }}" 
                    readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Pengetahuan Dasar Kesehatan</label>
                <div class="col-sm-9">
                  <input 
                    name="pengetahuan_kesehatan" 
                    type="text" 
                    class="form-control" 
                    value="{{ ucfirst($kriteria->pengetahuan_kesehatan) }}" 
                    readonly>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Keaktifan Sosial</label>
                <div class="col-sm-9">
                  <input 
                    name="keaktifan_sosial" 
                    type="text" 
                    class="form-control" 
                    value="{{ ucfirst($kriteria->keaktifan_sosial) }}" 
                    readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Keahlian Komputer</label>
                <div class="col-sm-9">
                  <input 
                    name="keahlian_komputer" 
                    type="text" 
                    class="form-control" 
                    value="{{ ($kriteria->keahlian_komputer) ? 'Ya' : 'Tidak' }}" 
                    readonly>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nilai Kepribadian</label>
                <div class="col-sm-9">
                  <input 
                    name="kepribadian" 
                    type="text" 
                    class="form-control" 
                    value="{{ ucfirst($kriteria->kepribadian) }}" 
                    readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kepemilikan HP</label>
                <div class="col-sm-9">
                  <input 
                    name="mempunyai_hp" 
                    type="text" 
                    class="form-control" 
                    value="{{ ($kriteria->mempunyai_hp) ? 'Ya' : 'Tidak' }}" 
                    readonly>
                </div>
              </div>
            </div>
          </div>

          <p class="card-description"> Data Kader dengan Kriteria ini </p>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input 
                    name="nama" 
                    type="text" 
                    class="form-control" 
                    placeholder="Nama Lengkap"
                    value="{{$kriteria->kader->nama}}" 
                    readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                  <input 
                    name="kader" 
                    type="text" 
                    class="form-control" 
                    placeholder="Nama Lengkap"
                    value="{{$kriteria->kader->jenis_kelamin}}" 
                    readonly>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-9">
                  <input 
                    name="tempat_lahir" 
                    type="text" 
                    class="form-control" 
                    placeholder="Kota DIlahirkan"
                    value="{{$kriteria->kader->tempat_lahir}}"
                    readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                  <input 
                    name="tanggal_lahir" 
                    type="date" 
                    class="form-control"
                    value="{{$kriteria->kader->tanggal_lahir}}"
                    readonly>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <input 
                    name="alamat" 
                    type="text" 
                    class="form-control" 
                    placeholder="Alamat Lengkap"
                    value="{{$kriteria->kader->alamat}}"
                    readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">No Telepon</label>
                <div class="col-sm-9">
                  <input 
                    name="nomor_telepon" 
                    type="text" 
                    class="form-control" 
                    placeholder="Nomor Telepon Yang Dapat Dihubungi"
                    maxLength="16"
                    value="{{$kriteria->kader->nomor_telepon}}"
                    readonly>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <input 
                    name="is_verified" 
                    type="text" 
                    class="form-control" 
                    placeholder="Status Verifikasi"
                    maxLength="16"
                    value="{{ ($kriteria->kader->is_verified) ? 'Sudah' : 'Belum' }} Diverifikasi"
                    readonly>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection