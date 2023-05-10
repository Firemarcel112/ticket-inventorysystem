<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqImage;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;
use Exception;

class FaqAdminController extends Controller
{
    protected ImageController $imageController;
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

        $pageTitle = "FAQ Verwaltung";
        $contents = Faq::all();
        $categories = FaqCategory::all();

        if ($request->search) {
            $search = Faq::where('title', 'LIKE', '%' . $request->search . '%')->get();
            if (empty($search[0])) {
                return redirect()->route("admin.faqmanagement")->with("info", "Es konnte kein FAQ-Einträge unter \"" . $request->search . "\" gefunden werden!");
            } else {
                $contents = $search;
            }
        }
        return view("admin.faq.dashboard", compact("contents", "categories", "pageTitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = 'Neuen FAQ Eintrag erstellen';
        $categories = FaqCategory::all();

        return view('admin.faq.create', compact('categories', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if (!empty($request->file('images'))) {
            $images = $request->file('images');
        }
        if (empty($request->visiblefrontpage)) {
            $visible = false;
        } else {
            $visible = true;
        }
        $imageDescriptions = $request->imageDescription;
        if (Faq::where('title', $request->title)->exists()) {
            return redirect()->back()->with('error', ConfigController::TITLEALREADYEXIST);

        } else {
            if (!empty($images)) {
                $i = 0;
                foreach ($images as $validateImage) {
                    try {
                        $this->imageController->validateImage($validateImage, ConfigController::IMAGEPATHFAQ, ConfigController::IMAGESIZEFAQ, $i);
                    } catch (Exception $e) {
                        return redirect()->back()->with('error', $e->getMessage());
                    }
                }
                foreach ($images as $image) {
                    try {
                        $fileName[] = $this->imageController->create($image, ConfigController::IMAGEPATHFAQ, ConfigController::IMAGESIZEFAQ, $i);
                    } catch (Exception $e) {
                        return redirect()->back()->with('error', $e->getMessage());
                    }
                    $i++;
                }
            }
            Faq::create([
                'title' => $request->title,
                'shortcontent' => $request->shortcontent,
                'longcontent' => $request->longcontent,
                'faq_category_id' => $request->faq_category_id,
                'visiblefrontpage' => $visible
            ]);
            event(new LogActionEvent(ConfigController::LOGSCREATE, 'faqs', $request->title));
            $foreignID = Faq::where('title', $request->title)->first()->id;
            $i = 0;
            if (!empty($images)) {
                foreach ($images as $ignored) {
                    FaqImage::create([
                        'imagepath' => $fileName[$i],
                        'imagedescription' => $imageDescriptions[$i],
                        'faq_id' => $foreignID,
                    ]);
                    event(new LogActionEvent(ConfigController::LOGSCREATE, 'faq_images', $fileName[$i]));
                    $i++;
                }
            }

            return redirect()->route('admin.faqmanagement')->with('success', ConfigController::FAQCREATEDSUCCESS);
        }


    }



    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function edit($id)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $content = Faq::find($id);
        if (!$content) {
            return redirect()->route('admin.faqmanagement')->with('error', ConfigController::ARTICLEDOESNTEXIST);
        }

        $pageTitle = "{$content->title} bearbeiten";
        $categories = FaqCategory::all();
        $images = FaqImage::where('faq_id', $id)->get();

        return view("admin.faq.edit", compact("content", "categories", "pageTitle", "images"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws Exception
     */
    public function update(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $oldTitle = Faq::find($id)->title;

        if (empty($request->visiblefrontpage)) {
            $visible = false;
        } else {
            $visible = true;
        }
        $imageDescription = $request->post('imageDescription');
        if (!empty($request->post('deleteImage'))) {
            $deleteImage = $request->post('deleteImage');
        }
        if (!empty($request->file()['images'])) {
            $uploadImage = $request->file()['images'];
        }
        if (Faq::where('title', $request->title)->first() && $oldTitle != $request->title) return redirect()->back()->with("error", ConfigController::TITLEALREADYEXIST);

        if (!empty($uploadImage)) {
            $keyIndex = key($uploadImage) - 1;
            $fileName[$keyIndex] = "";
            $i = 0;
            foreach ($uploadImage as $validateImage) {
                try {
                    $this->imageController->validateImage($validateImage, 'images/faq', 1, $i);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
            foreach ($uploadImage as $create) {
                try {
                    $fileName[] = $this->imageController->create($create, 'images/faq', 1, $i);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
                $i++;
            }
        }
        $faq = Faq::find($id);
        $faq->title = $request->title;
        $faq->shortcontent = $request->shortcontent;
        $faq->longcontent = $request->longcontent;
        $faq->faq_category_id = $request->faq_category_id;
        $faq->visiblefrontpage = $visible;
        $faq->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'faqs', $request->title));

        if (!empty($uploadImage) || !empty($imageDescription)) {
            $countOldImage = 0;
            $lastImageIndex = 0;
            if(FaqImage::where('faq_id', $id)->exists()) {
                $oldImages = FaqImage::where('faq_id', $id)->get();
                $countOldImage = count($oldImages);
            }


            //Alte Bilder werden aktualisiert
            if ($countOldImage > 0) {
                for ($i = 0; $i < $countOldImage; $i++) {
                    if (!empty($fileName[$i])) {
                        $oldImageID = $oldImages[$i]['id'];
                        $faqimage = FaqImage::find($oldImageID);
                        $faqimage->imagepath = $fileName[$i];
                        $faqimage->imagedescription = $imageDescription[$i];
                        $faqimage->save();
                    }
                    if (!empty($imageDescription[$i])) {
                        $oldImageID = $oldImages[$i]['id'];
                        $faqimage = FaqImage::find($oldImageID);
                        $faqimage->imageDescription = $imageDescription[$i];
                        $faqimage->save();
                    }
                    $lastImageIndex = $i + 1;
                }
            }
            if (!empty($lastImageIndex) || $lastImageIndex == 0) {
                if (isset($uploadImage[$lastImageIndex])) {
                    $countUploadedImages = array_key_last($uploadImage);
                    for ($lastImageIndex; $lastImageIndex <= $countUploadedImages; $lastImageIndex++)
                        FaqImage::create([
                            'imagepath' => $fileName[$lastImageIndex],
                            'imagedescription' => $imageDescription[$lastImageIndex],
                            'faq_id' => $id,
                        ]);

                    }
                }
        }

        if (!empty($deleteImage)) {
            foreach ($deleteImage as $delete) {
                FaqImage::where('imagepath', $delete)->delete();
                $this->imageController->delete($delete);
            }
        }
        return redirect()->route('admin.faqmanagement')->with('success', ConfigController::FAQEDITSUCCES);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $id)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['managefaq'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $faq = $id;

        $faqImages = FaqImage::where('faq_id', $faq->id)->get();
        foreach($faqImages as $faqImage) {
            FaqImage::destroy($faqImage->id);
            unlink($faqImage->imagepath);
        }
        $faq->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'faqs', $faq->title));
        return redirect()->route('admin.faqmanagement')->with("success", ConfigController::FAQDELETESUCCESS);


    }
}
