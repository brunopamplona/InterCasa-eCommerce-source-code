<?php
final class Action {
	protected $file;
	protected $class;
	protected $method;
	protected $args = array();

	public function __construct($route, $args = array()) {
		$path = '';
		
		$parts = explode('/', str_replace('../', '', (string)$route));
		

			if (version_compare(VERSION, '2.0', '<')) {
				$parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route));

				while ($parts) {
					$file = DIR_APPLICATION . 'controller/' . implode('/', $parts) . '.php';

					if (is_file($file)) {
						$this->file = $file;

						$this->class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', implode('/', $parts));

						break;
					} else {
						$this->method = array_pop($parts);
					}
				}

				if (!$this->method) {
					$this->method = 'index';
				}

				$this->args = $args;

				return;
			}
			
		foreach ($parts as $part) { 
			$path .= $part;
			
			if (is_dir(DIR_APPLICATION . 'controller/' . $path)) {
				$path .= '/';
				
				array_shift($parts);
				
				continue;
			}
			
			if (is_file(DIR_APPLICATION . 'controller/' . str_replace(array('../', '..\\', '..'), '', $path) . '.php')) {
				$this->file = DIR_APPLICATION . 'controller/' . str_replace(array('../', '..\\', '..'), '', $path) . '.php';
				
				$this->class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $path);

				array_shift($parts);
				
				break;
			}
		}
		
		if ($args) {
			$this->args = $args;
		}
			
		$method = array_shift($parts);
				
		if ($method) {
			$this->method = $method;
		} else {
			$this->method = 'index';
		}
	}
	
	public function getFile() {
		return $this->file;
	}
	
	public function getClass() {
		return $this->class;
	}
	
	public function getMethod() {
		return $this->method;
	}
	
	public function getArgs() {
		return $this->args;
	}
}
?>