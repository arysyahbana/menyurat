<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Province;
use App\Models\UrbanVillage;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth()->user();
        $provinces = Province::all();

        return view("profile.profile", ["user" => $user, "provinces" => $provinces]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateUserRequest $request)
    // {
    //     $validated = $request->validated();
    //     $user = auth()->user();

    //     // delete previous logo
    //     if($user->logo_url !== null) {
    //         Storage::disk("public")->delete($user->logo_url);
    //     }

    //     // save image in folder
    //     $imagePath = Storage::disk("public")->put(config("central.paths.company_logo"), $validated["logo"]);
    //     unset($validated["logo"]);

    //     // get postal code
    //     $urbanVillage = UrbanVillage::where("id", $validated["urban_village_id"])
    //                     ->first();


    //     // add other value
    //     $validated["logo_url"] = $imagePath;
    //     $validated["completed"] = true;
    //     $validated["postal_code"] = $urbanVillage->postal_code;

    //     User::where("id", $user->id)
    //         ->update($validated);

    //     return back()->with("success", "Profil pengguna berhasil diperbarui");
    // }

    public function update(UpdateUserRequest $request)
    {
        $validated = $request->validated();
        $user = auth()->user();

        // delete previous logo
        if ($user->logo_url !== null) {
            Storage::disk("public")->delete($user->logo_url);
        }

        // Proses logo dari base64
        if (isset($validated["logo"]) && strpos($validated["logo"], 'data:image') === 0) {
            // Decode base64
            $image_parts = explode(";base64,", $validated["logo"]);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Buat nama file
            $filename = uniqid() . '.' . $image_type;
            $filepath = config("central.paths.company_logo") . '/' . $filename;

            // Simpan file
            Storage::disk("public")->put($filepath, $image_base64);

            // Set path untuk disimpan di database
            $validated["logo_url"] = $filepath;
        }

        unset($validated["logo"]);

        // get postal code
        $urbanVillage = UrbanVillage::where("id", $validated["urban_village_id"])
            ->first();

        // add other value
        $validated["completed"] = true;
        $validated["postal_code"] = $urbanVillage->postal_code;

        User::where("id", $user->id)
            ->update($validated);

        return back()->with("success", "Profil pengguna berhasil diperbarui");
    }
}
