<?php

class Materials extends Controller
{
    public function __construct()
    {
        if (!auth()) return redirect(DEFAULT_NON_AUTH_ROUTE);
    }
    
    public function Index($section = null)
    {
        $page_title = [];
        $materials = [];
        
        $subject = (isset($_GET['subject'])) ? $_GET['subject'] : null;
        $search = (isset($_GET['search'])) ? $_GET['search'] : null;
        $section = (empty($section)) ? 0 : $section;

        $material_from = (!is_null($subject)) ? "subject" : ((!is_null($search)) ? "search" : "section");

        if (isset($_POST['add_material'])) {
            $section_id = $_POST['section'];
            $subject_id = $_POST['subject'];
            $title = $_POST['title'];
            $volume = $_POST['volume'];
            $about = $_POST['about'];

            $thumbnail_storage = storage_folder('thumbnails');
            $thumbnail_file_name = uniqid().'-'.basename($_FILES['thumbnail']['name']);
            $thumbnail_file_tmp = $_FILES['thumbnail']['tmp_name'];
            $thumbnail_save = $thumbnail_storage.$thumbnail_file_name;

            $material_storage = storage_folder('materials');
            $material_file_name = uniqid().'-'.basename($_FILES['material']['name']);
            $material_file_tmp = $_FILES['material']['tmp_name'];
            $material_save = $material_storage.$material_file_name;

            $MaterialModel = new MaterialModel;
            $save = $MaterialModel->create([
                'section_id' => $section_id,
                'subject_id' => $subject_id,
                'title' => $title,
                'volume' => $volume,
                'about' => $about,
                'thumbnail' => $thumbnail_file_name,
                'material' => $material_file_name,
            ]);
            
            if ($save) {
                move_uploaded_file($thumbnail_file_tmp, $thumbnail_save);
                move_uploaded_file($material_file_tmp, $material_save);

                Flash::set('success', 'Material created', 'Material successfully created');
            } else {
                Flash::set('warning', 'Failed to create material', 'Unknown error occurs');
            }
        }

        if ($material_from == "subject") {
            $SubjectModel = new SubjectModel;
            $page_title = $SubjectModel->where('id', $subject)->first()->name;

            $MaterialModel = new MaterialModel;
            $materials = $MaterialModel->where('subject_id', $subject)->get();
        }

        if ($material_from == "search") {
            $page_title = "Search";

            $MaterialModel = new MaterialModel;
            $materials = $MaterialModel->whereLike('title', "%$subject%")->get();
        }

        if ($material_from == "section") {
            $page_title = Section()[$section];

            $MaterialModel = new MaterialModel;
            $materials = $MaterialModel->where('section_id', $section)->get();
        }
        
        $SubjectModel = new SubjectModel;
        $subjects = $SubjectModel->get();

        $this->view('materials', [
            'page_title' => $page_title,
            'subject' => $subject,
            'section' => $section,
            'search' => $search,
            'subjects' => $subjects,
            'materials' => $materials,
        ]);
    }
}