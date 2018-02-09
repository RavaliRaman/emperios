<?php
class clicface_Label {
	function __construct( $id ) {
		try {
			// Nom
			$this->Nom = get_the_title($id);
			
			// Organigramme
			$this->DisplayPageLink = get_post_meta($id , 'display_page_link', true);
			$this->PageLinkID = get_post_meta($id , 'link_page_id', true);
			
			$this->Erreur = false;
			return true;
		}
		
		catch (Exception $e) {
			$this->Erreur = __('An error occurred:', 'clicface-trombi') . " $this->Nom : " . $e->getMessage() . "\r";
			return false;
		}
	}
}