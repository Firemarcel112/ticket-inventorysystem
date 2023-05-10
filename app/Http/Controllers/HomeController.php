<?php

namespace App\Http\Controllers;

use App\Models\ContactPartner;
use App\Models\FaqCategory;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        $pageTitle = "Sabine-Blindow Schule Hilfecenter";

        $faqcategories = FaqCategory::with(['faqs' => function($query) {
            $query->where('visiblefrontpage', 1);
        }])->get();

        $visibileContacts = ContactPartner::where('visiblefrontpage', 1)->get();
        return view("index", compact("pageTitle", 'faqcategories', 'visibileContacts'));
    }

}
