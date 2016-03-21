<?php
	Class Home extends Controller
	{
		public function index()
		{
			//var_dump($this->db->query('SELECT * FROM test'));
			$this->view('home/index');
		}
	}