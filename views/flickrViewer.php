<?php

	#View class for displaying a list of images from the Flickr servers.
	class FlickrViewerView {
		private $flickr;

		public function __construct(Flickr $flickr) {
			$this->flickr = $flickr;
			
		}

		#Function for rendering view
		public function output() {
			
			$html = "";
			
			if ($this->flickr->getSearchTerm() === "") {
				$html = '<div class="fv-no-results"><p>
							Enter any number of tags to view public Flickr images.
						</p></div>';
			}
			#Display message if there are no results
			else if ($this->flickr->getNumPhotos() === 0) {
				$html = '<div class="fv-no-results"><p>
							No results found for "' . $this->flickr->getSearchTerm()
						. '".</p></div>';
			} 
			#Otherwise display images (simple wrapping list of img elements for now)
			else {
				$html = '<div class="fv-results-found"><p>
						 	Showing top results for "' . $this->flickr->getSearchTerm()
						. '" (' . $this->flickr->getTotalResults() 
						. ' images found in total):</p></div>';

				foreach($this->flickr->getPhotos() as $index=>$photo) {

					$html .= "<a href='" . $photo['fullImage'] . "'>"
							  . "<img class='fv-thumbnail' "
							  . "src='" . $photo['thumbnail'] . "' "
							  . "alt='" . $photo['title'] . "' "
							  . "/></a>";
				}
			}

			return $html;

		}
	}
?>
