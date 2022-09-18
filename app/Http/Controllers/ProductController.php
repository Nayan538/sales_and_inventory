<?php
class ProductController extends Controller
{
	//[G]et Function | GET DATA
	public function getProductData($product_id)
	{
		$sql_code = "SELECT * FROM `products` WHERE `id` = :ID";
		$query = $this->connection->prepare($sql_code);
		$values = array(':ID' => $product_id);
		$query->execute($values);
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}	

	//[C]hange Function | CHANGE STATUS
	public function changeProductData($product_id, $change_status)
	{
		if($change_status == "Active")
			$sql_code = "UPDATE `products` SET `product_status` = 'Inactive' WHERE `id` = :ID";			
		else if($change_status == "Inactive")
			$sql_code = "UPDATE `products` SET `product_status` = 'Active' WHERE `id` = :ID";

		$query = $this->connection->prepare($sql_code);
		$values = array( ':ID' => $product_id);
		$query->execute($values);
		$changeStatus = $query->rowCount();

		return $changeStatus;
	}		

}
?>