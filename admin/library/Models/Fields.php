<?php
/**
 * Class registration
 * handles the user registration
 */
class FieldsModel
{

    public function saveFields()
    {
		# Если есть поля для сохранения, то пишем в файл
		if ( count($_POST['fieds']) ) :
			$file = 'data/fields.txt';
			
			$dataJson = json_encode($_POST['fieds']);
			
			# Save Data to file
			file_put_contents($file, $dataJson);
			
		# Если по запросу пришел пустой массив, то удаляем поля с файла
		else :
			$file = 'data/fields.txt';
			
			# Save Data to file
			file_put_contents($file, '');
		endif;
    }
	
	public function sortFields( $items = array(), $sort = 'order' )
    {
		# Если есть отели
		if ( count($items) ) :
			$orders = array();
			
			foreach ($items as $key => $row) :
				$orders[$key] = $row['order'];
			endforeach;
			
			array_multisort($orders, SORT_DESC, $items);
		endif;
		
		return $items;
		
    }
	
	public function getFields()
    {
		$file = 'data/fields.txt';
		$data = json_decode( file_get_contents($file), 1 );
		
		return $data;
    }
}
