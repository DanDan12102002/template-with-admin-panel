<?php
/**
 * Class registration
 * handles the user registration
 */
class ArticleModel
{

	public function getItems()
    {

		$file = 'data/articles.txt';
		$cases = json_decode( file_get_contents($file), 1 );
		
		return $cases;
    }
	
	public function sortItems( $items = array(), $sort = 'order' )
    {		
		# Если есть отели
		if ( count($items) ) :
			$orders = array();
			
			foreach ($items as $key => $row) :
				$orders[$key] = $row['order'];
			endforeach;
			
			array_multisort($orders, SORT_ASC, $items);
		endif;
		
		return $items;
		
    }
	
	public function getItem( $id = '' )
    {

		$file = 'data/articles.txt';
		$cases = json_decode( file_get_contents($file), 1 );

		foreach( $cases as $item ) :
			if ( $item['id'] == $id ) :
		
				return $item;
				
			endif;
		endforeach;
		
		return false;
    }
	
	public function delItem( $id = '' )
    {
		$file = 'data/articles.txt';
		$cases = json_decode( file_get_contents($file), 1 );

		foreach( $cases as $key => $item ) :
			if ( $item['id'] == $id ) :
				unset($cases[$key]);
				
				$newcases = array_values($cases);
				
				$this->saveItems($newcases);
			endif;
		endforeach;
		
		return;
    }
	
	public function getNewItemId()
    {

		$file = 'data/articles.txt';
		$cases = json_decode( file_get_contents($file), 1 );
		
		$newItemId = 0;
		
		foreach( $cases as $key => $item ) :
			if ( $item['id'] >= $newItemId ) :
				$newItemId = $item['id'] + 1;
			endif;
		endforeach;
		
		if ( $newItemId == 0 ) :
			$newItemId = 1;
		endif;
		
		return $newItemId;
    }
	
	public function saveItems( $data = [] )
    {
		if( count($data) ) :
			$file = 'data/articles.txt';
			
			$dataJson = json_encode($data);
			
			# Save Data to file
		
			file_put_contents($file, $dataJson);
		else :
			$file = 'data/articles.txt';
			
			file_put_contents($file, "");
		endif;
		
		return;
    }
	
	public function prepareData()
    {
		$data = $this->getItems();

		# Если такой отель есть, обновляем
		if ( isset($_POST['id']) && count($data) ) :
		
			foreach( $data as $key => $item ) :
				if ( $item['id'] == $_POST['id'] ) :
					$data[$key] = [
						'id' => $_POST['id'],
						'state' => $_POST['state'],
						'order' => $_POST['order'],
						'fields' => $_POST['fieds']
					];
				endif;
			endforeach;
		
		# Если нет, то добавляем новый
		else :
			$itemId = $this->getNewItemId();
			
			$data[] = [
				'id' => $itemId,
				'state' => $_POST['state'],
				'order' => $_POST['order'],
				'fields' => $_POST['fieds']
			];
			
		endif;
		
		/*echo '<pre>';
		print_r($data);
		die();*/
		
		return $data;
    }
}
