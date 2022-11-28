<?php

class Home extends Controller
{
    public function __construct()
    {
        
    }
    
    public function Index()
    {
        if (!auth()) return redirect(DEFAULT_NON_AUTH_ROUTE);

        $SubjectModel = new SubjectModel;
        $subjects = $SubjectModel->get();

        $this->view('home', [
            'subjects' => $subjects,
        ]);
    }
}