<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Layout
{
    private $CI;
    private $var = array();
     
/*
|===============================================================================
| Constructeur
|===============================================================================
*/
     
    public function __construct()
    {
        $this->CI = get_instance();
         
        $this->var['header'] = ''; // all default views (menu, header.)
        $this->var['answer'] ='';    // the answer when the user used a form
        $this->var['content'] ='';    // all inside page content
        $this->var['footer'] ='';     // all footer
        
        //CSS & JS
        $this->var['css'] = array();
        $this->var['js'] = array();
        
		//CSSs ajoutés par défaut :
//         $this->var['css'][] = css_url("general");
        $this->var['css'][] = css_url("style");     
        
        //Vues ajoutées par défaut :
        $this->var['header'] .= $this->CI->load->view('default/header', $data = array(), true);
        $this->var['answer'] .= $this->CI->load->view('default/answer', $data = array(), true);
        $this->var['header'] .= $this->CI->load->view('default/menu', $data = array(), true);
    }
     
/*
|===============================================================================
| Méthodes pour charger les vues
|   . view
|   . views
| exemple : 
		public function accueil()
		{
		    $this->load->library('layout'); //A part si mis dans l'autoload.php (config)
		     
		    $this->layout->views('premiere_vue')
		             ->views('deuxieme_vue')
		             ->view('derniere_vue');
		}
|===============================================================================
*/
     
    public function view($name, $data = array())
    {
        $this->var['content'] .= $this->CI->load->view($name, $data, true);
        
        //Ajout de la dernière vue : le footer
        $this->var['footer'] .= $this->CI->load->view('default/footer', $data, true);
        
        //Chargement de toutes les vues
        $this->CI->load->view('../themes/default', $this->var);
    }
     
    public function views($name, $data = array())
    {
        $this->var['content'] .= $this->CI->load->view($name, $data, true);
        return $this;
    }
    
    

    /*
     |===============================================================================
    | Méthodes pour ajouter des feuilles de CSS et de JavaScript
    |   . ajouter_css
    |   . ajouter_js
    |===============================================================================
    */
    public function ajouter_css($nom, $url = false)
    {
    	if(is_string($nom) AND !empty($nom) AND file_exists('./assets/css/' . $nom . '.css') AND !$url)
    	{
    		$this->var['css'][] = css_url($nom);
    		return true;
    	}
    	else if($url) {
    		$this->var['css'][] = $nom;
    	}
    	return false;
    }
    //@param : $url extérieur exemple :<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  	public function ajouter_js($nom, $url = false)
    {
    	if(is_string($nom))
    	{
    		if(!empty($nom) AND file_exists('./assets/javascript/' . $nom . '.js') AND !$url)
    		{
	    		$this->var['js'][] = js_url($nom);
	    		return true;
    		}
    		else if($url) {
    			$this->var['js'][] = $nom;
    		}
    	}
    	else 
    	{
    		return false;
    	}
    }
}