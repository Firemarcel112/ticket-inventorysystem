<?php

namespace App\Http\Controllers;

use App\Models\GroupRightsModel;
use App\Models\Log;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    protected Log $log;
    protected GroupRightsModel $groupRightsModel;

    public function __construct(Log $log, GroupRightsModel $groupRightsModel) {
        $this->log = $log;
        $this->groupRightsModel = $groupRightsModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->groupRightsModel->checkIfAllRightsController()) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Logs | Sabine-Blindow-Schulen";

        $logs = Log::orderBy('created_at', 'DESC')->paginate(15);

        return view('logs', compact('pageTitle', 'logs'));
    }

}
