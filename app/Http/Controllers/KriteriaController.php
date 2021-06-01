<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Kader;
use App\Http\Requests\KriteriaRequest;

use PDF;
use Hash;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataPerPage = 5;

        $kriterias = Kriteria::paginate($dataPerPage);
        $numRecords = Kriteria::count();
        $message = null;

        if(isset($request->field) && isset($request->keyword)) {
            $field = $request->field;
            $keyword = $request->keyword;

            if($field == 'nama') {
                $kriterias = Kriteria::whereHas('kader', function($query) use($field, $keyword) {
                    $query->where($field, 'LIKE', '%'.$keyword.'%');
                 });
            
            } else {
                $kriterias = Kriteria::where($field, 'LIKE', '%'.$keyword.'%');
            }
            
            $numRecords = $kriterias->get()->count();
            $message = $numRecords." data ditemukan dengan kata kunci \"$keyword\"";
            if($numRecords > 0) $kriterias = $kriterias->paginate($dataPerPage);        
        }  
         
        return view('kriterias.index',compact('kriterias', 'numRecords', 'message'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    public function create()
    {
        $kaders = Kader::doesnthave('kriteria')->get();
        return view('kriterias.create', compact('kaders'));
    }
  
    public function store(KriteriaRequest $request)
    {   
        Kriteria::create($request->all());
        
        return redirect()->route('kriterias.index')
                        ->with('success','Kriteria created successfully.');
    }
  
    public function show(Kriteria $kriteria)
    {
        return view('kriterias.show',compact('kriteria'));
    }
  
    public function edit(Kriteria $kriteria)
    {
        $kaders = Kader::doesnthave('kriteria')->get();
        return view('kriterias.edit',compact('kriteria', 'kaders'));
    }
  
    public function update(KriteriaRequest $request, Kriteria $kriteria)
    {
        $kriteria->update($request->all());
         
        return redirect()->route('kriterias.index')
                        ->with('success','Kriteria updated successfully');
    }
   
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
  
        return redirect()->route('kriterias.index')
                        ->with('success','Kriteria deleted successfully');
    }

    public function generatePdf() {
        $kriterias = Kriteria::all();
        $pdf = PDF::loadview('laporan.kriteria', ['kriterias' => $kriterias]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('laporan-kriteria');
    } 
}
