<?php
/**
 * Plugin Name: Carrousel Sites Pro
 * Plugin URI: https://www.f4hxn.fr
 * Description: Carrousel élégant pour afficher vos sites web avec prévisualisation et ouverture au clic
 * Version: 1.6.1
 * Author: Jean-Paul Mansouri (F4HXN)
 * Author URI: https://www.f4hxn.fr
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: carrousel-sites-pro
 */

// Sécurité : empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

// Définir les constantes du plugin
define('CSP_VERSION', '1.6.1');
define('CSP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CSP_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Classe principale du plugin
 */
class Carrousel_Sites_Pro {
    
    /**
     * Instance unique du plugin
     */
    private static $instance = null;
    
    /**
     * Sites par défaut
     */
    private $default_sites = array(
        array(
            'url' => 'https://www.exemple1.fr',
            'title' => 'Site Exemple 1',
            'icon' => '🌐',
            'description' => 'Description du premier site',
            'image' => ''
        ),
        array(
            'url' => 'https://www.exemple2.fr',
            'title' => 'Site Exemple 2',
            'icon' => '💻',
            'description' => 'Description du second site',
            'image' => ''
        )
    );
    
    /**
     * Obtenir l'instance unique
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructeur
     */
    private function __construct() {
        $this->init_hooks();
    }
    
    /**
     * Initialiser les hooks
     */
    private function init_hooks() {
        // Enregistrer les scripts et styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        
        // Enregistrer le shortcode
        add_shortcode('carrousel_sites', array($this, 'render_shortcode'));
        
        // Ajouter le menu admin
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // Charger les scripts admin
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        
        // Enregistrer les paramètres
        add_action('admin_init', array($this, 'register_settings'));
    }
    
    /**
     * Charger les assets (CSS et JS)
     */
    public function enqueue_assets() {
        wp_enqueue_style(
            'carrousel-sites-pro',
            CSP_PLUGIN_URL . 'assets/css/carrousel-sites-pro.css',
            array(),
            CSP_VERSION
        );
        
        wp_enqueue_script(
            'carrousel-sites-pro',
            CSP_PLUGIN_URL . 'assets/js/carrousel-sites-pro.js',
            array(),
            CSP_VERSION,
            true
        );
    }
    
    /**
     * Rendu du shortcode
     */
    public function render_shortcode($atts) {
        // Récupérer les sites depuis les options ou utiliser les défauts
        $sites = get_option('csp_sites', $this->default_sites);
        
        // Récupérer le titre personnalisé ou utiliser le défaut
        $default_title = get_option('csp_carousel_title', 'Mes Sites Web');
        
        // Récupérer les couleurs personnalisées
        $bg_color = get_option('csp_carousel_bg_color', '#ffffff');
        $title_color = get_option('csp_carousel_title_color', '#0076a5');
        
        // Récupérer les options d'ombre
        $title_shadow = get_option('csp_title_shadow', '0');
        $carousel_shadow = get_option('csp_carousel_shadow', '1');
        
        // Générer un ID unique pour ce carrousel
        $unique_id = 'csp-' . uniqid();
        
        // Attributs par défaut
        $atts = shortcode_atts(array(
            'autoplay' => 'true',
            'delay' => '5000',
            'title' => $default_title
        ), $atts);
        
        ob_start();
        ?>
        <style>
            .<?php echo $unique_id; ?> {
                background: <?php echo esc_attr($bg_color); ?> !important;
            }
            .<?php echo $unique_id; ?> h2 {
                color: <?php echo esc_attr($title_color); ?> !important;
                <?php if ($title_shadow === '1') : ?>
                text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4) !important;
                <?php else : ?>
                text-shadow: none !important;
                <?php endif; ?>
            }
            .<?php echo $unique_id; ?> .carousel-wrapper {
                <?php if ($carousel_shadow === '1') : ?>
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25) !important;
                <?php else : ?>
                box-shadow: none !important;
                <?php endif; ?>
            }
        </style>
        <div class="carousel-sites-wrapper <?php echo $unique_id; ?>" 
             data-autoplay="<?php echo esc_attr($atts['autoplay']); ?>"
             data-delay="<?php echo esc_attr($atts['delay']); ?>">
            <div class="carousel-container">
                <h2><?php echo esc_html($atts['title']); ?></h2>
                
                <div class="carousel-wrapper">
                    <button class="click-instruction" onclick="document.querySelector('.carousel-slide').click()">👆 Cliquez pour visiter</button>
                    
                    <div class="carousel-track">
                        <?php foreach ($sites as $site) : ?>
                            <div class="carousel-slide" data-url="<?php echo esc_url($site['url']); ?>">
                                <div class="site-preview">
                                    <?php if (!empty($site['image'])) : ?>
                                        <img src="<?php echo esc_url($site['image']); ?>" 
                                             alt="<?php echo esc_attr($site['title']); ?>"
                                             class="site-image">
                                    <?php else : ?>
                                        <div class="preview-placeholder">
                                            <div class="preview-icon"><?php echo esc_html($site['icon']); ?></div>
                                            <div><?php echo esc_html(strtoupper(parse_url($site['url'], PHP_URL_HOST))); ?></div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="site-overlay">
                                    <div class="site-title"><?php echo esc_html($site['title']); ?></div>
                                    <div class="site-url"><?php echo esc_url($site['url']); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button class="carousel-btn prev" aria-label="Précédent">❮</button>
                    <button class="carousel-btn next" aria-label="Suivant">❯</button>
                </div>

                <div class="carousel-indicators"></div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Ajouter le menu admin
     */
    public function add_admin_menu() {
        add_menu_page(
            'Carrousel Sites Pro',
            'Carrousel Sites',
            'manage_options',
            'carrousel-sites-pro',
            array($this, 'render_admin_page'),
            'dashicons-images-alt2',
            30
        );
    }
    
    /**
     * Charger les scripts pour l'admin
     */
    public function admin_enqueue_scripts($hook) {
        // Charger seulement sur notre page
        if ($hook !== 'toplevel_page_carrousel-sites-pro') {
            return;
        }
        
        // Charger le media uploader de WordPress
        wp_enqueue_media();
        
        // Ajouter notre script personnalisé
        wp_enqueue_script(
            'csp-admin',
            CSP_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            CSP_VERSION,
            true
        );
    }
    
    /**
     * Enregistrer les paramètres
     */
    public function register_settings() {
        register_setting('csp_settings', 'csp_sites');
    }
    
    /**
     * Rendu de la page admin
     */
    public function render_admin_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        // Sauvegarder les données
        if (isset($_POST['csp_save_sites']) && check_admin_referer('csp_save_sites_action')) {
            $sites = array();
            
            if (isset($_POST['site_url']) && is_array($_POST['site_url'])) {
                $count = count($_POST['site_url']);
                
                for ($i = 0; $i < $count; $i++) {
                    $url = isset($_POST['site_url'][$i]) ? sanitize_text_field($_POST['site_url'][$i]) : '';
                    $title = isset($_POST['site_title'][$i]) ? sanitize_text_field($_POST['site_title'][$i]) : '';
                    $icon = isset($_POST['site_icon'][$i]) ? sanitize_text_field($_POST['site_icon'][$i]) : '🌐';
                    $description = isset($_POST['site_description'][$i]) ? sanitize_text_field($_POST['site_description'][$i]) : '';
                    $image = isset($_POST['site_image'][$i]) ? esc_url_raw($_POST['site_image'][$i]) : '';
                    
                    // N'ajouter que si l'URL et le titre ne sont pas vides
                    if (!empty($url) && !empty($title)) {
                        $sites[] = array(
                            'url' => esc_url_raw($url),
                            'title' => $title,
                            'icon' => $icon,
                            'description' => $description,
                            'image' => $image
                        );
                    }
                }
            }
            
            // Sauvegarder le titre du carrousel
            if (isset($_POST['carousel_title'])) {
                update_option('csp_carousel_title', sanitize_text_field($_POST['carousel_title']));
            }
            
            // Sauvegarder la couleur de fond
            if (isset($_POST['carousel_bg_color'])) {
                update_option('csp_carousel_bg_color', sanitize_hex_color($_POST['carousel_bg_color']));
            }
            
            // Sauvegarder la couleur du titre
            if (isset($_POST['carousel_title_color'])) {
                update_option('csp_carousel_title_color', sanitize_hex_color($_POST['carousel_title_color']));
            }
            
            // Sauvegarder les options d'ombre
            update_option('csp_title_shadow', isset($_POST['title_shadow']) ? '1' : '0');
            update_option('csp_carousel_shadow', isset($_POST['carousel_shadow']) ? '1' : '0');
            
            // Sauvegarder même si le tableau est vide (permet de tout supprimer)
            update_option('csp_sites', $sites);
            
            echo '<div class="notice notice-success is-dismissible"><p><strong>✓ Modifications enregistrées avec succès !</strong> (' . count($sites) . ' site(s) enregistré(s))</p></div>';
        }
        
        // Réinitialiser aux sites par défaut
        if (isset($_POST['csp_reset_sites']) && check_admin_referer('csp_reset_sites_action')) {
            update_option('csp_sites', $this->default_sites);
            echo '<div class="notice notice-success is-dismissible"><p><strong>✓ Sites réinitialisés aux exemples par défaut !</strong></p></div>';
        }
        
        $sites = get_option('csp_sites', $this->default_sites);
        
        include CSP_PLUGIN_DIR . 'admin/admin-page.php';
    }
}

// Initialiser le plugin
function carrousel_sites_pro_init() {
    return Carrousel_Sites_Pro::get_instance();
}
add_action('plugins_loaded', 'carrousel_sites_pro_init');
