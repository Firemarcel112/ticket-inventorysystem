<?php

namespace App\Http\Controllers;


use App\Models\Asset;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{



    public function index(Request $request)
    {
        $pageTitle = "QR-Codes Drucken";
        $ids = $request->old('id');
        if($ids == null) {
            $ids = session('qrCode');
            goto runScript;
        }
        session()->put([
            'qrCode' => [
                ...$ids
            ],
        ]);
        runScript:
        $assets = [];
        if(empty($ids) || !session()->get('qrCode')) return redirect()->route('inventory.assets.dashboard')->with('error', ConfigController::QRCODEERROR);
        foreach($ids as $id) {
            $assets[] = Asset::find($id);
        }
        return view("qrcode", compact('assets', "pageTitle"));
    }

    public function post(Request $request) {
        if(!empty($request->post())) {
            return redirect()->to(route('qrcode'))->withInput();
        }
    }
}
