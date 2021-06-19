<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NumPHP\Core\NumArray;
use App\Models\Rangking;
use App\Models\Kriteria;

class RangkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dataPerPage = 10;

        $rangkings = Rangking::orderBy('nilai_preferensi', 'desc')->paginate($dataPerPage);
        $numRecords = Rangking::count();
        $message = null;

        $ahp = $this->ahp();
        $topsis = $this->topsis();
        // dd($this->ahp());

        if(isset($request->field) && isset($request->keyword)) {
            $field = $request->field;
            $keyword = $request->keyword;

            if($field == 'nama') {
                $rangkings = Rangking::whereHas('kader', function($query) use($field, $keyword) {
                    $query->where($field, 'LIKE', '%'.$keyword.'%');
                 });
            
            } else {
                $rangkings = Rangking::where($field, 'LIKE', '%'.$keyword.'%');
            }
            
            $numRecords = $rangkings->get()->count();
            $message = $numRecords." data ditemukan dengan kata kunci \"$keyword\"";
            if($numRecords > 0) $rangkings = $rangkings->paginate($dataPerPage);        
        }  
         
        return view('rangking.index',compact('rangkings', 'numRecords', 'message', 'ahp', 'topsis'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ahp()
    {
        // $matrix = Kriteria::all();
        //Matriks Perbandingan Berpasangan
        $matrix = array(
            '0' => (object) array(
                'pendidikan' => 1,
                'penyakit_berat' => 5,
                'pengetahuan_kesehatan' => 0.2,
                'keaktifan_sosial' => 0.1111,
                'keahlian_komputer' => 7,
                'kepribadian' => 0.1429,
                'mempunyai_hp' => 1,
                'avg' => null,
                'matrix_aw' => null
            ),
            '1' => (object) array(
                'pendidikan' => 0.2,
                'penyakit_berat' => 1,
                'pengetahuan_kesehatan' => 5,
                'keaktifan_sosial' => 0.1429,
                'keahlian_komputer' => 5,
                'kepribadian' => 3,
                'mempunyai_hp' => 5,
                'avg' => null,
                'matrix_aw' => null
            ),
            '2' => (object) array(
                'pendidikan' => 5,
                'penyakit_berat' => 0.2,
                'pengetahuan_kesehatan' => 1,
                'keaktifan_sosial' => 0.1429,
                'keahlian_komputer' => 5,
                'kepribadian' => 0.1429,
                'mempunyai_hp' => 5,
                'avg' => null,
                'matrix_aw' => null
            ),
            '3' => (object) array(
                'pendidikan' => 9,
                'penyakit_berat' => 7,
                'pengetahuan_kesehatan' => 7,
                'keaktifan_sosial' => 1,
                'keahlian_komputer' => 7,
                'kepribadian' => 0.2,
                'mempunyai_hp' => 3,
                'avg' => null,
                'matrix_aw' => null
            ),
            '4' => (object) array(
                'pendidikan' => 0.1429,
                'penyakit_berat' => 0.2,
                'pengetahuan_kesehatan' => 0.2,
                'keaktifan_sosial' => 0.1429,
                'keahlian_komputer' => 1,
                'kepribadian' => 0.1429,
                'mempunyai_hp' => 0.1429,
                'avg' => null,
                'matrix_aw' => null
            ),
            '5' => (object) array(
                'pendidikan' => 7,
                'penyakit_berat' => 0.3333,
                'pengetahuan_kesehatan' => 7,
                'keaktifan_sosial' => 5,
                'keahlian_komputer' => 7,
                'kepribadian' => 1,
                'mempunyai_hp' => 7,
                'avg' => null,
                'matrix_aw' => null
            ),
            '6' => (object) array(
                'pendidikan' => 1,
                'penyakit_berat' => 0.2,
                'pengetahuan_kesehatan' => 1,
                'keaktifan_sosial' => 0.3333,
                'keahlian_komputer' => 7,
                'kepribadian' => 0.1429,
                'mempunyai_hp' => 1,
                'avg' => null,
                'matrix_aw' => null
            ),
        );

        $sumPendidikan = 0;
        $sumPenyakitBerat = 0;
        $sumPengetahuanKesehatan = 0;
        $sumKeaktifanSosial = 0;
        $sumKeahlianKomputer = 0;
        $sumKepribadian = 0;
        $sumMempunyaiHp = 0;

        foreach ($matrix as $key) {
            $sumPendidikan += $key->pendidikan;
            $sumPenyakitBerat += $key->penyakit_berat;
            $sumPengetahuanKesehatan += $key->pengetahuan_kesehatan;
            $sumKeaktifanSosial += $key->keaktifan_sosial;
            $sumKeahlianKomputer += $key->keahlian_komputer;
            $sumKepribadian += $key->kepribadian;
            $sumMempunyaiHp += $key->mempunyai_hp;
        }

        // dd($sumPendidikan);

        //mencari eigen
        $eigenPendidikan = pow(($matrix[0]->pendidikan * $matrix[0]->penyakit_berat * $matrix[0]->pengetahuan_kesehatan * $matrix[0]->keaktifan_sosial * 
                            $matrix[0]->keahlian_komputer * $matrix[0]->kepribadian * $matrix[0]->mempunyai_hp), (1/7));
                            
        $eigenKeaktifanSosial = pow(($matrix[1]->pendidikan * $matrix[1]->penyakit_berat * $matrix[1]->pengetahuan_kesehatan * $matrix[1]->keaktifan_sosial * 
                               $matrix[1]->keahlian_komputer * $matrix[1]->kepribadian * $matrix[1]->mempunyai_hp), (1/7));

        $eigenKepribadian = pow(($matrix[2]->pendidikan * $matrix[2]->penyakit_berat * $matrix[2]->pengetahuan_kesehatan * $matrix[2]->keaktifan_sosial * 
                                      $matrix[2]->keahlian_komputer * $matrix[2]->kepribadian * $matrix[2]->mempunyai_hp), (1/7));

        $eigenPenyakitBerat = pow(($matrix[3]->pendidikan * $matrix[3]->penyakit_berat * $matrix[3]->pengetahuan_kesehatan * $matrix[3]->keaktifan_sosial * 
                                 $matrix[3]->keahlian_komputer * $matrix[3]->kepribadian * $matrix[3]->mempunyai_hp), (1/7));
        
        $eigenPengetahuanKesehatan = pow(($matrix[4]->pendidikan * $matrix[4]->penyakit_berat * $matrix[4]->pengetahuan_kesehatan * $matrix[4]->keaktifan_sosial * 
                                  $matrix[4]->keahlian_komputer * $matrix[4]->kepribadian * $matrix[4]->mempunyai_hp), (1/7));

        $eigenKeahlianKomputer = pow(($matrix[5]->pendidikan * $matrix[5]->penyakit_berat * $matrix[5]->pengetahuan_kesehatan * $matrix[5]->keaktifan_sosial * 
                             $matrix[5]->keahlian_komputer * $matrix[5]->kepribadian * $matrix[5]->mempunyai_hp), (1/7));
        
        $eigenMempunyaiHp = pow(($matrix[6]->pendidikan * $matrix[6]->penyakit_berat * $matrix[6]->pengetahuan_kesehatan * $matrix[6]->keaktifan_sosial * 
                             $matrix[6]->keahlian_komputer * $matrix[6]->kepribadian * $matrix[6]->mempunyai_hp), (1/7));

        $sumEigen = $eigenPendidikan + $eigenPenyakitBerat + $eigenPengetahuanKesehatan + $eigenKeaktifanSosial +
                    $eigenKeahlianKomputer + $eigenKepribadian + $eigenMempunyaiHp;

        $bobotPrioritasPendidikan = $eigenPendidikan / $sumEigen;
        $bobotPrioritasPenyakitBerat = $eigenPenyakitBerat / $sumEigen;
        $bobotPrioritasPengetahuanKesehatan = $eigenPengetahuanKesehatan / $sumEigen;
        $bobotPrioritasKeaktifanSosial = $eigenKeaktifanSosial / $sumEigen;
        $bobotPrioritasKeahlianKomputer = $eigenKeahlianKomputer / $sumEigen;
        $bobotPrioritasKepribadian = $eigenKepribadian / $sumEigen;
        $bobotPrioritasMempunyaiHp = $eigenMempunyaiHp / $sumEigen;
        
        $sumBobotPrioritas = $bobotPrioritasPendidikan
                            + $bobotPrioritasPenyakitBerat
                            + $bobotPrioritasPengetahuanKesehatan
                            + $bobotPrioritasKeaktifanSosial
                            + $bobotPrioritasKeahlianKomputer
                            + $bobotPrioritasKepribadian
                            + $bobotPrioritasMempunyaiHp;
            
        //menghitung bobot sintesa dan eigen
        
        $sintesaPendidikan = (($matrix[0]->pendidikan / $sumPendidikan) + ($matrix[0]->penyakit_berat / $sumPenyakitBerat) 
        + ($matrix[0]->pengetahuan_kesehatan / $sumPengetahuanKesehatan) + ($matrix[0]->keaktifan_sosial / $sumKeaktifanSosial) 
        + ($matrix[0]->keahlian_komputer / $sumKeahlianKomputer) + ($matrix[0]->kepribadian / $sumKepribadian) + ($matrix[0]->mempunyai_hp / $sumMempunyaiHp));
                            
        $sintesaKeaktifanSosial = (($matrix[1]->pendidikan / $sumPendidikan) + ($matrix[1]->penyakit_berat / $sumPenyakitBerat) 
        + ($matrix[1]->pengetahuan_kesehatan / $sumPengetahuanKesehatan) + ($matrix[1]->keaktifan_sosial / $sumKeaktifanSosial) 
        + ($matrix[1]->keahlian_komputer / $sumKeahlianKomputer) + ($matrix[1]->kepribadian / $sumKepribadian) + ($matrix[1]->mempunyai_hp / $sumMempunyaiHp));

        $sintesaKepribadian = (($matrix[2]->pendidikan / $sumPendidikan) + ($matrix[2]->penyakit_berat / $sumPenyakitBerat) 
        + ($matrix[2]->pengetahuan_kesehatan / $sumPengetahuanKesehatan) + ($matrix[2]->keaktifan_sosial / $sumKeaktifanSosial) 
        + ($matrix[2]->keahlian_komputer / $sumKeahlianKomputer) + ($matrix[2]->kepribadian / $sumKepribadian) + ($matrix[2]->mempunyai_hp / $sumMempunyaiHp));

        $sintesaPenyakitBerat = (($matrix[3]->pendidikan / $sumPendidikan) + ($matrix[3]->penyakit_berat / $sumPenyakitBerat) 
        + ($matrix[3]->pengetahuan_kesehatan / $sumPengetahuanKesehatan) + ($matrix[3]->keaktifan_sosial / $sumKeaktifanSosial) 
        + ($matrix[3]->keahlian_komputer / $sumKeahlianKomputer) + ($matrix[3]->kepribadian / $sumKepribadian) + ($matrix[3]->mempunyai_hp / $sumMempunyaiHp));
        
        $sintesaPengetahuanKesehatan = (($matrix[4]->pendidikan / $sumPendidikan) + ($matrix[4]->penyakit_berat / $sumPenyakitBerat) 
        + ($matrix[4]->pengetahuan_kesehatan / $sumPengetahuanKesehatan) + ($matrix[4]->keaktifan_sosial / $sumKeaktifanSosial) 
        + ($matrix[4]->keahlian_komputer / $sumKeahlianKomputer) + ($matrix[4]->kepribadian / $sumKepribadian) + ($matrix[4]->mempunyai_hp / $sumMempunyaiHp));

        $sintesaKeahlianKomputer = (($matrix[5]->pendidikan / $sumPendidikan) + ($matrix[5]->penyakit_berat / $sumPenyakitBerat) 
        + ($matrix[5]->pengetahuan_kesehatan / $sumPengetahuanKesehatan) + ($matrix[5]->keaktifan_sosial / $sumKeaktifanSosial) 
        + ($matrix[5]->keahlian_komputer / $sumKeahlianKomputer) + ($matrix[5]->kepribadian / $sumKepribadian) + ($matrix[5]->mempunyai_hp / $sumMempunyaiHp));
        
        $sintesaMempunyaiHp = (   ($matrix[6]->pendidikan / $sumPendidikan) 
                                + ($matrix[6]->penyakit_berat / $sumPenyakitBerat) 
                                + ($matrix[6]->pengetahuan_kesehatan / $sumPengetahuanKesehatan) 
                                + ($matrix[6]->keaktifan_sosial / $sumKeaktifanSosial) 
                                + ($matrix[6]->keahlian_komputer / $sumKeahlianKomputer) 
                                + ($matrix[6]->kepribadian / $sumKepribadian) 
                                + ($matrix[6]->mempunyai_hp / $sumMempunyaiHp));

        //menghitung eigen makxs
        $eigenMaxPendidikan = $sintesaPendidikan / $bobotPrioritasPendidikan;
        $eigenMaxPenyakitBerat = $sintesaPenyakitBerat / $bobotPrioritasPenyakitBerat;
        $eigenMaxPengetahuanKesehatan = $sintesaPengetahuanKesehatan / $bobotPrioritasPengetahuanKesehatan;
        $eigenMaxKeaktifanSosial = $sintesaKeaktifanSosial / $bobotPrioritasKeaktifanSosial;
        $eigenMaxKeahlianKomputer = $sintesaKeahlianKomputer / $bobotPrioritasKeahlianKomputer;
        $eigenMaxKepribadian = $sintesaKepribadian / $bobotPrioritasKepribadian;
        $eigenMaxMempunyaiHp = $sintesaMempunyaiHp / $bobotPrioritasMempunyaiHp;

        $sumEigenMax = $eigenMaxPendidikan + $eigenMaxPenyakitBerat + $eigenMaxPengetahuanKesehatan + $eigenMaxKeaktifanSosial
                        + $eigenMaxKeahlianKomputer + $eigenMaxKepribadian + $eigenMaxMempunyaiHp;

        $lambdaMax = $sumEigenMax / 7;
        $newCI = ($lambdaMax - 7) / 7 ;
        $indexRatio = 1.32;
        $newCR = $newCI / $indexRatio;

        $matrix[0]->avg = $sintesaPendidikan;
        $matrix[1]->avg = $sintesaKeaktifanSosial;
        $matrix[2]->avg = $sintesaKepribadian;
        $matrix[3]->avg = $sintesaPenyakitBerat;
        $matrix[4]->avg = $sintesaPengetahuanKesehatan;
        $matrix[5]->avg = $sintesaKeahlianKomputer;
        $matrix[6]->avg = $sintesaMempunyaiHp;

        $res = (object) array(
            'status' => ($newCR < 0.1) ? 'KONSISTEN' : 'TIDAK KONSISTEN',
            'lambda' => $lambdaMax,
            'ci'     => $newCI,
            'cr'     => $newCR,
            'matrix' => $matrix,
        );
        return $res;
    }

    public function topsis()
    {
        $dataAHP = $this->ahp();
        $kriteria = $dataAHP->matrix;
        $bobot = [];

        for ($i=0; $i < 7; $i++) { 
            $bobot[$i] = $kriteria[$i]->avg;
        }

        $matrix = Kriteria::all();

        //merubah nilai dari tabel kriteria menjadi nilai skalar, bukan varchar atau boolean
        for($i = 0; $i < count($matrix); $i++) {
            $matrix[$i]->pendidikan = $this->convertToScalar('pendidikan', $matrix[$i]->pendidikan);    
            $matrix[$i]->penyakit_berat = $this->convertToScalar('penyakit_berat', $matrix[$i]->penyakit_berat);    
            $matrix[$i]->pengetahuan_kesehatan = $this->convertToScalar('pengetahuan_kesehatan', $matrix[$i]->pengetahuan_kesehatan);    
            $matrix[$i]->keaktifan_sosial = $this->convertToScalar('keaktifan_sosial', $matrix[$i]->keaktifan_sosial);    
            $matrix[$i]->keahlian_komputer = $this->convertToScalar('keahlian_komputer', $matrix[$i]->keahlian_komputer);    
            $matrix[$i]->kepribadian = $this->convertToScalar('kepribadian', $matrix[$i]->kepribadian);    
            $matrix[$i]->mempunyai_hp = $this->convertToScalar('mempunyai_hp', $matrix[$i]->mempunyai_hp);
        }

        // echo '<table border="1">';
        // foreach ($matrix as $key) {
        //         echo "<tr>
        //             <td width='200px'><center>".$key->kader->nama."</center></td>
        //             <td width='100px'><center>$key->pendidikan</center></td>
        //             <td width='100px'><center>$key->keaktifan_sosial</center></td>
        //             <td width='100px'><center>$key->kepribadian</center></td>
        //             <td width='100px'><center>$key->penyakit_berat</center></td>
        //             <td width='100px'><center>$key->pengetahuan_kesehatan</center></td>
        //             <td width='100px'><center>$key->keahlian_komputer</center></td>
        //             <td width='100px'><center>$key->mempunyai_hp</center></td>
        //         </tr>";
        // }
        // echo '</table>';

        //mencari pembagi
        $pembagi = ['pendidikan' => 0, 'penyakit_berat' => 0, 'pengetahuan_kesehatan' => 0, 'keaktifan_sosial' => 0, 
                    'keahlian_komputer' => 0, 'kepribadian' => 0, 'mempunyai_hp' => 0];

        for($i = 0; $i < count($matrix); $i++) {
            $pembagi['pendidikan'] += pow($matrix[$i]->pendidikan, 2);    
            $pembagi['keaktifan_sosial'] += pow($matrix[$i]->keaktifan_sosial, 2);    
            $pembagi['kepribadian'] += pow($matrix[$i]->kepribadian, 2);    
            $pembagi['penyakit_berat'] += pow($matrix[$i]->penyakit_berat, 2);    
            $pembagi['pengetahuan_kesehatan'] += pow($matrix[$i]->pengetahuan_kesehatan, 2);    
            $pembagi['keahlian_komputer'] += pow($matrix[$i]->keahlian_komputer, 2);    
            $pembagi['mempunyai_hp'] += pow($matrix[$i]->mempunyai_hp, 2);

            if($i==(count($matrix)-1)) {
                $pembagi['pendidikan'] = sqrt($pembagi['pendidikan']);    
                $pembagi['keaktifan_sosial'] = sqrt($pembagi['keaktifan_sosial']);    
                $pembagi['kepribadian'] = sqrt($pembagi['kepribadian']);    
                $pembagi['penyakit_berat'] = sqrt($pembagi['penyakit_berat']);    
                $pembagi['pengetahuan_kesehatan'] = sqrt($pembagi['pengetahuan_kesehatan']);    
                $pembagi['keahlian_komputer'] = sqrt($pembagi['keahlian_komputer']);    
                $pembagi['mempunyai_hp'] = sqrt($pembagi['mempunyai_hp']);
            }
        }

        //menghitung matrix ternormalisasi dan bobot ternormalisasi        
        $matrixNormalisasi = array();
        $bobotNormalisasi = array();

        $i = 0;
        foreach ($matrix as $key) {
            $matrixNormalisasi[$i] = new \stdClass();
            $matrixNormalisasi[$i]->kader_id = $key->kader_id; //jangan lupa diganti
            $matrixNormalisasi[$i]->pendidikan = (($key->pendidikan / $pembagi['pendidikan']));
            $matrixNormalisasi[$i]->keaktifan_sosial = (($key->keaktifan_sosial / $pembagi['keaktifan_sosial']));
            $matrixNormalisasi[$i]->penyakit_berat = (($key->penyakit_berat / $pembagi['penyakit_berat']));
            $matrixNormalisasi[$i]->pengetahuan_kesehatan = (($key->pengetahuan_kesehatan / $pembagi['pengetahuan_kesehatan']));
            $matrixNormalisasi[$i]->keahlian_komputer = (( $key->keahlian_komputer / $pembagi['keahlian_komputer']));
            $matrixNormalisasi[$i]->kepribadian = (($key->kepribadian / $pembagi['kepribadian']));
            $matrixNormalisasi[$i]->mempunyai_hp = (($key->mempunyai_hp / $pembagi['mempunyai_hp']));

            $bobotNormalisasi[$i] = new \stdClass();
            $bobotNormalisasi[$i]->kader_id = $matrixNormalisasi[$i]->kader_id;
            $bobotNormalisasi[$i]->pendidikan = (($matrixNormalisasi[$i]->pendidikan * $bobot[0]));
            $bobotNormalisasi[$i]->keaktifan_sosial = (($matrixNormalisasi[$i]->keaktifan_sosial * $bobot[1]));
            $bobotNormalisasi[$i]->kepribadian = (($matrixNormalisasi[$i]->kepribadian * $bobot[2]));
            $bobotNormalisasi[$i]->penyakit_berat = (($matrixNormalisasi[$i]->penyakit_berat * $bobot[3]));
            $bobotNormalisasi[$i]->pengetahuan_kesehatan = (($matrixNormalisasi[$i]->pengetahuan_kesehatan * $bobot[4]));
            $bobotNormalisasi[$i]->keahlian_komputer = (($matrixNormalisasi[$i]->keahlian_komputer * $bobot[5]));
            $bobotNormalisasi[$i]->mempunyai_hp = (($matrixNormalisasi[$i]->mempunyai_hp * $bobot[6]));

            $i++;
        }


        // echo '<h1>BOBOT AHP</h1><table border="1">';
        // for($o=0; $o < 1; $o++) {
        //     echo "
        //     <tr>
        //         <td width='200px'><center>Pendidikan</center></td>
        //         <td width='200px'><center>".$bobot[0]."</center></td></tr><tr>
        //         <td width='100px'><center>Keaktifan Sosial</center></td>
        //         <td width='100px'><center>".$bobot[1]."</center></td></tr><tr>
        //         <td width='100px'><center>Kepribadian</center></td>
        //         <td width='100px'><center>".$bobot[2]."</center></td></tr><tr>
        //         <td width='100px'><center>Penyakit Berat</center></td>
        //         <td width='100px'><center>".$bobot[3]."</center></td></tr><tr>
        //         <td width='100px'><center>Pengetahuan Kesehatan</center></td>
        //         <td width='100px'><center>".$bobot[4]."</center></td></tr><tr>
        //         <td width='100px'><center>Keahlian Komputer</center></td>
        //         <td width='100px'><center>".$bobot[5]."</center></td></tr><tr>
        //         <td width='100px'><center>Mempunyai HP</center></td>
        //         <td width='100px'><center>".$bobot[6]."</center></td></tr>";
        // }
        // echo '</table>';
        
        // echo '<h1>Matrix Normalisasi</h1><table border="1">';
        // foreach ($matrixNormalisasi as $key) {
        //         echo "<tr>
        //             <td width='200px'><center>".$key->kader_id."</center></td>
        //             <td width='100px'><center>$key->pendidikan</center></td>
        //             <td width='100px'><center>$key->keaktifan_sosial</center></td>
        //             <td width='100px'><center>$key->kepribadian</center></td>
        //             <td width='100px'><center>$key->penyakit_berat</center></td>
        //             <td width='100px'><center>$key->pengetahuan_kesehatan</center></td>
        //             <td width='100px'><center>$key->keahlian_komputer</center></td>
        //             <td width='100px'><center>$key->mempunyai_hp</center></td>
        //         </tr>";
        // }
        // echo '</table>';

        // echo '<h1>Bobot Normalisasi</h1><table border="1">';
        // foreach ($bobotNormalisasi as $key) {
        //         echo "<tr>
        //             <td width='200px'><center>".$key->kader_id."</center></td>
        //             <td width='100px'><center>$key->pendidikan</center></td>
        //             <td width='100px'><center>$key->keaktifan_sosial</center></td>
        //             <td width='100px'><center>$key->kepribadian</center></td>
        //             <td width='100px'><center>$key->penyakit_berat</center></td>
        //             <td width='100px'><center>$key->pengetahuan_kesehatan</center></td>
        //             <td width='100px'><center>$key->keahlian_komputer</center></td>
        //             <td width='100px'><center>$key->mempunyai_hp</center></td>
        //         </tr>";
        // }
        // echo '</table>';


        //menghitung solusi ideal positif dan solusi ideal negatif
        $data = $bobotNormalisasi;
        $mKaderId = [];
        $mPendidikan = [];
        $mPenyakitBerat = [];
        $mPengetahuanKesehatan = [];
        $mKeaktifanSosial = [];
        $mKeahlianKomputer = [];
        $mKepribadian = [];
        $mMempunyaiHp = [];

        $i = 0;
        foreach ($data as $key) {
            $mKaderId[$i] = $key->kader_id;
            $mPendidikan[$i] = $key->pendidikan;
            $mKeaktifanSosial[$i] = $key->keaktifan_sosial;
            $mKepribadian[$i] = $key->kepribadian;
            $mPenyakitBerat[$i] = $key->penyakit_berat;
            $mPengetahuanKesehatan[$i] = $key->pengetahuan_kesehatan;
            $mKeahlianKomputer[$i] = $key->keahlian_komputer;
            $mMempunyaiHp[$i] = $key->mempunyai_hp;
            $i++;
        }

        // matrix ideal positif
        $y1Positif = max($mPendidikan);
        $y2Positif = max($mKeaktifanSosial);
        $y3Positif = max($mKepribadian);
        $y4Positif = max($mPenyakitBerat);
        $y5Positif = max($mPengetahuanKesehatan);
        $y6Positif = max($mKeahlianKomputer);
        $y7Positif = max($mMempunyaiHp);

        // matrix ideal negatif
        $y1Negatif = min($mPendidikan);
        $y2Negatif = min($mKeaktifanSosial);
        $y3Negatif = min($mKepribadian);
        $y4Negatif = min($mPenyakitBerat);
        $y5Negatif = min($mPengetahuanKesehatan);
        $y6Negatif = min($mKeahlianKomputer);
        $y7Negatif = min($mMempunyaiHp);

        // echo '<h1>A+ dan A-</h1><table border="1">';
        // echo "<tr>
        //     <td width='200px'><center>A+</center></td>";
        //     for ($i=1; $i < 8; $i++) { 
        //         echo "<td width='100px'><center>".${'y'.$i.'Positif'}."</center></td>";
        //     }
        // echo "<tr>
        //     <td width='200px'><center>A-</center></td>";
        // for ($i=1; $i < 8; $i++) { 
        //     echo "<td width='100px'><center>".${'y'.$i.'Negatif'}."</center></td>";
        // }
        // echo '</table>';

        //perhitungan solusi ideal
        $dPositif = array();
        $dNegatif = array();

        //perhitungan ideal positif
        for ($i = 0; $i < count($mKaderId); $i++) {
            $dPositif[$i] = new \stdClass();
            $dPositif[$i]->kader_id = $mKaderId[$i];
            $dPositif[$i]->dPositif = sqrt(
                pow(($y1Positif - $mPendidikan[$i]), 2) +
                pow(($y2Positif - $mKeaktifanSosial[$i]), 2) +
                pow(($y3Positif - $mKepribadian[$i]), 2) +
                pow(($y4Positif - $mPenyakitBerat[$i]), 2) +
                pow(($y5Positif - $mPengetahuanKesehatan[$i]), 2) +
                pow(($y6Positif - $mKeahlianKomputer[$i]), 2) +
                pow(($y7Positif - $mMempunyaiHp[$i]), 2)
            );
        }

        //perhitungan ideal negatif
        for ($i = 0; $i < count($mKaderId); $i++) {
            $dNegatif[$i] = new \stdClass();
            $dNegatif[$i]->kader_id = $mKaderId[$i];
            $dNegatif[$i]->dNegatif = sqrt(
                pow(($mPendidikan[$i] - $y1Negatif), 2) +
                pow(($mKeaktifanSosial[$i] - $y2Negatif), 2) +
                pow(($mKepribadian[$i] - $y3Negatif), 2) +
                pow(($mPenyakitBerat[$i] - $y4Negatif), 2) +
                pow(($mPengetahuanKesehatan[$i] - $y5Negatif), 2) +
                pow(($mKeahlianKomputer[$i] - $y6Negatif), 2) +
                pow(($mMempunyaiHp[$i] - $y7Negatif), 2)
            );
        }

        // echo '<h1>D+</h1><table border="1">';
        // foreach ($dPositif as $key) {
        //         echo "<tr>
        //             <td width='200px'><center>".$key->kader_id."</center></td>
        //             <td width='100px'><center>$key->dPositif</center></td>
        //         </tr>";
        // }
        // echo '</table>';

        
        // echo '<h1>D-</h1><table border="1">';
        // foreach ($dNegatif as $key) {
        //         echo "<tr>
        //             <td width='200px'><center>".$key->kader_id."</center></td>
        //             <td width='100px'><center>$key->dNegatif</center></td>
        //         </tr>";
        // }
        // echo '</table>';

        //hitung nilai preferensi
        $positif = $dPositif;
        $negatif = $dNegatif;

        Rangking::truncate();
        for ($i = 0; $i < count($negatif); $i++) {
            $pref = new Rangking;
            $pref->kader_id = $negatif[$i]->kader_id;
            $pref->nilai_preferensi = $negatif[$i]->dNegatif / ($negatif[$i]->dNegatif + $positif[$i]->dPositif);
            $pref->save();
        }

        $res = (object) array(
            'dNegatif' => $positif,
            'dPositif' => $negatif,
        );
        return $res;
    }

    private function convertToScalar($key, $value)
    {
        $convertedValue = null;
        switch (strtolower($key)) {
            case 'pendidikan':
                $value = strtolower($value);
                if($value=='strata-1') $convertedValue = 5;
                elseif($value=='d3') $convertedValue = 4;
                elseif($value=='sma') $convertedValue = 3;
                elseif($value=='smp') $convertedValue = 2;
                else $convertedValue = 1;
                break;
            
            case 'penyakit_berat':
                ($value=='1') ? $convertedValue = 1 : $convertedValue = 5; 
                break;

            case 'mempunyai_hp':
            case 'keahlian_komputer':
                ($value=='1') ? $convertedValue = 5 : $convertedValue = 1;
                break;

            case 'pengetahuan_kesehatan':
            case 'keaktifan_sosial':
            case 'kepribadian':
                $value = strtolower($value);
                if($value=='baik') $convertedValue = 5;
                elseif($value=='cukup') $convertedValue = 3;
                else $convertedValue = 1;
                break;
                
            default:
            
                break;
        }
        
        return $convertedValue;
    }
}
