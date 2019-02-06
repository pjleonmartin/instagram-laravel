<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function like($image_id) {
        // Recoger datos del usuario e imagen
        $user = \Auth::user();
        
        // Condición para ver si ya existe el like y no duplicarlo
        $isset_like = Like::where('user_id', $user->id)
                ->where('image_id', $image_id)
                ->count();
        if($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
        
            // Guardar
            $like->save();
            
            return response()->json([
                'like' => $like
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'Ya le has dado me gusta a esta foto'
            ]);
        }
    }
    
    public function dislike($image_id) {
        // Recoger datos del usuario e imagen
        $user = \Auth::user();
        
        // Condición para ver si ya existe el like y no duplicarlo
        $like = Like::where('user_id', $user->id)
                ->where('image_id', $image_id)
                ->first();
        
        if($like) {
        
            // Eliminar el megusta
            $like->delete();
            
            return response()->json([
                'like' => $like,
                'message' => 'Has quitado tu me gusta de esta foto correctamente'
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'No le has dado me gusta a esta foto para quitárselo'
            ]);
        }
    }
}
