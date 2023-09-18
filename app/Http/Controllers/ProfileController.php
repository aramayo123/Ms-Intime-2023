<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Producto;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function UpdateAvatar(Request $request){
        $request->validate([
            'avatar' => ['required', 'mimes:jpeg,jpg,png'],
        ]);
        $filename = time().".".$request->avatar->extension();
        $request->avatar->move(public_path("img_profile"),$filename);

        $imagen_anterior = Auth::user()->avatar;
        if($imagen_anterior != null){
            unlink(public_path('img_profile/'.$imagen_anterior));
        }
        User::where('id',Auth::user()->id)->update(['avatar'=>$filename]);

        return redirect('/profile')->with('update_avatar', 'Avatar actualizado con exito!!');   
    }
    public function ShowCompras(){
        $tickets = Ticket::where('user_id',Auth::user()->id)->get();
        return view('profile.compras', [
            'tickets' => $tickets,
        ]);
    }
    public function ShowTicket($id_mercadopago){
        
        $ticket = Ticket::where('id_mercadopago',$id_mercadopago)->first();
        $productos = [];
        $cantidad_aux = $ticket->amount_productos;
        $Aux = "";
        $cantidades = [];
        for ($i = 0; $i < strlen($cantidad_aux); $i++) {
            if($cantidad_aux[$i] != ' '){
                $Aux .= $cantidad_aux[$i];
                if($i == strlen($cantidad_aux)-1){
                    array_push($cantidades, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($cantidades, $Aux);
                $Aux = "";
            }
        }

        $colores_aux = $ticket->colors_productos;
        $Aux = "";
        $colores = [];
        for ($i = 0; $i < strlen($colores_aux); $i++) {
            if($colores_aux[$i] != '|'){
                $Aux .= $colores_aux[$i];
                if($i == strlen($colores_aux)-1){
                    array_push($colores, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($colores, $Aux);
                $Aux = "";
            }
        }
        $talles_aux = $ticket->talles_productos;
        $Aux = "";
        $talles = [];
        for ($i = 0; $i < strlen($talles_aux); $i++) {
            if($talles_aux[$i] != '|'){
                $Aux .= $talles_aux[$i];
                if($i == strlen($talles_aux)-1){
                    array_push($talles, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($talles, $Aux);
                $Aux = "";
            }
        }

        $id_productosAux = $ticket->id_productos;
        $idAux = "";
        $totalProductos = 0;
        for ($i = 0; $i < strlen($id_productosAux); $i++) {
            if($id_productosAux[$i] != ' '){
                $idAux .= $id_productosAux[$i];
                if($i == strlen($id_productosAux)-1){
                    $prodaux = Producto::findOrFail($idAux);
                    $prodaux->cantidad = $cantidades[$totalProductos];
                    $prodaux->colors = $colores[$totalProductos];
                    $prodaux->talles = $talles[$totalProductos];
                    array_push($productos, $prodaux);
                    $idAux = "";
                }
            }else{
                $prodaux = Producto::findOrFail($idAux);
                $prodaux->cantidad = $cantidades[$totalProductos];
                $prodaux->colors = $colores[$totalProductos];
                $prodaux->talles = $talles[$totalProductos];
                array_push($productos, $prodaux);
                $totalProductos++;
                $idAux = "";
            }
        }
        
        return view('profile.ticket', [
            'ticket' => $ticket,
            'productos' => $productos,
        ]);
    }
}
