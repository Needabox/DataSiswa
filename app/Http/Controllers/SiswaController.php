<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Uniqid;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('cari')){
            $siswa = Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')
                            ->orwhere('nama_belakang','LIKE','%'.$request->cari.'%')->get();
        }else{
            $siswa = Siswa::all();
        }
        return view('siswa.index', ['siswa' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'nama_depan' => 'required|min:5',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes:jpg,png',
        ]);
        //Insert Ke table User
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan." ".$request->nama_belakang;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia123');
        $user->remember_token = Str::random(60);
        $user->save();
        
        //Insert Ke table Siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = Siswa::create($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        
        return redirect()
                ->route('siswa')
                ->with('message', __('messages.create'));
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
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa, $id)
    {
        $siswa = Siswa::find($id);

        return view('siswa.edit', ['siswa' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa, $id)
    {
        //dd($request->all());
        $siswa = Siswa::find($id);
        $siswa->update($request->all());
            
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        
        return redirect()
            ->route('siswa')
            ->with('message', __('messages.update'));
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect()
                ->route('siswa')
                ->with('message', __('messages.destroy'));
    }

    public function profile($id)
    {
        $siswa = Siswa::find($id);
        $matapelajaran = Mapel::all();
        //dd($matapelajaran);
        return view('siswa.profile', ['siswa' => $siswa , 'matapelajaran' => $matapelajaran]);
    }

    public function tambahnilai(Request $request, $id){
        $siswa = Siswa::find($id);
        $idsiswa = Siswa::find($id);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect()
                    ->route('siswa.profile', ['id' => $siswa->id])
                    ->with('message', __('messages.fail'));
        }

        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect()
                ->route('siswa.profile', ['id' => $siswa->id])
                ->with('message', __('messages.update'));
    }
}	