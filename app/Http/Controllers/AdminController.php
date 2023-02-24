<?php

namespace App\Http\Controllers;

use App\Models\Informasis;
use App\Models\Kegiatans;
use App\Models\Keluhans;
use App\Models\Pengundurans;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
  public function dashboard()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Admin"], ['name' => "Informasi"]];

    $data=Informasis::get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/dashboard', ['val'=>$val,'data'=>$data,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function informasi_add(Request $request){
    $validator = Validator::make($request->all(), [
      'info_judul' => 'required',
      'info_isi' => 'required',
      'info_tanggal' => 'required',
      'info_file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
      session()->flash('error', 'Periksa ulang kembali data anda.');
      return redirect()->route('dashboard-admin');
    }
    if($request->info_file){
      $path_logo = 'informasi/'.time().'.informasi.'.$request->info_file->extension();
      // Public Folder
      $request->info_file->storeAs('images', $path_logo,'public');
    }else{
      $path_logo='';
    }
    $user = Informasis::updateOrCreate([
        'id' => $request->id
    ], [
        'judul' => $request->info_judul,
        'isi' => $request->info_isi,
        'tanggal' => $request->info_tanggal,
        'foto' => $path_logo
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Ditambah.');
        //redirect
    }
    return redirect()->route('dashboard-admin');
  }

  public function kegiatan()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Admin"], ['name' => "Kegiatan"]];
    $data=Kegiatans::get();
    $val = array('primary','secondary','warning','danger','info');

        return view('layouts/admin/kegiatan', ['data'=>$data,'val'=>$val,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function kegiatan_add(Request $request){
    $validator = Validator::make($request->all(), [
      'info_judul' => 'required',
      'info_isi' => 'required',
      'info_tanggal' => 'required',
      'info_tempat' => 'required',
      'info_alamat' => 'required',
    ]);

    if ($validator->fails()) {
      session()->flash('danger', 'Periksa ulang kembali.');
      return redirect()->route('kegiatan-add-admin');
    }
    $user = Kegiatans::updateOrCreate([
        'id' => $request->id
    ], [
        'judul' => $request->info_judul,
        'isi' => $request->info_isi,
        'tanggal' => $request->info_tanggal,
        'tempat' => $request->info_tempat,
        'alamat' => $request->info_alamat
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Ditambah.');
        //redirect
    }
    return redirect()->route('kegiatan-admin');
  }

  public function pengunduran()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Admin"], ['name' => "Pengunduran Diri Anggota"]];
        return view('layouts/admin/pengunduran', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function pengunduran_data()
  {
    $user=Pengundurans::select('pengundurans.*','users.name as nama','users.divisi as divisi')->join('users','users.card','=','pengundurans.id_card')->get();
    return ['data' => $user];
  }
  public function pengunduran_update(Request $request){
    $user = Pengundurans::updateOrCreate([
        'id' => $request->up_id
    ], [
        'status' => $request->status,

    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Diubah.');
        //redirect
    }
    return redirect()->route('pengunduran-admin');
  }

  public function anggota()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Admin"], ['name' => "Daftar Anggota"]];
        return view('layouts/admin/anggota', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }

  public function anggota_data()
  {
    $user=User::where('role','=','pengguna')->get();
    return ['data' => $user];
  }
  public function anggota_first(Request $request)
  {
    $user=User::select('users.*', User::raw("DATE_FORMAT(users.masuk, '%d/%m/%Y') as date_change"))->where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function anggota_delete(Request $request)
  {
    $post = User::find($request->id);
    if($post) {
        $post->delete();
    }
    //flash message
    session()->flash('success', 'Data Berhasil Dihapus.');
    //redirect
    return redirect()->route('anggota-admin');
  }
  public function anggota_update(Request $request){
    $user = User::updateOrCreate([
        'id' => $request->id
    ], [
        'divisi' => $request->info_divisi,
        'nama' => $request->info_nama,
        'card' => $request->info_card,
        'masuk' => $request->info_masuk,
        'email' => $request->info_email

    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Diubah.');
        //redirect
    }
    return redirect()->route('anggota-admin');
  }

  public function keluhan()
  {
    $pageConfigs = ['showMenu' => false,'mainLayoutType'=>'horizontal'];
    $breadcrumbs = [['link' => "#", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Admin"], ['name' => "Keluhan Anggota"]];
        return view('layouts/admin/keluhan', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function keluhan_data()
  {
    $user=Keluhans::select('keluhans.*','users.name as nama','users.divisi as divisi')->join('users','users.card','=','keluhans.id_card')->get();
    return ['data' => $user];
  }
  public function keluhan_update(Request $request){
    $user = Keluhans::updateOrCreate([
        'id' => $request->up_id
    ], [
        'tanggapan' => $request->tanggapan,
    ]);
    if($user){
        session()->flash('success', 'Data Berhasil Diubah.');
        //redirect
    }
    return redirect()->route('keluhan-admin');
  }

  public function redirect()
  {
    $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->intended('admin');
            case 'pengguna':
                return redirect()->intended('user');
            default:
                return redirect('/');
        }
  }

  public function home(){
    return view('auth.login');
  }
}
