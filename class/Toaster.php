<?php
namespace App;
class Toaster{
	public function showToaster($param , $text){
		if (isset($_GET[$param])) {
			return '
			<div class="toast show position-fixed bottom-0 end-0 m-3 bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header text-white bg-success">
			    <strong class="me-auto">Success</strong>
			    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
			  </div>
			  <div class="toast-body">' . htmlspecialchars($text) . '</div>
			</div>';
		}
	}


}