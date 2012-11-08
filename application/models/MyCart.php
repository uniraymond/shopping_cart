<?php 
	class MyCart extends Zend_Db_Table
	{
		protected $_name = 'mycart';
		var $total_price = 0;
		
		//add product to cart
		function addProduct($userid, $productid, $nums=1){
			$res = $this->fetchAll("userid=$userid AND bookid=$productid")->toArray();
			if(count($res)>0){
				//if the item in the cart already.
				
				$old_nums = $res[0]['nums'];
				$data = array(
						'nums' => $old_nums + 1
						);
				$where = "userid=$userid AND bookid = $productid";
				$this->update($data, $where);
				return true;
			}
			$now = time();
			$data = array(
					'userid' => $userid,
					'bookid' => $productid,
					'nums' => $nums,
					'cartDate' => $now
					);
			if($this->insert($data)>0){
// 				$this->view->info = 'Add product success';
// 				$this->_forward('success', 'global');
				return true;	
			}else{
				return false;
			}
			
		}
		//del product to cart
		function delProduct($userid, $id){
			if($this->delete("userid=$userid AND bookid=$id")>0){
				return true;
			}else{
				return false;
			}
		}
		//modify product to cart
		function updateProduct($userid, $id, $newnums){
			$set = array(
				'nums' => $newnums
			);
			
			$where = "userid=$userid AND bookid=$id";
			return $this->update($set, $where);
		}
		
		//caculate total price
		function getTotalPrice(){
			
		}
		
		//show cart
		function showMyCart($userid){
			$sql = "SELECT b.id, b.name, b.price, b.publishHouse, m.nums FROM book b, mycart m WHERE b.id=m.bookid AND m.userid = $userid";
			$db = $this->getAdapter();
			$res = $db->query($sql)->fetchAll();
			foreach($res as $r)
			{
				$this->total_price += $r['price'] * $r['nums'];
			}
// 			for($i=0; $i<count($res); $i++){
// 				$bookinfo = $res[$i];
// 				$this->total_price += $bookinfo['price'] * $bookinfo['nums'];
// 			}
			return $res;
		}
	}
?>