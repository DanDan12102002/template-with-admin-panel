<?php
class Review {
	
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
		$model = new ReviewModel();
		$items = $model->getItems();
		
		$this->items = $model->sortItems( $items );
		
		$view = new View();
		return $view->render( $this, 'tmpl/reviews.php');
	}
	
	public function addItem()
	{
		
		# Если отправили форму с данными на сохранение
		if ( count($_POST['fieds']) ) :
			
			$model = new ReviewModel();
			$data = $model->prepareData();
			$model->saveItems($data);
			
			$this->item = $data;
			
			$this->messages[] = 'Item successfully saved';
		endif;
		
		# Если нужно редактировать запись
		if ( isset($this->routeParams['id']) ) :
			$hotelId = $this->routeParams['id'];
			$model = new ReviewModel();
			
			$this->item = $model->getItem($hotelId);
		endif;
		
		$view = new View();
		return $view->render( $this, 'tmpl/review.php');
	}
	
	public function delItem()
	{
		global $app;
		
		# Если есть ИД записи
		if ( isset($this->routeParams['id']) ) :
			$hotelId = $this->routeParams['id'];
			$model = new ReviewModel();
			
			$model->delItem($hotelId);
		endif;
		
		header('Location: '.$app->baseurl.'/reviews');
		die();
	}
}
