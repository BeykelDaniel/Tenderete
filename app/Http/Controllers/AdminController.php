<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        // Solo permitir a cabrerajosedaniel89@gmail.com
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->email !== 'cabrerajosedaniel89@gmail.com') {
                abort(403, 'Acceso denegado. Área exclusiva de administración.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $usuarios = User::orderBy('created_at', 'desc')->get();
        
        // Obtener todos los archivos multimedia con info de su usuario y actividad
        $multimedia = DB::table('media')
            ->leftJoin('users', 'media.user_id', '=', 'users.id')
            ->leftJoin('actividades', 'media.actividad_id', '=', 'actividades.id')
            ->select('media.*', 'users.name as userName', 'actividades.titulo as actividadTitulo')
            ->orderBy('media.created_at', 'desc')
            ->get();
            
        // Filtrar los que existan realmente en disco para la estadística
        $archivosValidos = $multimedia->filter(function($item) {
            return file_exists(public_path($item->url));
        });

        return view('admin.dashboard', compact('usuarios', 'multimedia', 'archivosValidos'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->email === 'cabrerajosedaniel89@gmail.com') {
            return redirect()->back()->with('error', 'No puedes eliminar al administrador principal.');
        }

        // El borrado en cascada real (archivos) se hará en el evento deleting() del modelo User.
        $user->delete();

        return redirect()->back()->with('success', 'Usuario eliminado con éxito (y sus datos en cascada borrados según RGPD).');
    }

    public function destroyMedia($id)
    {
        $archivo = DB::table('media')->where('id', $id)->first();

        if ($archivo) {
            $pathReal = str_replace('storage/', '', $archivo->url);
            if (Storage::disk('public')->exists($pathReal)) {
                Storage::disk('public')->delete($pathReal);
            }
            DB::table('media')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Archivo multimedia borrado del disco duro.');
        }

        return redirect()->back()->with('error', 'El archivo no existe.');
    }
}
