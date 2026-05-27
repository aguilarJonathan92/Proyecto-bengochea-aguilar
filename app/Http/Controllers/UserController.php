<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        
        $user = Auth::user(); // Trae el usuario autenticado

        $provincias = Province::orderBy('name')->get(); // Traemos todas las provincias para el primer select

        return view('pages.user-panel', compact('user', 'provincias'));
    }

    public function update(Request $request){

        $user = User::find(Auth::id()); //trae desde la base de datos, los datos de usuario autenticado

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'nullable|min:8|confirmed',
            'phone'      => 'nullable|string|max:20',

            // Reglas para el array de direcciones
            'addresses'                 => 'nullable|array',
            'addresses.*.id'            => 'nullable|exists:user_addresses,id',
            'addresses.*.alias'         => 'required_with:addresses|string|max:50',
            'addresses.*.street'        => 'required_with:addresses|string|max:255',
            'addresses.*.postal_code'   => 'required_with:addresses|string|max:10',
            'addresses.*.city_id'       => 'required_with:addresses|exists:cities,id',
            'addresses.*.is_default'    => 'nullable',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            ['phone' => $request->phone]
        );

        // 3. Procesar Direcciones Dinámicas
        $inputAddresses = $request->input('addresses', []);
        $keepAddressIds = [];

        // Detectar si el usuario marcó alguna de las direcciones enviadas como predeterminada
        $hasNewDefault = false;
        foreach ($inputAddresses as $key => $addressData) {
            if (isset($addressData['is_default']) && $addressData['is_default'] == '1') {
                $hasNewDefault = true;
                break;
            }
        }

        // Si envió una nueva predeterminada, limpiamos todas las de la Base de Datos primero
        if ($hasNewDefault) {
            $user->addresses()->update(['is_default' => false]);
        }

        foreach ($inputAddresses as $addressData) {
            // Si ya establecimos que hay una nueva por defecto, cualquier otra de este bucle 
            // que NO tenga el '1' explícito, la forzamos a false.
            if ($hasNewDefault && (!isset($addressData['is_default']) || $addressData['is_default'] != '1')) {
                $addressData['is_default'] = false;
            } else {
                $addressData['is_default'] = isset($addressData['is_default']) && $addressData['is_default'] == '1';
            }

            if (!empty($addressData['id'])) {
                // Editar una direccion existente
                $address = $user->addresses()->find($addressData['id']);
                if ($address) {
                    $address->update($addressData);
                    $keepAddressIds[] = $address->id;
                }
            } else {
                // Creamos nueva direccion
                $newAddress = $user->addresses()->create($addressData);
                $keepAddressIds[] = $newAddress->id;
            }
        }

        // 4. Eliminar las direcciones que el usuario borró en la interfaz
        $user->addresses()->whereNotIn('id', $keepAddressIds)->delete();

        return redirect()->route('panel-usuario')->with('success', '¡Datos actualizados correctamente!');
    }

    // Actúa como una mini-API para el JavaScript. Para devolver las ciudades de la provincia seleccionada
    public function getCitiesByProvince(Province $province)
    {
        // Devuelve las ciudades de la provincia seleccionada en formato JSON
        return response()->json($province->cities()->orderBy('name')->get());
    }
}
