<?php

class TrackingItem {
	protected $_id;
	protected $_date;
	protected $_type;
	protected $_amount;

	function __construct($id, $date, $type, $amount)
	{
		$this->_id = $id;
		$this->_date = $date;
		$this->_type = $type;
		$this->_amount = $amount;
	}

	function get()
	{
		return [
			'id' => $this->_id,
			'date' => $this->_date,
			'type' => $this->_type,
			'amount' => $this->_amount,
		];
	}
}

class TrackingList {
	protected $_data;

	function __construct($items)
	{
		foreach ($items as $item) {
			extract($item);
			$this->_data[] = new TrackingItem($id, $date, $type, $amount);
		}
	}

	function get()
	{
		return $this->_data;
	}
}

function getTrackingItems()
{
	$data = [
		['id'=>rand(1,1000), 'date'=>date("U")-rand(1000,4000), 'type'=>'lead', 'amount'=>0],
		['id'=>rand(1,1000), 'date'=>date("U")-rand(1000,4000), 'type'=>'sale', 'amount'=>10],
		['id'=>rand(1,1000), 'date'=>date("U")-rand(1000,4000), 'type'=>'lead', 'amount'=>0],
		['id'=>rand(1,1000), 'date'=>date("U")-rand(1000,4000), 'type'=>'sale', 'amount'=>30],
	];

	$list = new TrackingList($data);

	$ret = [];
	foreach ($list->get() as $item) {
		$ret[] = $item->get();
	}

	return $ret;
}

//$ss = new SoapServer(null, ['uri' => 'http://localhost/testsoap']);
$ss = new SoapServer(null, ['uri' => 'urn://test/rsicart']);
$ss->addFunction('getTrackingItems');
$ss->handle();
