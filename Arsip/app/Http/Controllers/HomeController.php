<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function index2()
    {
        return view('index2');
    }

    public function index3()
    {
        return view('index3');
    }

    // Widget
    public function widgets()
    {
        return view('pages.widgets');
    }

    // Layout
    public function topNav()
    {
        return view('pages.layout.top-nav');
    }

    public function boxed()
    {
        return view('pages.layout.boxed');
    }

    public function fixed()
    {
        return view('pages.layout.fixed');
    }

    public function fixedTopnav()
    {
        return view('pages.layout.fixed-topnav');
    }

    public function fixedFooter()
    {
        return view('pages.layout.fixed-footer');
    }

    public function collapsedSidebar()
    {
        return view('pages.layout.collapsed-sidebar');
    }

    // Charts
    public function chartjs()
    {
        return view('pages.charts.chartjs');
    }

    public function flot()
    {
        return view('pages.charts.flot');
    }

    public function inline()
    {
        return view('pages.charts.inline');
    }

    // UI
    public function uiGeneral()
    {
        return view('pages.ui.general');
    } 

    public function icons()
    {
        return view('pages.ui.icons');
    } 

    public function buttons()
    {
        return view('pages.ui.buttons');
    } 

    public function sliders()
    {
        return view('pages.ui.sliders');
    } 

    public function modals()
    {
        return view('pages.ui.modals');
    } 

    // Forms
    public function formsGeneral()
    {
        return view('pages.forms.general');
    }   

    public function advanced()
    {
        return view('pages.forms.advanced');
    }   

    public function editors()
    {
        return view('pages.forms.editors');
    }   

    // Tables
    public function simple()
    {
        return view('pages.tables.simple');
    }   

    public function data()
    {
        return view('pages.tables.data');
    }   

    // Calendar
    public function calendar()
    {
        return view('pages.calendar');
    }

    // Mailbox
    public function mailbox()
    {
        return view('pages.mailbox.mailbox');
    } 

    public function compose()
    {
        return view('pages.mailbox.compose');
    } 

    public function readMail()
    {
        return view('pages.mailbox.read-mail');
    } 

    // Examples Pages
    public function invoice()
    {
        return view('pages.examples.invoice');
    }
    public function invoicePrint()
    {
        return view('pages.examples.invoice-print');
    }
    public function profile()
    {
        return view('pages.examples.profile');
    }
    public function login()
    {
        return view('pages.examples.login');
    }
    public function register()
    {
        return view('pages.examples.register');
    }
    public function lockscreen()
    {
        return view('pages.examples.lockscreen');
    }

    // Examples Extra
    public function page404()
    {
        return view('pages.examples.404');
    }

    public function page500()
    {
        return view('pages.examples.500');
    }

    public function blank()
    {
        return view('pages.examples.blank');
    }

    public function legacyUserMenu()
    {
        return view('pages.examples.legacy-user-menu');
    }

    public function starter()
    {
        return view('pages.examples.starter');
    }

}
