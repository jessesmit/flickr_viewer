<?php 
	require_once('vendor/zgetro/phpflickr/phpFlickr.php');
	
	define('PHOTOS_PER_PAGE', 49); #Actually requests 48 per page in what seems to be a bug in the API or phpFlickr
	define('FLICKR_APP_KEY', 'f1c4ce13b0ef642b646727c3f420a8f1');

	#Model representing a group of photos matching list of tags
	class Flickr {

		private $flickr;
		private $photos;
		private $searchTerm;
		private $totalResults;

		public function __construct() {
			$this->flickr = new phpFlickr(constant('FLICKR_APP_KEY'));
			$this->photos = array();
			$this->searchTerm = "";
			$this->totalResults = 0;
		}
		
		#Hit Flickr server and retrieve a single page of photos (photo titles and urls hosting those images
		#on the Flickr servers) matching a space separated list of tags.
		public function search($term) {
			
			if ($term === "") {
				return;
			}
			
			$this->searchTerm = $term;
			

			$search_criteria = array("tags"=>$term,
									 "tag_mode"=>"all",
									 "sort"=>"relevance",
									 "per_page"=>constant('PHOTOS_PER_PAGE'));

			$results = $this->flickr->photos_search($search_criteria);
			
			if (empty($results)) {
				return;
			}
			
			$this->totalResults = $results['total'];
			
			$photos = array();
			
			foreach ($results['photo'] as $photo) {
				$photos[] = array("thumbnail"=>$this->flickr->buildPhotoUrl($photo, "square_150"),
								  "fullImage"=>$this->flickr->buildPhotoUrl($photo, "medium"),
								  "title"=>$photo['title']);
			}
			$this->photos = $photos;
		}
		
		public function getPhotos() {
			return $this->photos;
		}
		
		public function getNumPhotos() {
			return count($this->photos);
		}
		
		public function getSearchTerm() {
			return $this->searchTerm;
		}
		
		public function getTotalResults() {
			return $this->totalResults;
		}
	}
?>
