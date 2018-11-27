<?php
class Menu {
	
	public $items = [];
	public $item = [];
	
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $routeParams = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($routeParams)
    {
        $this->routeParams = $routeParams;
    }
	
	public function getList()
	{
		$model = new MenuModel();
		$items = $model->getItems();
		
		$this->items = $model->sortItems( $items );
		
		$view = new View();
		return $view->render( $this, 'tmpl/menus.php');
	}
	
	public function addItem()
	{
		
		# Если отправили форму с данными на сохранение
		if ( count($_POST['fieds']) ) :
			
			$model = new MenuModel();
			$data = $model->prepareData();
			$model->saveItems($data);
			
			$this->item = $data;
			
			$this->messages[] = 'Item successfully saved';
		endif;
		
		# Если нужно редактировать запись
		if ( isset($this->routeParams['id']) ) :
			$hotelId = $this->routeParams['id'];
			$model = new MenuModel();
			
			$this->item = $model->getItem($hotelId);
		endif;
		
		$view = new View();
		return $view->render( $this, 'tmpl/menu.php');
	}
	
	public function delItem()
	{
		global $app;
		
		# Если есть ИД записи
		if ( isset($this->routeParams['id']) ) :
			$hotelId = $this->routeParams['id'];
			$model = new MenuModel();
			
			$model->delItem($hotelId);
		endif;
		
		header('Location: '.$app->baseurl.'/menus');
		die();
	}
}
