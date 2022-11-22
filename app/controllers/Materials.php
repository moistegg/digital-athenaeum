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
        $view = (isset($_GET['view'])) ? $_GET['view'] : null;
        $section = (empty($section)) ? 0 : $section;

        $material_from = (!is_null($subject)) ? "subject" : ((!is_null($search)) ? "search" : ((!is_null($view)) ? "view" : "section"));

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

        if (isset($_POST['update_material_info'])) {
            $id = $_POST['id'];
            $this_section = $_POST['section'];
            $this_subject = $_POST['subject'];
            $this_title = $_POST['title'];
            $this_volume = $_POST['volume'];
            $this_about = $_POST['about'];

            $MaterialModel = new MaterialModel;
            $MaterialModel->where('id', $id)->update([
                'section_id' => $this_section,
                'subject_id' => $this_subject,
                'title' => $this_title,
                'volume' => $this_volume,
                'about' => $this_about,
            ])->save();

            Flash::set('success', 'Material updated', 'Material successfully updated');
        }

        if (isset($_POST['update_material_thumbnail'])) {
            $id = $_POST['id'];
            
            $this_thumbnail_storage = storage_folder('thumbnails');
            $this_thumbnail_file_name = uniqid().'-'.basename($_FILES['thumbnail']['name']);
            $this_thumbnail_file_tmp = $_FILES['thumbnail']['tmp_name'];
            $this_thumbnail_save = $this_thumbnail_storage.$this_thumbnail_file_name;

            $MaterialModel = new MaterialModel;
            $existing_material = $MaterialModel->where('id', $id)->first();
            $existing_material_thumbnail = $existing_material->thumbnail;

            unlink($this_thumbnail_storage.$existing_material_thumbnail);

            $MaterialModel->where('id', $id)->update([
                'thumbnail' => $this_thumbnail_file_name,
            ])->save();
            
            move_uploaded_file($this_thumbnail_file_tmp, $this_thumbnail_save);

            Flash::set('success', 'Material updated', 'Material thumbnail successfully updated');
        }

        if (isset($_POST['update_material_file'])) {
            $id = $_POST['id'];

            $this_material_storage = storage_folder('materials');
            $this_material_file_name = uniqid().'-'.basename($_FILES['material']['name']);
            $this_material_file_tmp = $_FILES['material']['tmp_name'];
            $this_material_save = $this_material_storage.$this_material_file_name;

            $MaterialModel = new MaterialModel;
            $existing_material = $MaterialModel->where('id', $id)->first();
            $existing_material_material = $existing_material->material;

            unlink($this_material_storage.$existing_material_material);

            $MaterialModel->where('id', $id)->update([
                'material' => $this_material_file_name,
            ])->save();
            
            move_uploaded_file($this_material_file_tmp, $this_material_save);

            Flash::set('success', 'Material updated', 'Material successfully updated');
        }

        if (isset($_POST['destroy_material'])) {
            $id = $_POST['id'];

            $this_material_storage = storage_folder('materials');
            $this_thumbnails_storage = storage_folder('thumbnails');

            $MaterialModel = new MaterialModel;
            $existing_material = $MaterialModel->where('id', $id)->first();
            $existing_material_material = $existing_material->material;
            $existing_material_thumbnail = $existing_material->thumbnail;

            unlink($this_material_storage.$existing_material_material);
            unlink($this_thumbnails_storage.$existing_material_thumbnail);

            $MaterialModel->where('id', $id)->delete();

            Flash::set('information', 'Material deleted', 'Material successfully deleted');
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
            $materials = $MaterialModel->whereLike('title', "%$search%")->get();
        }

        if ($material_from == "section") {
            $page_title = Section()[$section];

            $MaterialModel = new MaterialModel;
            $materials = $MaterialModel->where('section_id', $section)->get();
        }

        if ($material_from == "view") {
            $MaterialModel = new MaterialModel;
            $materials = $MaterialModel->where('id', $view)->first();
            $page_title = $materials->title;
        }
        
        $SubjectModel = new SubjectModel;
        $subjects = $SubjectModel->get();
        
        if ($material_from == "view") {
            $this->view('views', [
                'page_title' => $page_title,
                'materials' => $materials,
            ]);
        } else {
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
}