<?php

namespace App\Http\Controllers;

use App\import_excels;
use App\Imports\ExcelImport;
use App\info;
use Carbon\Carbon;
//use DateTime;
use DateTime;
use Illuminate\Http\Request;
use DB;
//use Maatwebsite\Excel\Facades\Excel;

use Excel;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Array_;


class ImportExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('import_excels')->get();
//        return view('import_excel', compact('data'));
        return response()->json([
            'data' => $data

        ], 200);
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

        $this->validate($request,[
            'select_file' => 'required|mimes:xls,xlsx,csv'
        ]);

        if($request->hasFile('select_file')) {
            $path = $request->file('select_file');
            $fileName = time() . '.' . $path->getClientOriginalExtension();
            $location = public_path('folder/' . $fileName);

            $array = Excel::toArray(new ExcelImport(), $path);
            $i = 0;
            $infoArray=array();
            $import_excelsArray=array();
////            dd($array[0][1][0]);
            if (!empty($array)) {

                foreach ($array as $key => $value) {
                    foreach ($value as $key1 => $value1) {
                        if ($value1[3] != null || $value1[2] != null || $value1[1] != null
                            || $value1[0] != null || $value1[4] != null || $value1[5] != null) {

                            if ($i == 0) {
                                $i++;
                                continue;
                            }


                            $import_excels = new import_excels();
                            $import_excels->batch_number = $value1[0];
                            $import_excels->date_of_batch = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
                                $value1[1]));
                            $import_excels->sponsor_number = $value1[2];
                            $mytime = Carbon::now();
                            $import_excels->created_at=$mytime->toDateTimeString();
                            $import_excelsArray[] = $import_excels->toArray();

                            $info = new info();
                            $info->Beneficiary_number = $value1[3];
                            $info->amount = $value1[4];
                            $info->coins = $value1[5];
                            $info->batch_number = $value1[0];
//                            $mytime = Carbon\Carbon::now();
                            $info->created_at=$mytime->toDateTimeString();
                            $infoArray[] = $info->toArray();

                            if ($import_excels->batch_number != $value1[0]) {
                                $import_excels->batch_number = $value1[0];

                                $import_excelsArray[] = $import_excels->toArray();


                                $infoArray[] = $info->toArray();
//                                $successMsg = 'Excel Data Imported successfully.1';
                            } elseif ($import_excels->batch_number == $value1[0] &&
                                $import_excels->sponsor_number == $value1[2]
                            && $import_excels->date_of_batch == \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
                                    $value1[1])) ) {

//                                $infoArray [] = $info->toArray();

//                                $successMsg = 'Excel Data Imported successfully.2';
                            } elseif ($import_excels->batch_number == $value1[0] &&
                                $import_excels->sponsor_number != $value1[2]) {
                                $successMsg = 'sponsor_number error but system continue';
                            }elseif ($import_excels->batch_number == $value1[0] ) {

//                                $infoArray [] = $info->toArray();

                                $successMsg = 'Excel Data Imported successfully.2';
                            }

                        }

                    }
                }
            }


//*************************another solve*************
//
//            if (!empty($array)) {
//
//                foreach ($array as $key => $value) {
//                    foreach ($value as $key1 => $value1) {
//                        if ($value1[3] != null || $value1[2] != null || $value1[1] != null
//                            || $value1[0] != null || $value1[4] != null || $value1[5] != null) {
//
//                            if ($i == 0) {
//                                $i++;
//                                continue;
//                            }
//
//
//                            $import_excels = new import_excels();
//                            $import_excels->batch_number = $value1[0];
//                            $import_excels->date_of_batch = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
//                                $value1[1]));
//                            $import_excels->sponsor_number = $value1[2];
//                            $import_excelsArray[] = $import_excels->toArray();
//
//                            $info = new info();
//                            $info->Beneficiary_number = $value1[3];
//                            $info->amount = $value1[4];
//                            $info->coins = $value1[5];
//                            $info->batch_number = $value1[0];
//                            $infoArray[] = $info->toArray();
//                        }
//                    }
//                }
//            }
//
//            $data1=array();
//            $data2=array();
//            $i=1;
//
//            foreach ($import_excelsArray as  $key=>$value ) {
//                if ($key<3 && $i<3) {
////                $i=1;
//                    $import_excels = new import_excels();
//                    $info = new info();
////                    $data1[]=$import_excelsArray[$key];
////                    $data2[]=$infoArray[$key];
//                    $import_excels->batch_number = $import_excelsArray[$key]['batch_number'];
//                    $import_excels->date_of_batch = $import_excelsArray[$key]['date_of_batch'];
////                        \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
////                        $value1[1]));
//
//                    $import_excels->sponsor_number = $import_excelsArray[$key]['sponsor_number'];
//                    $data1[] = $import_excels->toArray();
//
//                    if ($import_excelsArray[$key]['batch_number'] != $import_excelsArray[$i]['batch_number']) {
//                        $import_excels->batch_number = $import_excelsArray[$i]['batch_number'];
//                        $import_excels->date_of_batch = $import_excelsArray[$i]['date_of_batch'];
////                        \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
////                        $value1[1]));
//                        $import_excels->sponsor_number = $import_excelsArray[$i]['sponsor_number'];
//                        $data1[] = $import_excels->toArray();
//                        $info->Beneficiary_number = $infoArray[$i]['Beneficiary_number'];
//                        $info->amount = $infoArray[$i]['amount'];
//                        $info->coins = $infoArray[$i]['coins'];
//                        $info->batch_number = $infoArray[$i]['batch_number'];
//                        $data2[] = $info->toArray();
//
//                        $successMsg = 'Excel Data Imported successfully.1';
//                        $i++;
//                    } elseif ($import_excelsArray[$key]['batch_number'] == $import_excelsArray[$i]['batch_number'] &&
//                        $import_excelsArray[$key]['sponsor_number'] == $value[$i]['sponsor_number']) {
//
//                        $info->Beneficiary_number = $infoArray[$i]['Beneficiary_number'];
//                        $info->amount = $infoArray[$i]['amount'];
//                        $info->coins = $infoArray[$i]['coins'];
//                        $info->batch_number = $infoArray[$i]['batch_number'];
//                        $data2[] = $info->toArray();
//                        $successMsg = 'Excel Data Imported successfully.2';
//                        $i++;
//                    } elseif ($import_excelsArray[$key]['batch_number'] == $import_excelsArray[$i]['batch_number'] &&
//                        $import_excelsArray[$key]['sponsor_number'] != $import_excelsArray[$i]['sponsor_number']) {
//                        $successMsg = 'sponsor_number error';
//                        $i++;
//                    }
//                }
//            }
//            dd($data2);
                foreach ($import_excelsArray as  $value ){

      DB::table('import_excels')->insert($value );

                }


                foreach ($infoArray as $k=>$value ){

                    DB::table('infos')->insert($value );

                }
//        }


        }

        return response()->json([
            'successMsg' => $successMsg
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
}
