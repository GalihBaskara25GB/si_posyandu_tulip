@extends('templateContent')

@section('content')

  @if (Session::get('success') || Session::get('errors') || !is_null($message))
    @include('partials.alert')
  @endif

  @include('partials.quickaction')
  
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-sm-flex align-items-center mb-4">
            <h4 class="card-title mb-sm-0">Data {{ substr(ucfirst(Request::segment(1)), 0,-1) }}</h4>
            <a href="#" class="text-dark ml-auto mb-3 mb-sm-0 text-decoration-none disabled">  
              Total Data : {{ $numRecords }}
            </a>
          </div>
          <div class="col-12">
            <form class="form-sample" action="{{route('kriterias.index')}}" method="GET">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <select name="field" class="form-control text-dark" required>
                      <option value="nama" {{ (Request::__get('field') == 'nama') ? 'selected' : '' }}>Nama Kader</option>
                      <option value="pendidikan" {{ (Request::__get('field') == 'pendidikan') ? 'selected' : '' }}>Pendidikan</option>
                      <option value="penyakit_berat" {{ (Request::__get('field') == 'penyakit_berat') ? 'selected' : '' }}>Penyakit Berat</option>
                      <option value="keahlian_komputer" {{ (Request::__get('field') == 'keahlian_komputer') ? 'selected' : '' }}>Keahlian Komputer</option>
                      <option value="kepribadian" {{ (Request::__get('field') == 'kepribadian') ? 'selected' : '' }}>Kepribadian</option>
                      <option value="mempunyai_hp" {{ (Request::__get('field') == 'mempunyai_hp') ? 'selected' : '' }}>Mempunyai HP</option>
                    </select>
                  </div>
                  <input 
                    name="keyword"
                    type="text" 
                    class="form-control" 
                    placeholder="Cari Berdasarkan Nama atau Alamat" 
                    aria-label="Cari Berdasarkan Nama atau Alamat" 
                    aria-describedby="basic-addon2"
                    value="{{ (Request::__get('keyword') !== null) ? Request::__get('keyword') : '' }}"
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
                  <th class="font-weight-bold">#</th>
                  <th class="font-weight-bold">Nama Kader</th>
                  <th class="font-weight-bold">Pendidikan</th>
                  <th class="font-weight-bold">Keahlian Komputer</th>
                  <th class="font-weight-bold">Mempunyai HP</th>
                  <th class="font-weight-bold">Opsi</th>
                </tr>
              </thead>
              <tbody>
              @php
                $currentPage = Request::__get('page');
                (is_null($currentPage)) ? $i = 1 : $i = (($currentPage-1)*5)+1;
              @endphp
              @foreach ($kriterias as $kriteria)
              <tr>
                  <th class="font-weight-bold">
                    {{ $i++ }}</th>
                  <td>{{ $kriteria->kader->nama }}</td>
                  <td>{{ strtoupper($kriteria->pendidikan) }}</td>
                  <td>{{ ($kriteria->keahlian_komputer) ? 'Ya' : 'Tidak' }}</td>
                  <td>{{ ($kriteria->mempunyai_hp) ? 'Ya' : 'Tidak' }}</td>
                  <td class="text-center">
                      <form action="{{ route('kriterias.destroy',$kriteria->id) }}" method="POST">
                          <a 
                            class="btn btn-info btn-sm" 
                            href="{{ route('kriterias.show',$kriteria->id) }}">Show</a>
                          <a 
                            class="btn btn-primary btn-sm" 
                            href="{{ route('kriterias.edit',$kriteria->id) }}">Edit</a>
      
                          @csrf
                          @method('DELETE')
                          <button 
                            type="submit" 
                            class="btn btn-danger btn-sm" 
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            Delete
                          </button>
                      </form>
                  </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <div class="d-flex mt-4 flex-wrap">
            <nav class="ml-auto">
              {!! ($numRecords > 0) ? $kriterias->links() : '' !!}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
      