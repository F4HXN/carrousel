<?php
/**
 * Plugin Name: Carrousel Sites Pro
 * Plugin URI: https://www.f4hxn.fr
 * Description: Carrousel élégant pour afficher vos sites web avec prévisualisation et ouverture au clic
 * Version: 1.0.0
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
define('CSP_VERSION', '1.0.0');
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
            'url' => 'https://www.f4hxn.fr',
            'title' => 'F4HXN - Radio Amateur',
            'icon' => '📻',
            'description' => 'Site de radio amateur F4HXN'
        ),
        array(
            'url' => 'https://www.mansouri.fr',
            'title' => 'Mansouri - Portfolio',
            'icon' => '💻',
            'description' => 'Portfolio professionnel'
        ),
        array(
            'url' => 'https://www.frimousse.net',
            'title' => 'Frimousse',
            'icon' => '🌐',
            'description' => 'Site Frimousse'
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
        
        // Attributs par défaut
        $atts = shortcode_atts(array(
            'autoplay' => 'true',
            'delay' => '5000',
            'title' => 'Mes Sites Web'
        ), $atts);
        
        ob_start();
        ?>
        <div class="carousel-sites-wrapper" 
             data-autoplay="<?php echo esc_attr($atts['autoplay']); ?>"
             data-delay="<?php echo esc_attr($atts['delay']); ?>">
            <div class="carousel-container">
                <h2><?php echo esc_html($atts['title']); ?></h2>
                
                <div class="carousel-wrapper">
                    <div class="click-instruction">👆 Cliquez pour visiter</div>
                    
                    <div class="carousel-track">
                        <?php foreach ($sites as $site) : ?>
                            <div class="carousel-slide" data-url="<?php echo esc_url($site['url']); ?>">
                                <div class="site-preview">
                                    <div class="preview-placeholder">
                                        <div class="preview-icon"><?php echo esc_html($site['icon']); ?></div>
                                        <div><?php echo esc_html(strtoupper(parse_url($site['url'], PHP_URL_HOST))); ?></div>
                                    </div>
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
                foreach ($_POST['site_url'] as $index => $url) {
                    if (!empty($url)) {
                        $sites[] = array(
                            'url' => esc_url_raw($url),
                            'title' => sanitize_text_field($_POST['site_title'][$index]),
                            'icon' => sanitize_text_field($_POST['site_icon'][$index]),
                            'description' => sanitize_text_field($_POST['site_description'][$index])
                        );
                    }
                }
            }
            
            update_option('csp_sites', $sites);
            echo '<div class="notice notice-success"><p>Sites enregistrés avec succès !</p></div>';
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
