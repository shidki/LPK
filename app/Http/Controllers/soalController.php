<?php

namespace App\Http\Controllers;

use App\Models\jawaban;
use App\Models\opsi_pg;
use App\Models\soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class soalController extends Controller
{
    //
    public function add_soal(Request $request){

        $idKuis = $request->kuiss;
        $soal = $request->soal;
        $tipe_soal = $request->tipe_soal;
        $isian = $request->isian;
        $opsiA = $request->opsiA;
        $opsiB = $request->opsiB;
        $opsiC = $request->opsiC;
        $opsiD = $request->opsiD;
        $jawabanBenar = $request->checkOpsi;

        // menambah data ke table soal dlu
        // cek pertanyaan udha ad apa blom\
        $getPertanyaan = soal::where("pertanyaan",'=',$soal)->first();
        if($getPertanyaan == true){
            return back()->with(['error_add' => "pertanyaan sudah tersedia"]);
        }

        //jika belum memilih jawaban yang benar
        if($tipe_soal == 'pilgan'){
            if($jawabanBenar == null){
                return back()->with(['error_add' => "Kunci Jawaban belum dibuat pada soal ini"]);
            }
        }

        $insertSoal = DB::table("soals")->insert([
            "pertanyaan" => $soal,
            "type_soal" => $tipe_soal,
            "id_kuis" => $idKuis
        ]);
        if($insertSoal == true){
            $getSoal = soal::where("pertanyaan",'=',$soal)->first();
            if($tipe_soal == 'pilgan'){
                // menambah data ke opsi jawban dlu
                $insertOpsiA = DB::table("opsi_pgs")->insert([
                    "opsi" => $opsiA,
                    "id_soal" => $getSoal->id_soal,
                ]);
                if($insertOpsiA == true){
                    $cekOpsiB = opsi_pg::where("opsi",'=',$opsiB)->where("id_soal",'=',$getSoal->id_soal)->first();
                        if($cekOpsiB == true){
                            $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                            $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                            if($deleteOpsiA && $deleteSoal){
                                return back()->with(['error_add' => "Isi dari Opsi B sudah tersedia pada soal ini"]);
                            }else{
                                return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal , opsi A,B,C"]);
                            }
                        }
                    $insertOpsiB = DB::table("opsi_pgs")->insert([
                        "opsi" => $opsiB,
                        "id_soal" => $getSoal->id_soal,
                    ]);
                    if($insertOpsiB == true){
                        $cekOpsiC = opsi_pg::where("opsi",'=',$opsiC)->where("id_soal",'=',$getSoal->id_soal)->first();
                        if($cekOpsiC == true){
                            $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                            $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                            $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                            if($deleteOpsiA && $deleteOpsiB && $deleteSoal){
                                return back()->with(['error_add' => "Isi dari Opsi C sudah tersedia pada soal ini"]);
                            }else{
                                return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal , opsi A,B,C"]);
                            }
                        }
                        $insertOpsiC = DB::table("opsi_pgs")->insert([
                            "opsi" => $opsiC,
                            "id_soal" => $getSoal->id_soal,
                        ]);
                        if($insertOpsiC == true){
                            $cekOpsiD = opsi_pg::where("opsi",'=',$opsiD)->where("id_soal",'=',$getSoal->id_soal)->first();
                            if($cekOpsiD == true){
                                $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                                $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                                $deleteOpsiC = opsi_pg::where("opsi",'=',$opsiC)->delete();
                                $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                                if($deleteOpsiA && $deleteOpsiB && $deleteOpsiC && $deleteSoal){
                                    return back()->with(['error_add' => "Isi dari Opsi D sudah tersedia pada soal ini"]);
                                }else{
                                    return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal , opsi A,B,C"]);
                                }
                            }
                            $insertOpsiD = DB::table("opsi_pgs")->insert([
                                "opsi" => $opsiD,
                                "id_soal" => $getSoal->id_soal,
                            ]);
                            if($insertOpsiD == true){
                                // setelah berhasil menambah semua opsi, sekaang menambah data untuk jawban yang benar ke table jawaban
                                $insertJawaban = DB::table("jawabans")->insert([
                                    "id_soal" => $getSoal->id_soal,
                                    "jawaban" => $jawabanBenar,
                                ]);
                                if($insertJawaban == true){
                                    return back()->with(['sukses_add' => "berhasil menambah soal beserta jawaban"]);
                                }else{
                                    // jika jawaban benar gagal ditambahkan maka menghhaopus data soal dan semua opsi jawaban
                                    //jika gagal menambah opsi D, maka menghapus data soal dan opsi A B C
                                    $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                                    $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                                    $deleteOpsiC = opsi_pg::where("opsi",'=',$opsiC)->delete();
                                    $deleteOpsiD = opsi_pg::where("opsi",'=',$opsiD)->delete();
                                    $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                                    if($deleteOpsiA && $deleteOpsiB && $deleteOpsiC && $deleteOpsiD && $deleteSoal){
                                        return back()->with(['error_add' => "Gagal menambah soal beseta jawaban"]);
                                    }else{
                                        return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal , opsi A,B,C"]);
                                    }
                                }
                            }else{
                                //jika gagal menambah opsi D, maka menghapus data soal dan opsi A B C
                                $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                                $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                                $deleteOpsiC = opsi_pg::where("opsi",'=',$opsiC)->delete();
                                $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                                if($deleteOpsiA && $deleteOpsiB && $deleteOpsiC && $deleteSoal){
                                    return back()->with(['error_add' => "Gagal Menambah soal karena terdapat opsi yang sama"]);
                                }else{
                                    return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal , opsi A,B,C"]);
                                }
                            }
                        }else{
                            //jika gagal menambah opsi C, maka menghapus data soal dan opsi A B
                            $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                            $deleteOpsiB = opsi_pg::where("opsi",'=',$opsiB)->delete();
                            $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                            if($deleteOpsiA && $deleteOpsiB && $deleteSoal){
                                return back()->with(['error_add' => "Gagal Menambah soal karena terdapat opsi yang sama"]);
                            }else{
                                return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal , opsi A,B,C"]);
                            }
                        }
                    }
                    else{
                        //jika gagal menambah opsi B, maka menghapus data soal dan opsi A
                        $deleteOpsiA = opsi_pg::where("opsi",'=',$opsiA)->delete();
                        $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                        if($deleteOpsiA && $deleteSoal){
                            return back()->with(['error_add' => "Gagal Menambah soal karena terdapat opsi yang sama"]);
                        }else{
                            return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal , opsi A,B,C"]);
                        }
                    }
                }
                else{
                    //jika gagal menambah opsi A, maka menghapus data soal 
                    $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                    if($deleteSoal == true){
                        return back()->with(['error_add' => "Gagal Menambah soal karena terdapat opsi yang sama"]);
                    }else{
                        return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal , opsi A,B,C"]);
                    }
                }
            }else{
                if($tipe_soal == "isian"){
                    // karena tipe nya isiam, jadi langsung nambahin jawban ke table jawaban
                    $insertJawabanIsian = DB::table("jawabans")->insert([
                        "jawaban" => $isian,
                        "id_soal" => $getSoal->id_soal,
                    ]);
                    if($insertJawabanIsian == true){
                        return back()->with(['sukses_add' => "berhasil menambah soal beserta jawaban"]);
                    }else{
                        
                        // jika gagal, menghapus data soal yang telah ditambah sebelumnya dlu
                        $deleteSoal = soal::where("id_soal",'=',$getSoal->id_soal)->delete();
                        if($deleteSoal == true){
                            return back()->with(['error_add' => "Gagal Menambah soal beserta jawaban"]);
                        }else{
                            return back()->with(['error_add' => "Tedapat kesalahan saat menghapus soal"]);
                        }
                    }
                }
            }
        }
    }

    public function delete_soal($id){
        $getDataSoal = soal::where("id_soal",'=',$id)->first();
        if($getDataSoal->type_soal == "pilgan"){
            $deleteJawaban = DB::table("jawabans")->where("id_soal",'=',$id)->delete();
            if($deleteJawaban == true){
                $deleteOpsi= DB::table("opsi_pgs")->where("id_soal",'=',$id)->delete();
                if($deleteOpsi == true){
                    $deleteSoal= DB::table("soals")->where("id_soal",'=',$id)->delete();
                    if($deleteSoal == true){
                        return back()->with(['sukses_delete' => "Berhasil Menghapus Soal"]);
                    }else{
                        return back()->with(['error_delete' => "Berhasil Menghapus Soal"]);
                    }
                }else{
                    return back()->with(['error_delete' => "Berhasil Menghapus Soal"]);
                }
            }else{
                return back()->with(['error_delete' => "Berhasil Menghapus Soal"]);
            }
        }else{
            $deleteJawaban = DB::table("jawabans")->where("id_soal",'=',$id)->delete();
            if($deleteJawaban == true){
                $deleteSoal= DB::table("soals")->where("id_soal",'=',$id)->delete();
                if($deleteSoal == true){
                    return back()->with(['sukses_delete' => "Berhasil Menghapus Soal"]);
                }else{
                    return back()->with(['error_delete' => "Berhasil Menghapus Soal"]);
                }
            }else{
                return back()->with(['error_delete' => "Berhasil Menghapus Soal"]);
            }
        }
    }

    public function edit_soal(Request $request){
        $idSoal = $request->soalss;
        $soal = $request->soal;
        $isian = $request->isian;

        //cek apakah soal udah dipake atau belum
        $cekSoal = soal::where("pertanyaan",'=',$soal)->where("id_soal",'!=',$idSoal)->first();
        if($cekSoal == true){
            return back()->with(['error_edit' => "Pertanyaan sudah tersedia"]);
        }
        if($isian == null){
            $updateSoal = DB::table("soals")->where("id_soal",'=',$idSoal)->update([
                "pertanyaan" => $soal,
            ]);
            if($updateSoal == true){
                return back()->with(['sukses_edit' => "Berhasil Mengubah Pertanyaan"]);
            }else{
                return back()->with(['eror_edit' => "Gagal Menghapus Soal"]);
            }
        }else{
            $updateSoal = DB::table("soals")->where("id_soal",'=',$idSoal)->update([
                "pertanyaan" => $soal,
            ]);
            if($updateSoal == true){
                $updateJawaban = DB::table("jawabans")->where("id_soal",'=',$idSoal)->update([
                    "jawaban" => $isian,
                ]);
                if($updateJawaban == true){
                    return back()->with(['sukses_edit' => "Berhasil Mengubah Pertanyaan"]);
                }else{
                    return back()->with(['eror_edit' => "Gagal Mengubah Soal"]);
                }
            }else{
                return back()->with(['eror_edit' => "Gagal Mengubah Soal"]);
            }
        }
    }
    public function edit_opsi(Request $request){
        $id = $request->opsis;
        $Newopsi = $request->opsi;
        $trimNewopsi = str_replace(' ', '', $Newopsi);
        $OldOpsi = $request->oldOpsi;
        $idsoal = $request->soal;

        //cek apakah opsi yg di edit telah digunakan pada soal yang sama ?
        $getOpsi = opsi_pg::where("id_soal",'=',$idsoal)->get();
        foreach ($getOpsi as $item) {
            if (str_replace(' ', '', $item->opsi) == $trimNewopsi) {
                return back()->with(['error_edit' => "Opsi Jawaban Sudah Tersedia"]);
            }
        }

        $updateOpsi = DB::table("opsi_pgs")->where("id_opsi",'=',$id)->update([
            "opsi" => $Newopsi
        ]);
        
        if($updateOpsi == true){
            //mengecek apakah opsi yang diubah merupakah jawaban benar, jika iya mengubah data jawaban di jawaban benar
            $cekJawaban = jawaban::where("id_soal",'=',$idsoal)->where("jawaban",'=',$OldOpsi)->first();
            //dd($cekJawaban);
            if($cekJawaban == true){
                $updateJawaban = DB::table("jawabans")->where("id_jawaban",'=',$cekJawaban->id_jawaban)->update([
                    "jawaban" => $Newopsi
                ]);
                if($updateJawaban == true){
                    return back()->with(['sukses_edit' => "Berhasil Mengubah Opsi"]);
                }else{
                    return back()->with(['eror_edit' => "Gagal Mengubah Jawaban Benar pada Opsi"]);
                }
            }else{
                return back()->with(['sukses_edit' => "Berhasil Mengubah Opsi"]);
            }
        }else{
            return back()->with(['eror_edit' => "Gagal Mengubah Soal"]);
        }
    }

    public function edit_jawabanBenar(Request $request){
        $idSoal = $request->soalss;
        $jawaban = $request->jawaban;
        
        $updateJawaban = DB::table("jawabans")->where("id_soal",'=',$idSoal)->update([
            "jawaban" => $jawaban
        ]);
        if($updateJawaban == true){
            return back()->with(['sukses_edit' => "Berhasil Mengubah Jawaban"]);
        }else{
            return back()->with(['eror_edit' => "Gagal Mengubah Jawaban"]);
        }
    }
}
