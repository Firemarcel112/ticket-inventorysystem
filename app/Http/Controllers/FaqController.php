<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqImage;
use App\Models\GroupRightsModel;


class FaqController extends Controller
{
    protected GroupRightsModel $groupRightsModel;
    protected ImageController $imageController;

    public function __construct(GroupRightsModel $groupRightsModel, ImageController $imageController) {
        $this->groupRightsModel = $groupRightsModel;
        $this->imageController = $imageController;
    }


    public function index() {
        $pageTitle = "Häufig gestellte Fragen";
        $categories = FaqCategory::all();
        $contents = Faq::all();

        return view("faq.dashboard", compact("categories", "contents", "pageTitle"));
    }

    public function show(Faq $title) {
        $faq = $title;
        $pageTitle = "{$faq->title}";
        $category = FaqCategory::find($faq->faq_category_id);
        $images = FaqImage::where('faq_id', $title->id)->get();
        return view('faq.article', compact('faq', 'category', 'images', 'pageTitle'));
    }

}
