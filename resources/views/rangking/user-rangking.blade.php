@extends('templateContent')

@section('content')
  <div class="row purchace-popup">
    <div class="col-12 stretch-card grid-margin">
      <div class="card card-info">
        <span class="card-body d-lg-flex align-items-center">
          <p class="mb-lg-0">
            Selamat Anda Diterima Menjadi Kader Posyandu, 
            Pastikan Nomor Anda Dapat Dihubungi Via Whatsapp Untuk Instruksi Selanjutnya !<br/>
            Atau Datangi Kantor Posyandu Untuk Mendapatkan Instruksi Selanjutnya
          </p>
          <button class="close popup-dismiss ml-2">
            <span aria-hidden="true">&times;</span>
          </button>
        </span>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-sm-flex align-items-center mb-4">
            <h4 class="card-title mb-sm-0">Rangking Calon Kader</h4>
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
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>0.665</td>
                  <td>Galih Aditya</td>
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
      