<?php
class HomeController extends Controller
{
    /**
     * Show the landing page.
     * URL: / or /home/index
     */
    public function index()
    {
        // You can pass data as an array: $this->view('home/index', ['variable' => $value]);
        $this->view('home/index');
    }

    /**
     * Show the about page.
     * URL: /home/about
     */
    public function about()
    {
        $this->view('home/about');
    }

    /**
     * Show the contact page.
     * URL: /home/contact
     */
    public function contact()
    {
        $this->view('home/contact');
    }

    /**
     * Example: Show FAQ page.
     * URL: /home/faq
     */
    public function faq()
    {
        $this->view('home/faq');
    }
}
