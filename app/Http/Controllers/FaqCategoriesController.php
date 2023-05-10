<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;
use Exception;

class FaqCategoriesController extends Controller
{


    public ImageController $imageController;
    protected GroupRightsModel $groupRightsModel;

    public function __construct(ImageController $imageController, GroupRightsModel $groupRightsModel)
    {
        $this->imageController = $imageController;
        $this->groupRightsModel = $groupRightsModel;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = "FAQ Kategorie Verwaltung";
        $categories = FaqCategory::all();

        if ($request->search) {
            $search = FaqCategory::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if (empty($search[0])) {
                return redirect()->route('admin.faqcategories')->with("info", "Es konnte keine FAQ-Kategorien unter \"" . $request->get('search') . "\" gefunden werden!");
            } else {
                $categories = $search;
            }
        }

        return view("admin.faqcategories.dashboard", compact('categories', 'pageTitle'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neue FAQ Kategorie erstellen";

        return view("admin.faqcategories.create", compact("pageTitle"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        try {
            $image = $this->imageController->create($request->file('imagepath'), ConfigController::IMAGEPATHFAQ, ConfigController::IMAGESIZEPARTNERS);
        } catch (Exception $e) {
            return redirect()->route('admin.faqcategories.create')->with('error', $e->getMessage());
        }

        if (FaqCategory::where('name', $request->name)->exists()) return redirect()->back()->with("error", ConfigController::CATEGORYALREADYEXIST);

        FaqCategory::create([
            'name' => $request->name,
            'imagepath' => $image
        ]);

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'faq_categories', $request->name));
        return redirect()->route('admin.faqcategories')->with('success', ConfigController::FAQCREATEDSUCCESS);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $category = FaqCategory::find($id);
        if (!$category) {
            return redirect()->route('admin.faqcategories')->with('error', ConfigController::CATEGORYDOESNTEXIST);
        } else {
            $pageTitle = "{$category->name} bearbeiten";
        }

        return view('admin.faqcategories.edit', compact('category', 'pageTitle'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $oldName = FaqCategory::find($id)->name;
        $name = $request->name;
        if (FaqCategory::where('name', $name)->first() && $oldName != $name) return redirect()->back()->with("error", ConfigController::CATEGORYALREADYEXIST);
        if ($request->file('imagepath')) {
            try {
                $fileName = $this->imageController->create($request->file('imagepath'), ConfigController::IMAGEPATHFAQ, ConfigController::IMAGESIZEFAQ);
                $deleteName = FaqCategory::find($id)->imagepath;
                $this->imageController->delete($deleteName);
            } catch (Exception $e) {
                return redirect()->route('admin.faqcategories.edit')->with('error', $e->getMessage());
            }
        } else {
            $fileName = FaqCategory::find($id)->imagepath;
        }

        $faqCategory = FaqCategory::find($id);
        $faqCategory->name = $name;
        $faqCategory->imagepath = $fileName;
        $faqCategory->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'faq_categories', $oldName, $name));
        return redirect()->route('admin.faqcategories')->with('success', "Der FAQ-Eintrag {$name} wurde bearbeitet!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $faqcategory = FaqCategory::findOrFail($id);

        if (Faq::where('faq_category_id', $id)->exists()) {
            return redirect()->route('admin.faqcategories')->with('error', ConfigController::FAQCATEGORYDELETEERROR);
        }

        FaqCategory::destroy($id);
        $this->imageController->delete($faqcategory->imagepath);

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'faq_categories', $faqcategory->name));
        return redirect()->route('admin.faqcategories')->with("success", ConfigController::FAQCATEGORYDELETESUCCESS);
    }
}
