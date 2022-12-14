<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\TodoModel;


class TodoController extends Controller
{

    public function index(){
        $todoModel = new TodoModel();
        $data['todos'] = $todoModel->orderBy('id', 'DESC')->findAll();
        return view('todo_view', $data);
    }

    public function create(){
        return view('add_todo');
    }
 
    public function store() {
        $todoModel = new todoModel();
        $data = [
            'title' => $this->request->getVar('title'),
            'description'  => $this->request->getVar('description'),
        ];
        $todoModel->insert($data);
        return $this->response->redirect(site_url('/todo-list'));
    }
// Get item by id 
    public function getTodo($id = null){
        $todoModel = new todoModel();
        $data['todo_obj'] = $todoModel->where('id', $id)->first();
        return view('edit_todo', $data);
    }
// Updating todo item
    public function update(){
        $todoModel = new todoModel();
        $id = $this->request->getVar('id');
        $data = [
            'title' => $this->request->getVar('title'),
            'description'  => $this->request->getVar('description'),
        ];
        $todoModel->update($id, $data);
        return $this->response->redirect(site_url('/todo-list'));
    }
//  Delete todo item
    public function delete($id = null){
        $todoModel = new todoModel();
        $data['todo'] = $todoModel->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/todo-list'));
    }    
}