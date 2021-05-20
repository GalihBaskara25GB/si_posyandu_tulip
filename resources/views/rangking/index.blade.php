@extends('templateContent')

@section('content')
  @include('rangking.quickbar-perhitungan')

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-sm-flex align-items-center mb-4">
            <h4 class="card-title mb-sm-0">Hasil Perhitungan Bobot Dengan Metode AHP</h4>
          </div>
          <div class="table-responsive border rounded p-1">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th  class="font-weight-bold">Kriteria</th>
                  <th  class="font-weight-bold">Bobot</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Pendidikan</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>Keaktifan Sosial</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>Kepribadian</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>Penyakit Berat</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>Pengetahuan Kesehatan</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>Keahlian Komputer</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>Kepemilikan HP</td>
                  <td>0</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="d-flex mt-4 flex-wrap">
            <nav class="ml-auto">
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-sm-flex align-items-center mb-4">
            <h4 class="card-title mb-sm-0">Hasil Perangkingan Dengan Metode TOPSIS</h4>
            <a href="#" class="text-dark ml-auto mb-3 mb-sm-0 text-decoration-none disabled">  
              Total Data : 
            </a>
          </div>
          <div class="col-12">
            <form class="form-sample" action="{{route('rangkings.index')}}" method="GET">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <select name="field" class="form-control text-dark" required>
                      <option value="nama">Nama</option>
                    </select>
                  </div>
                  <input 
                    name="keyword"
                    type="text" 
                    class="form-control" 
                    placeholder="Cari Berdasarkan Nama Kader" 
                    aria-label="Cari Berdasarkan Nama Kader" 
                    aria-describedby="basic-addon2"
                    required>
                  <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="table-responsive border rounded p-1">
            <table class="table">
              <thead>
                <tr>
                  <th class="font-weight-bold">Rangking</th>
                  <th class="font-weight-bold">Nilai Preferensi</th>
                  <th class="font-weight-bold">Nama Kader</th>
                  <th class="font-weight-bold">Nomor Telepon</th>
                  <th class="font-weight-bold">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>0.665</td>
                  <td>Galih Aditya</td>
                  <td>+6282257934698</td>
                  <td>
                    <a 
                      target="_new" 
                      href="https://api.whatsapp.com/send?phone=6282257934698&text=Hai+Galih+Aditya" class="btn btn-sm btn-success">
                      Hubungi Via Whatsapp
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-info">
                      Masukkan Dalam Daftar Diterima
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="d-flex mt-4 flex-wrap">
            <nav class="ml-auto">
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
      