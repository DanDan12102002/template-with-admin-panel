<?php
class Fields
{
    
	protected $routeParams = [];

    public function __construct($routeParams)
    {
        $this->routeParams = $routeParams;
    }
	
    public function getList()
    {
		$model = new FieldsModel();
		
		# Если есть поля для сохранения, то пишем в файл
		if ( count($_POST['savefields']) ) :
            $model->saveFields();
			
			$this->messages[] = 'Поля успешно сохранены';
		endif;
		
		# Отображаем список полей
		$this->items = $model->getFields();
		//$this->items = $model->sortFields( $items );
		
		$view = new View();
		return $view->render( $this, 'tmpl/fields.php');
    }
	
	public function getField()
    {
		$this->type = $this->routeParams['type'];
		$this->index = $this->routeParams['index'];
		
		$view = new View();
		return $view->render( $this, 'tmpl/fields/'.$this->type.'.php');
    }
}
