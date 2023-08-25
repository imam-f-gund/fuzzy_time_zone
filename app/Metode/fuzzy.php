<?php
namespace App\Metode;

class fuzzy{
    public function nilaiPrediksi($data){
        $jmlkelas = count($data);
        $pendapatan = [];
        $datas = [];
        
        foreach ($data as $key => $value) {
          $pendapatan[] = $value['pendapatan'];
          $datas[]=[
            'bulan' => $value['bulan'],
            'tahun' => $value['tahun'],
          ];
        }

        $banyak_kelas = 1+3.3*log10($jmlkelas);
        $rentang_kelas =max($pendapatan) - min($pendapatan); 
        $interval_kelas = $rentang_kelas/$banyak_kelas;
      
        $return = [
            'min' => min($pendapatan),
            'max' => max($pendapatan),
            'banyak_kelas' => $banyak_kelas,
            'rentang_kelas' => $rentang_kelas,
            'interval_kelas' =>$interval_kelas
        ];
      
      return $this->intervalBaru($pendapatan,$return, $datas);
    }

    public function intervalBaru($pendapatan,$data, $datalain){
        $interval = [];
        $result = [];
        $result_interval = [];
        $hasil = [];
        $Fuzzyfikasi = ['a1','a2','a3','a4','a5','a6','a6'];
        $number = 1;
       foreach ($Fuzzyfikasi as $key => $value) {
        $intval = $data['interval_kelas']*($number++);
           
        if($value == 'a1'){
            $interval[] = [
                'interval_baru' => $intval,
                'interval' => $intval,
                'Fuzzyfikasi' =>$value,
            
            ];
        }else{
            $interval[] = [
                'interval' => $intval,
                'Fuzzyfikasi' =>$value,
            ];
        }
        
       }

       foreach ($interval as $key => $val) {
        // dd($interval);
        if(!empty($val['interval_baru'])){
            $result[]=[
                'interval' => $val['interval_baru'],
                'Fuzzyfikasi' =>$val['Fuzzyfikasi'],
                'interval_baru'=>0,
              
            ];
        }else{
            $result[]=[
                'interval' => $val['interval'],
                'Fuzzyfikasi' =>$val['Fuzzyfikasi'],
                'interval_baru'=>$interval[$key-1]['interval'],
              
            ];
        }
           
       }
       foreach ($result as $key => $value) {
        if($value['Fuzzyfikasi'] != 'a1'){
            $result_interval[]=[
                'fuzzyfikasi' => $result[$key-1]['Fuzzyfikasi'],
                'hasil' => ($value['interval']+$value['interval_baru'])/2
              
            ];
        }
        
       }

       foreach ($result_interval as $key => $value) {
            if ($value['fuzzyfikasi'] == $result[$key]['Fuzzyfikasi']) {
                $hasil[] = [
                    'interval' => $result[$key]['interval'],
                    'Fuzzyfikasi' =>$result[$key]['Fuzzyfikasi'],
                    'interval_baru'=>$result[$key]['interval_baru'],
                    'hasil' => $value['hasil']
                ];
            }
            
       }
       return $this->fuzzyfikasi($pendapatan,$interval, $hasil, $datalain);
    
    }

    public function fuzzyfikasi($pendapatan,$interval, $hasil, $datalain){
        $fuzzy = [];
       
        foreach ($pendapatan as $key => $value) {
          if ($value <= $interval[1]['interval']) {
            $fuzzy[] = [
                'pendapatan' => $value,
                'Fuzzyfikasi' => 'a1'
            ];
          }else if($value >= $interval[1]['interval'] && $value <= $interval[2]['interval']){
            $fuzzy[] = [
                'pendapatan' => $value,
                'Fuzzyfikasi' => 'a2'
            ];
          }
          else if($value >= $interval[2]['interval'] && $value <= $interval[3]['interval']){
            $fuzzy[] = [
                'pendapatan' => $value,
                'Fuzzyfikasi' => 'a3'
            ];
          }else if($value >= $interval[3]['interval'] && $value <= $interval[4]['interval']){
            $fuzzy[] = [
                'pendapatan' => $value,
                'Fuzzyfikasi' => 'a4'
            ];
          }else if( $value >= $interval[4]['interval'] && $value <= $interval[5]['interval']){
            $fuzzy[] = [
                'pendapatan' => $value,
                'Fuzzyfikasi' => 'a5'
            ];
          }else if( $value >= $interval[5]['interval'] && $value <= $interval[6]['interval']){
            $fuzzy[] = [
                'pendapatan' => $value,
                'Fuzzyfikasi' => 'a6'
            ];
          }
        }

        return $this->nilaiFLRFLRG($fuzzy, $hasil, $datalain);
     
    }

    public function nilaiFLRFLRG($fuzzy, $hasil_interval, $datalain){
        $arr = ['a1','a2','a3','a4','a5','a6'];
        $flr =[];
        $flr2 = [];
        $result_flrg = [];
        $a1 = []; $a2 = []; $a3 = []; $a4 = [];  $a5 = []; $a6 = [];
        $res = [];

        //FLR
        foreach ($fuzzy as $key => $value) {
            array_push($flr, $value['Fuzzyfikasi']);
           
        }

        for ($i=0; $i < count($flr); $i++) { 
            if($i+1 != count($flr)){
                $flr2 [] = [
                    'flr' => $flr[$i],
                    'flr2' => $flr[$i+1]
                ];
            }

        }

        //FLRG
        $flrg_a1 = array_map(function($value){
            return $value['flr'] == 'a1' ? $value['flr2'] : null;
        },$flr2);
        $flrg_a2 = array_map(function($value){
            return $value['flr'] == 'a2' ? $value['flr2'] : null;
        },$flr2);
        $flrg_a3 = array_map(function($value){
            return $value['flr'] == 'a3' ? $value['flr2'] : null;
        },$flr2);
        $flrg_a4 = array_map(function($value){
            return $value['flr'] == 'a4' ? $value['flr2'] : null;
        },$flr2);
        $flrg_a5 = array_map(function($value){
            return $value['flr'] == 'a5' ? $value['flr2'] : null;
        },$flr2);
        $flrg_a6 = array_map(function($value){
            return $value['flr'] == 'a6' ? $value['flr2'] : null;
        },$flr2);

        $result_flrg =[
            'a1'=> array_filter(array_unique($flrg_a1), fn($value) => !is_null($value)),
            'a2'=> array_filter(array_unique($flrg_a2), fn($value) => !is_null($value)),
            'a3'=> array_filter(array_unique($flrg_a3), fn($value) => !is_null($value)),
            'a4'=> array_filter(array_unique($flrg_a4), fn($value) => !is_null($value)),
            'a5'=> array_filter(array_unique($flrg_a5), fn($value) => !is_null($value)),
            'a6'=> array_filter(array_unique($flrg_a6), fn($value) => !is_null($value)),
        ]; 
        $result=[];
        foreach ($result_flrg as $keys => $value) {
           
            if($keys == 'a1')
            {
                foreach ($value as $key => $item) {
                    $result[] = [
                        'flrg'=>$keys,
                        'hasil'=>$item];
                }
            }else if($keys == 'a2')
            {
                foreach ($value as $key => $item) {
                    $result[] = [
                        'flrg'=>$keys,
                        'hasil'=>$item];
                }
            }else if($keys == 'a3')
            {
                foreach ($value as $key => $item) {
                    $result[] = [
                        'flrg'=>$keys,
                        'hasil'=>$item];
                }
            }else if($keys == 'a4')
            {
                foreach ($value as $key => $item) {
                    $result[] = [
                        'flrg'=>$keys,
                        'hasil'=>$item];
                }
            }else if($keys == 'a5')
            {
                foreach ($value as $key => $item) {
                    $result[] = [
                        'flrg'=>$keys,
                        'hasil'=>$item];
                }
            }else if($keys == 'a6')
            {
                foreach ($value as $key => $item) {
                    $result[] = [
                        'flrg'=>$keys,
                        'hasil'=>$item];
                }
            }
          
        }
      
        foreach ($result as $key => $value) {
            if($value['flrg'] == 'a1'){
              array_push($a1, $value['hasil']);
            }else if($value['flrg'] == 'a2'){
                array_push($a2, $value['hasil']);
            }else if($value['flrg'] == 'a3'){
                array_push($a3, $value['hasil']);
            }else if($value['flrg'] == 'a4'){
                array_push($a4, $value['hasil']);
            }else if($value['flrg'] == 'a5'){
                array_push($a5, $value['hasil']);
            }else if($value['flrg'] == 'a6'){
                array_push($a6, $value['hasil']);
            }
        }

        //
        $res =[
            'a1'=> $a1,
            'a2'=> $a2,
            'a3'=> $a3,
            'a4'=> $a4,
            'a5'=> $a5,
            'a6'=> $a6
        ]; 

        $nilai_interval = [];
        $nilai = 0;
        //NILAI INTEVAL

        foreach ($res as $key => $value) {
            foreach ($hasil_interval as $keys => $item) {
                foreach ($value as $keyss => $val) {
                    if($item['Fuzzyfikasi'] == $val){
                        $nilai = $item['hasil'];

                        $nilai_interval[]=[
                            'flrg' => $key,
                            'nilai' => $nilai
                        ];
                    }
                }
              
              
            }
        }
        
        $hasil_flrg_res = [];
        $rest_a1=[]; $rest_a2=[]; $rest_a3=[]; $rest_a4=[]; $rest_a5=[]; $rest_a6=[]; 
        $flrg1=[]; $flrg2=[]; $flrg3=[]; $flrg4=[]; $flrg5=[]; $flrg6=[];
        $sum1 = 0; $sum2 = 0; $sum3 = 0; $sum4 = 0; $sum5 = 0; $sum6 = 0; 

        foreach ($nilai_interval as $key => $value) {
          
            if($value['flrg'] == 'a1'){
                $flrg1[] = $value['flrg'];
                
                $sum1 += $value['nilai'];
                $rest_a1 = $sum1;
               
            }else if($value['flrg'] == 'a2'){
                $flrg2[] = $value['flrg'];
                $sum2 += $value['nilai'];
                $rest_a2 = $sum2;
            }else if($value['flrg'] == 'a3'){
                $flrg3[] = $value['flrg'];
                $sum3 += $value['nilai'];
                $rest_a3 = $sum3;
            }else if($value['flrg'] == 'a4'){
                $flrg4[] = $value['flrg'];
                $sum4 += $value['nilai'];
                $rest_a4 = $sum4;
            }else if($value['flrg'] == 'a5'){
                $flrg5[] = $value['flrg'];
                $sum5 += $value['nilai'];
                $rest_a5 = $sum5;
            }else if($value['flrg'] == 'a6'){
                $flrg6[] = $value['flrg'];
                $sum6 += $value['nilai'];
                $rest_a6 = $sum6;
            }
            
        }
       
       
        //RESULT FLRG

        $hasil_flrg_res=[
            'a1' => $rest_a1/count($flrg1),
            'a2' => $rest_a2/count($flrg2),
            'a3' => $rest_a3/count($flrg3),
            'a4' => $rest_a4/count($flrg4),
            'a5' => $rest_a5/count($flrg5),
            'a6' => $rest_a6/count($flrg6),
        ];
        $res = [];
        foreach ($fuzzy as $keys => $items) {
         
            foreach ($hasil_flrg_res as $key => $val) {
                if ($items['Fuzzyfikasi'] == $key) {
                    $res[]=[
                        'tahun'=>$datalain[$keys]['tahun'],
                        'bulan'=>$datalain[$keys]['bulan'],
                        'pendapatan'=>$items['pendapatan'],
                        'fuzzyfikasi'=>$key,
                        'nilai_flr'=>$val
                    ];
                }
              
            }
            
        }
        
        return $res;
    }

}