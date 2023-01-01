<?php

namespace App\Http\Controllers;

use App\Models\Informasis;
use App\Models\Kegiatans;
use App\Models\Keluhans;
use App\Models\Pengundurans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    public function dashboard()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Anggota"], ['name' => "Informasi"]];

    $data=Informasis::get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/users/dashboard', ['val'=>$val,'data'=>$data,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }

  public function kegiatan()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Anggota"], ['name' => "Kegiatan"]];
    $data=Kegiatans::get();
    $val = array('primary','secondary','warning','danger','info');

        return view('layouts/users/kegiatan', ['data'=>$data,'val'=>$val,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }

  public function pengunduran()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Anggota"], ['name' => "Pengunduran Diri Anggota"]];
        return view('layouts/users/pengunduran', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function pengunduran_data()
  {
    $user=Pengundurans::select('pengundurans.*','users.name as nama','users.divisi as divisi')->join('users','users.card','=','pengundurans.id_card')->where('pengundurans.id_card','=',auth()->user()->card)->get();
    return ['data' => $user];
  }
  public function pengunduran_add(Request $request){
    $validator = Validator::make($request->all(), [
      'id_card' => 'required',
      'name' => 'required',
      'email' => 'required',
      'tanggal' => 'required',
      'alasan' => 'required',
    ]);
    if ($validator->fails()) {
      session()->flash('danger', 'Periksa ulang kembali.');
      return redirect()->route('pengunduran-user');
    }
    $user = Pengundurans::updateOrCreate([
        'id' => $request->id
    ], [
        'name' => $request->name,
        'email' => $request->email,
        'tanggal' => $request->tanggal,
        'id_card' => $request->id_card,
        'alasan' => $request->alasan,
        'status' => 'pengajuan'
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Ditambah.');
        //redirect
    }else{
        session()->flash('danger', 'Periksa ulang kembali.');
    }
    return redirect()->route('pengunduran-user');
  }

  public function keluhan()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Anggota"], ['name' => "Keluhan Anggota"]];
        return view('layouts/users/keluhan', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function keluhan_data()
  {
    $user=Keluhans::select('keluhans.*','users.name as nama','users.divisi as divisi')->join('users','users.card','=','keluhans.id_card')->where('keluhans.id_card','=',auth()->user()->card)->get();
    return ['data' => $user];
  }
  public function keluhan_add(Request $request){
    $validator = Validator::make($request->all(), [
      'id_card' => 'required',
      'name' => 'required',
      'tanggal' => 'required',
      'isi' => 'required',
    ]);
    if ($validator->fails()) {
      session()->flash('danger', 'Periksa ulang kembali.');
      return redirect()->route('pengunduran-user');
    }
    $user = Keluhans::updateOrCreate([
        'id' => $request->id
    ], [
        'name' => $request->name,
        'tanggal' => $request->tanggal,
        'id_card' => $request->id_card,
        'isi' => $request->isi,
        'tanggapan' => 'belum ada'
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Ditambah.');
        //redirect
    }else{
        session()->flash('danger', 'Periksa ulang kembali.');
    }
    return redirect()->route('keluhan-user');
  }
}
