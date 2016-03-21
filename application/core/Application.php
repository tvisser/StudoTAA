<?php
	class Application
	{
		const VERSION = '0.0.1';

		/**
        * Default variables for the controller.
        */
		protected $controller = 'home';
		protected $method = 'index';
		protected $params = [];

		/**
		 * Application constructor. Selects which file & function to call.
         */
		public function __construct()
		{
			session_start();
			$url = $this->parse_url();

			if(file_exists('application/controllers/' . $url[0] . '.php'))
			{
				$this->controller = $url[0];
				unset($url[0]);
			}

			require_once 'application/controllers/' . $this->controller . '.php';

			$this->controller = new $this->controller;

			if(isset($url[1]))
			{
				if(method_exists($this->controller, $url[1]))
				{
					# Use the reflection method to recognize if the function has the proper visibility.
					$reflection = new ReflectionMethod($this->controller, $url[1]);
				    if ($reflection->isPublic()) {
						$this->method = $url[1];
						unset($url[1]);
				    }
				}
			}

			$this->params = $url  ? array_values($url) : [];

			call_user_func_array([$this->controller, $this->method], $this->params);
		}

		/**
		 * Explode URL get-variables and return them as an array.
		 *
		 * @return array	Returns URL get-variables split into an array- if empty then return null.
         */
		public function parse_url()
		{
			return (isset($_GET['url'])) ? $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : null;
		}
		
	}