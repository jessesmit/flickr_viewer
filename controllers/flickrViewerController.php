<?php
	class FlickrViewerController {

		private $model;

		public function __construct($model) {
			$this->model = $model;
		}

		public function search($request) {
			$this->model->search($request['tags']);
		}
	}
?>
