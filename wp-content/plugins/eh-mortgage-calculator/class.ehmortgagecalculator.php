<?php
class EHMortgageCalculator {
    /**
     * Holds the singleton instance of this class
     * @since 1.0.0
     * @var EHMortgageCalculator
     */
    static $instance = false;
    
    /**
     * Singleton
     * @static
     */
    public static function init() {
        if ( ! self::$instance ) {
            if ( did_action( 'plugins_loaded' ) ) {
                self::plugin_textdomain();
            }
            else {
                add_action( 'plugins_loaded', array( __CLASS__, 'plugin_textdomain' ), 99 );
            }
            self::$instance = new EHMortgageCalculator;
        }
        return self::$instance;
    }
    
    /**
     * Constructor.  Initializes WordPress hooks
     */
    private function __construct() {
        /*
         * Do things that should run even in the network admin
	 * here, before we potentially fail out.
	 */
        $shortcode = new EHMortgageCalculator_html();
        
        add_action( 'widgets_init', array( $this, 'register_ehmortgagecalculator_widget' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'ehmortgagecalculator_scripts' ) );
        
        add_shortcode( 'ehmortgagecalculator', array( $shortcode, 'getHTML' ) );
    }
    
    public function ehmortgagecalculator_scripts() {
        wp_enqueue_style( 'amortization', plugins_url( 'css/bootstrap.min_.css', EHMORTGAGECALCULATOR__PLUGIN_FILE ) );
	wp_enqueue_script( 'amortization', plugins_url( '_inc/ehmortgagecalculator.js', EHMORTGAGECALCULATOR__PLUGIN_FILE ), array(), '1.0.0', true )  ;
    }
    
    // register EHMortgageCalculator_Widget
    function register_ehmortgagecalculator_widget() {
        register_widget( 'EHMortgageCalculator_Widget' );
    }

    /**
     * Load language files
     */
    public static function plugin_textdomain() {
        // Note to self, the third argument must not be hardcoded, to account for relocated folders.
        load_plugin_textdomain( 'eh-mortgage-calculator', false, dirname( plugin_basename( EHMORTGAGECALCULATOR__PLUGIN_FILE ) ) . '/languages/' );
    }
        
        
    /**
     * Is EHMortgageCalculator active?
     */
    public static function is_active() {
        return (bool) EHMortgageCalculator_Data::get_access_token( EHMORTGAGECALCULATOR_MASTER_USER );
    }
    
    /**
     * Is EHMortgageCalculator in development (offline) mode?
     */
    public static function is_development_mode() {
        $development_mode = false;
        
        if ( defined( 'EHMORTGAGECALCULATOR_DEV_DEBUG' ) ) {
            $development_mode = EHMORTGAGECALCULATOR_DEV_DEBUG;
        }
        
        elseif ( site_url() && false === strpos( site_url(), '.' ) ) {
            $development_mode = true;
        }
        return apply_filters( 'ehmortgagecalculator_development_mode', $development_mode );
    }
}
