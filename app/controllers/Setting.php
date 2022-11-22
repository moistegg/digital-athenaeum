<?php

class Setting extends Controller
{
    public function __construct()
    {
        if (!auth() or auth()->role != 1) return redirect(DEFAULT_NON_AUTH_ROUTE);
    }
    
    public function Index()
    {
        if (isset($_POST['add_subject'])) {
            $subject_group = $_POST['subject_group'];
            $subject_name = $_POST['subject_name'];

            $SubjectModel = new SubjectModel;
            $SubjectModel->create([
                'subject_group_id' => $subject_group,
                'name' => $subject_name,
            ]);

            Flash::set('success', 'Subject Added', 'Subject has been added');
        }

        if (isset($_POST['update_subject'])) {
            $id = $_POST['id'];
            $subject_group = $_POST['subject_group'];
            $subject_name = $_POST['subject_name'];

            $SubjectModel = new SubjectModel;
            $SubjectModel->where('id', $id)->update([
                'subject_group_id' => $subject_group,
                'name' => $subject_name,
            ])->save();

            Flash::set('success', 'Subject Updated', 'Subject has been updated');
        }

        if (isset($_POST['destroy_subject'])) {
            $id = $_POST['id'];

            $SubjectModel = new SubjectModel;
            $SubjectModel->where('id', $id)->delete();

            Flash::set('information', 'Subject Deleted', 'Subject has been deleted');
        }
        
        $SubjectModel = new SubjectModel;
        $subjects = $SubjectModel->get();
        
        $this->view('setting', [
            'subjects' => $subjects,
        ]);
    }
}