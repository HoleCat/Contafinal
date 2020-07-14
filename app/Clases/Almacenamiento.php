<?php

namespace App\Clases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Almacenamiento extends Model
{
    static function guardartemporalmente($username,$file) {
        $user = Auth::user();
        $useremail = Auth::user()->email;
        $path = public_path('storage\\All\\'.$user->email.'\\temporal\\');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        else {
            File::deleteDirectory($path);
            File::makeDirectory($path, 0777, true, true);
        }
        $filenamewithext = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$ext;
        $ruta = $file->move('storage/All/'.$useremail.'/'.'temporal/', $filenametostore);
        return $ruta;
    }

    static function guardaractivos($username,$file) {
        $filenamewithext = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$ext;
        $ruta = $file->move('storage/activos/'.$username.'/'.time().'_'.$filenametostore.'/archivo/', $filenametostore);
        return $ruta;
    }

    static function guardar($file) {
        $filenamewithext = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$ext;
        $ruta = $file->move('storage/', $filenametostore);
        $ruta = asset($ruta);
        return $ruta;
    }
}
