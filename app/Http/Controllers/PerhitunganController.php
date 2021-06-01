<?php

namespace App\Http\Controllers;

use NumPHP\Core\NumArray;
use App\Models\Kriteria;

class PerhitunganController extends Controller
{
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

        $kriteria = ['Pendidikan', 'Penyakit Berat', 'Pengetahuan Kesehatan', 'Keaktifan Sosial', 'Keahlian Komputer', 'Kepribadian', 'Mempunyai HP'];
        $tempBobot = $matrix;
        for ($i = 0; $i < 7; $i++) {
            // $tempBobot[$i]->kriteria = $kriteria[$i];
            $tempBobot[$i]->pendidikan = (($matrix[$i]->pendidikan / $sumPendidikan));
            $tempBobot[$i]->penyakit_berat = (($matrix[$i]->penyakit_berat / $sumPenyakitBerat));
            $tempBobot[$i]->pengetahuan_kesehatan = (($matrix[$i]->pengetahuan_kesehatan / $sumPengetahuanKesehatan));
            $tempBobot[$i]->keaktifan_sosial = (($matrix[$i]->keaktifan_sosial / $sumKeaktifanSosial));
            $tempBobot[$i]->keahlian_komputer = (($matrix[$i]->keahlian_komputer / $sumKeahlianKomputer));
            $tempBobot[$i]->kepribadian = (($matrix[$i]->kepribadian / $sumKepribadian));
            $tempBobot[$i]->mempunyai_hp = (($matrix[$i]->mempunyai_hp / $sumMempunyaiHp));
        }

        $mKriteria = $tempBobot;
        foreach ($mKriteria as $key) {
            $sum = $key->pendidikan + $key->penyakit_berat + $key->pengetahuan_kesehatan + $key->keaktifan_sosial + $key->keahlian_komputer + $key->kepribadian + $key->mempunyai_hp;
            $avg = $sum / 7;
            $key->avg = ($avg);
            // $key->update();
        }


        //Hitung Konsistensi Bobot
        
        $tempA = $matrix;
        $tempW = $mKriteria;
        $matrixA = [[]];

        $i = 0;
        foreach ($tempA as $key) {
            $matrixA[$i][0] = $key->pendidikan;
            $matrixA[$i][1] = $key->penyakit_berat;
            $matrixA[$i][2] = $key->pengetahuan_kesehatan;
            $matrixA[$i][3] = $key->keaktifan_sosial;
            $matrixA[$i][4] = $key->keahlian_komputer;
            $matrixA[$i][5] = $key->kepribadian;
            $matrixA[$i][6] = $key->mempunyai_hp;
            $i++;
        }

        $matrixW = [[]];
        $i = 0;
        foreach ($tempW as $key) {
            $matrixW[$i][0] = $key->avg;
            $i++;
        }

        $matA = new NumArray($matrixA);
        $matW = new NumArray($matrixW);
        $matA->dot($matW);

        $final = $matA->getData();

        for ($i = 0; $i < 7; $i++) {
            $tempW[$i]->matrix_aw = $final[$i][0];
            // $tempW[$i]->save();
        }

        $lambda = 0;
        foreach ($tempW as $key) {
            $lambda += ($key->matrix_aw / $key->avg);
        }
        // $lambda /= 7;

        $ci = (($lambda - 7) / (7 - 1));
        $cr = ($ci / 1.32);

        if ($cr <= 0.1) {
            echo 'konsisten<br>Lambda: '.$lambda.'<br>CI: '.$ci.'<br>CR: '.$cr;
            // return redirect()->route('topsis.nor');
        } else {
            echo 'tidak konsisten<br>Lambda: '.$lambda.'<br>CI: '.$ci.'<br>CR: '.$cr;

            // return view('inconsistent', [
            //     'lambda' => $lambda,
            //     'ci' => $ci,
            //     'cr' => $cr
            // ]);
        }
        echo'<br><br><hr>';
        foreach ($tempW as $key) {
            echo json_encode($key);
        }
        dd();
        // return redirect()->route('ahp.uk');
    }
}
