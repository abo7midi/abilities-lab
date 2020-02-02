<?php
/**
 *
 */
class Controller
{

  protected $view;
  protected $model;
  public function view($viewName,$data=[])
  {
    if (!isset($this->view)) {
      $this->view=new View($viewName,$data);
      return $this->view;}
  }

  public function model($modelName,$data=[])
  {
    if (file_exists(MODEL.$modelName.'.php')) {
      require MODEL.$modelName.'.php';
      $this->model=new $modelName;
      return $this->model;
    }
  }


}


 ?>
