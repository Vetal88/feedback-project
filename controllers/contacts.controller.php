<?php

class ContactsController extends Controller
{

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Message();
    }

    public function index()
    {
        if ($_POST) {
            $model = new Message();
            if ($model->save($_POST)) {
                Session::setFlash('Спасибо! Ваше отзыв удет добавлен после проверки модератора');
            } else {
                Session::setFlash('Ваше отзыв не добавлен.Заполните форму,пожалуйста');
            }
        }

        $this->data['messages'] = $this->model->getList(true);

    }


    public function admin_index()
    {
        $model = new Message();
        $this->data = $model->getList();
    }

    public function admin_edit()
    {

        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id);
            if ($result) {
                Session::setFlash('contacts was saved');
            } else {
                Session::setFlash('Error');
            }
            Router::redirect('/admin/contacts/');
        }

        if (isset($this->params[0])) {
            $this->data['message'] = $this->model->getById($this->params[0]);
        } else {
            Session::setFlash('Wrong contacts id.');
            Router::redirect('/admin/contacts/');
        }
    }

    public function admin_add()
    {
        if ($_POST) {
            $result = $this->model->save($_POST);
            if ($result) {
                Session::setFlash('Message was saved');
            } else {
                Session::setFlash('Error');
            }
            Router::redirect('/admin/contacts/');
        }
    }

    public function admin_delete()
    {
        if (isset($this->params[0])) {
            $result = $this->model->delete($this->params[0]);
            if ($result) {
                Session::setFlash('Message was deleted');
            } else {
                Session::setFlash('Error');
            }
        }
        Router::redirect('/admin/contacts/');
    }

}