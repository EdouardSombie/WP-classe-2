<?php
/*
Plugin Name: Plugin ESGI
Plugin URI: https://esgi.fr
Description: Ajout d'un type de publication personnalisé.
Author: Edouard Sombié
Version: 1
*/


// Enregistrement du custom post type
add_action('init', 'esgi_custom_post_type');
function esgi_custom_post_type() {

	$labelsProject = array(
	 'name' => __( 'Projets' ),
	 'singular_name' => __( 'Projet' ),
	 'all_items' => __( 'Tous les projets' ),
	 'add_new' => __( 'Ajouter un projet', 'Projets' ),
	 'add_new_item' => __( 'Ajouter un projet' ),
	 'edit_item' => __( 'Modifier un projet' ),
	 'new_item' => __( 'Nouveau projet' ),
	 'view_item' => __( 'Voir le projet' ),
	 'search_items' => __( 'Rechercher parmi les projets' ),
	 'not_found' => __( 'Aucun projet trouvé' ),
	 'not_found_in_trash' => __( 'Aucun projet trouvé dans la corbeille' ),
	 'parent_item_colon' => ''
	 );

	 $argsProject = array(
	 'labels' => $labelsProject,
	 'public' => true,
	 'has_archive' => true, // Set to false hides Archive Pages
	 'menu_icon' => 'dashicons-media-code', //pick one here ~> https://developer.wordpress.org/resource/dashicons/
	 'rewrite' => array( 'slug' => 'projet' ),
	 //'taxonomies' => array( 'post_tag' ),
	 'query_var' => true,
	 'menu_position' => 1,
	 'publicly_queryable' => true, // Set to false hides Single Pages
	 'supports' => array( 'thumbnail' , 'title', 'editor'),
	 'show_in_rest' => true
	 );

	register_post_type('project', $argsProject);


	// Création d'une taxonomie custom pour les projets 
	$labels = [
	 'name' => __( 'Skills' ),
	 'singular_name' => __( 'Skill' ),
	 'all_items' => __( 'Tous les Skills' ),
	 'add_new' => __( 'Ajouter un Skill', 'Skills' ),
	 'add_new_item' => __( 'Ajouter un Skill' ),
	 'edit_item' => __( 'Modifier un Skill' ),
	 'new_item' => __( 'Nouveaux Skills' ),
	 'view_item' => __( 'Voir le Skill' ),
	 'search_items' => __( 'Rechercher parmi les Skills' ),
	 'not_found' => __( 'Aucun Skill trouvé' ),
	 'not_found_in_trash' => __( 'Aucun Skill trouvé dans la corbeille' ),
	 'parent_item_colon' => ''
	 ];

	 $args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'			=> true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => ['slug' => 'skills'],
	);

	register_taxonomy( 'skills', 'project', $args);
}


// Enregistrement d'un shortcode
add_action('init', 'esgi_shortcode');
function esgi_shortcode(){
	add_shortcode('skills-list', 'esgi_skills_list');
}

function esgi_skills_list($att){
	$terms = get_terms('skills');
	$output = '';
	$title = isset($att['title']) ? $att['title'] : 'Titre par défaut';
	if(!empty($terms)){
		$output .= '<h2>' . $title . '</h2>';
		$output .= '<ul>';
		foreach($terms as $term){
			$output .= '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
		}
		$output .= '</ul>';
	}

	return $output;
}


// Création d'un widget

add_action( 'widgets_init', 'esgi_register_widgets' );
function esgi_register_widgets() {
    register_widget( 'SkillsListWidget' );
}

class SkillsListWidget extends WP_Widget {
 
    public function __construct() {
        parent::__construct(
            'skills_list_widget', // Base ID
            'Skills List', // Name
            array( 'description' => __( 'Affiche une liste des skills', 'ESGI' ), ) // Args
        );
    }
 
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
 
        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }
        echo $this->getList();
        echo $after_widget;
    }
 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Ajouter un titre', 'ESGI' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
         </p>
    <?php
    }
 
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
 
        return $instance;
    }

    public function getList(){
    	$terms = get_terms('skills');
		$output = '';
		if(!empty($terms)){
			$output .= '<ul>';
			foreach($terms as $term){
				$output .= '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
			}
			$output .= '</ul>';
		}
		return $output;
    }
}





