<?php

class Home extends Controller
{
    public function __construct()
    {
        if (!auth()) return redirect(DEFAULT_NON_AUTH_ROUTE);
    }
    
    public function Index()
    {
        $SubjectModel = new SubjectModel;
        $subjects = $SubjectModel->get();
        $this->view('home', [
            'subjects' => $subjects,
        ]);
    }
}