<?php

/**
 *
 */
class adminController extends Controller
{

  public function index()
  {
$this->model('News');
    $this->view('admin'.DIRECTORY_SEPARATOR.'index',['news'=>$this->model->all()]);

    $this->view->pageTitle='admin index';
    $this->view->render();

  }

  public function index2()
  {
$this->model('News');
    $this->view('admin'.DIRECTORY_SEPARATOR.'index',['news'=>$this->model->all()]);

    $this->view->pageTitle='admin index';
    $this->view->render();

  }






}





















 ?>
