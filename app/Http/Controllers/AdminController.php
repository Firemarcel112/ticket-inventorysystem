<?php

    namespace App\Http\Controllers;

    use App\Models\GroupRightsModel;
    use App\Models\Log;
    use Illuminate\Http\Request;

    class AdminController extends Controller {
        protected GroupRightsModel $groupRightsModel;

        public function __construct( GroupRightsModel $groupRightsModel) {
            $this->groupRightsModel = $groupRightsModel;
        }

        /**
         * @return \Illuminate\Http\RedirectResponse
         */
        public function index() {
            if (!$this->groupRightsModel->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
            $pageTitle = "Admin Dashboard";
            $ticketLogs = Log::where('tablename', 'tickets')->get();
            $inventoryLogs = Log::where('tablename', 'assets')->orWhere('tablename', 'assetmodel')->orWhere('tablename', 'license')->get();

            return view('admin.dashboard', compact('pageTitle', 'ticketLogs', 'inventoryLogs'));
        }


    }
