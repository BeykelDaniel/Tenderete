<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Actividades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        // Solo administradores pueden usar este controlador
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return redirect('/')->with('error', 'Acceso denegado. Se requiere nivel de administrador.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $usuarios = User::withCount('actividades', 'posts')->get();
        $media = DB::table('media')
            ->join('users', 'media.user_id', '=', 'users.id')
            ->join('actividades', 'media.actividad_id', '=', 'actividades.id')
            ->select('media.*', 'users.name as autor', 'users.email as email', 'actividades.titulo as actividad')
            ->orderBy('media.created_at', 'desc')
            ->get();
        
        // Verificar cuáles existen
        foreach($media as $m) {
            $pathReal = str_replace('storage/', '', $m->url);
            $m->existe = Storage::disk('public')->exists($pathReal);
        }

        return view('admin.dashboard', compact('usuarios', 'media'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevenir auto-borrado
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'No puedes borrar tu propio usuario.');
        }

        // --- BORRADO EN CASCADA MANUAL Y SEGURO (RGPD) ---

        // 1. Borrar fotos físicas del disco y BD
        $medias = DB::table('media')->where('user_id', $user->id)->get();
        foreach ($medias as $media) {
            $pathReal = str_replace('storage/', '', $media->url);
            if (Storage::disk('public')->exists($pathReal)) {
                Storage::disk('public')->delete($pathReal);
            }
        }
        DB::table('media')->where('user_id', $user->id)->delete();

        // 2. Borrar de tablas pivote (amigos, actividad_user)
        DB::table('amigos')->where('user_id', $user->id)->orWhere('amigo_id', $user->id)->delete();
        DB::table('actividad_user')->where('user_id', $user->id)->delete();
        
        // 3. Borrar mensajes privados del usuario
        DB::table('mensajes_privados')->where('emisor_id', $user->id)->orWhere('receptor_id', $user->id)->delete();

        // 4. Actividades creadas por el usuario (y sus archivos si se quiere)
        $actividades = Actividades::where('user_id', $user->id)->get();
        foreach ($actividades as $act) {
            // Borramos también los archivos de estas actividades aunque sean de otros
            $actMedias = DB::table('media')->where('actividad_id', $act->id)->get();
            foreach ($actMedias as $m) {
                $p = str_replace('storage/', '', $m->url);
                if (Storage::disk('public')->exists($p)) { Storage::disk('public')->delete($p); }
            }
            DB::table('media')->where('actividad_id', $act->id)->delete();
            $act->delete(); // Elimina la actividad
        }

        // 5. Eliminar usuario
        $user->delete();

        return redirect()->back()->with('success', 'Usuario, archivos y actividades asociadas eliminados correctamente.');
    }

    public function deleteMedia($id)
    {
        $archivo = DB::table('media')->where('id', $id)->first();
        if ($archivo) {
            $pathReal = str_replace('storage/', '', $archivo->url);
            if (Storage::disk('public')->exists($pathReal)) {
                Storage::disk('public')->delete($pathReal);
            }
            DB::table('media')->where('id', $id)->delete();
        }
        
        return redirect()->back()->with('success', 'Archivo multimedia borrado del servidor.');
    }
}
