<?php
if (!class_exists('CleancodedSSAdmin')) {

    class CleancodedSSAdmin extends CleancodedSSBase
    {
        //Set form fields list
        private $_formFields = array(
            'CLEANCODED_facebook_title',
            'CLEANCODED_facebook_description',
            'CLEANCODED_facebook_description',
            'CLEANCODED_twitter_title',
            'CLEANCODED_twitter_text',
            'CLEANCODED_linkedin_title',
            'CLEANCODED_linkedin_description',
            'CLEANCODED_image',
            'CLEANCODED_show_on_page',
            'CLEANCODED_twitter_card'
        );

        public function __construct()
        {
            parent::__construct();

            //Call Plugin Initialization Method
            add_action('admin_init', array($this, 'init'));

            //Init Admin Menu
            add_action('admin_menu', array($this, 'adminMenu'));

            //save plugin fields on save post
            add_action('save_post', array($this, 'saveSSBFields'));

        }

        /**
         * Init Admin
         */
        public function init()
        {
            //Start Session if is not started
            if (!session_id()) {
                session_start();
            }

            //Enqueue Media scripts in admin
            add_action('admin_enqueue_scripts', array($this, 'enqueueAdminScripts'));

            //Add metaboxes to  admin
            add_action('add_meta_boxes', array($this, 'adminAddMetaBoxFields'), 10, 2);

            //Register cleancoded SSB settings
            register_setting('cleancoded-ssb-settings-group', 'CLEANCODED_display_auto');

        }

        /**
         * Enqueue Admin Scripts
         */
        public function enqueueAdminScripts()
        {
            if (is_admin()) {
                wp_enqueue_media();

                wp_enqueue_style('SocialShare-admin-style', plugin_dir_url(dirname(__FILE__)) . 'assets/styles/admin-SocialShare.css');

                wp_enqueue_script('SocialShare-admin-script', plugin_dir_url(dirname(__FILE__)) . 'assets/js/admin-SocialShare.js', array('jquery', 'media-upload'), '1.0', true);
            }
        }

        /**
         * Add SSB Fields to WP Admin
         */
        public function adminAddMetaBoxFields($post_type)
        {   //Create cleancoded SSB metabox section
            $post_types = array('post', 'page');
            if (in_array($post_type, $post_types)) {
                add_meta_box(
                    'cleancoded-ssb-meata-box',
                    __('cleancoded SSB', 'cleancoded-ssb'),
                    array($this, 'renderSsbFields'),
                    $post_type,
                    'advanced', 'high'
                );
            }
        }


        /**
         * Render Metabox fields.
         *
         * @param $post
         * @param $args
         */
        public function renderSsbFields($post, $args)
        {
            $data['nonce'] = wp_create_nonce('SocialShare-nonce');

            //get all post meta fields
            $postMetaFields = get_post_meta($post->ID);

            //If "show on page" option is not set get default plugin setting
            $isAutoOptionEnabled = get_option('CLEANCODED_display_auto');
            if (!isset($postMetaFields['CLEANCODED_show_on_page'])) {
                $postMetaFields['CLEANCODED_show_on_page'][0] = $isAutoOptionEnabled;
            }

            //Add cleancoded SSB fields data to form
            foreach ($postMetaFields as $pm_key => $pm_value) {
                if (in_array($pm_key, $this->_formFields)) {
                    $data[$pm_key] = $pm_value[0];
                }
            }

            echo $this->_loadView('ssb-meta-box-fields', $data);
        }

        /**
         * Save cleancoded SBB fields
         *
         * @param $post_id
         * @return mixed
         */
        public function saveSSBFields($post_id)
        {
            $_SESSION['CLEANCODED_errors'] = array();
            //Verify if this is an auto save
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $post_id;
            //Verify nonce
            if (!wp_verify_nonce($_POST['CLEANCODED_nonce'], 'SocialShare-nonce'))
                return $post_id;

            // Check permissions
            if ('page' == $_POST['post_type']) {
                if (!current_user_can('edit_page', $post_id))
                    return $post_id;
            } else {
                if (!current_user_can('edit_post', $post_id))
                    return $post_id;
            }
            $_SESSION['CLEANCODED_errors'] = array();
            $postData = $_POST;

            //Image field
            if (isset($postData['CLEANCODED_image'])) {
                update_post_meta($post_id, 'CLEANCODED_image', sanitize_text_field($postData['CLEANCODED_image']));
            }

            //Facebook fields
            if (isset($postData['CLEANCODED_facebook_title'])) {

                if (mb_strlen(stripslashes($postData['CLEANCODED_facebook_title'])) <= 100) {
                    update_post_meta($post_id, 'CLEANCODED_facebook_title', sanitize_text_field($postData['CLEANCODED_facebook_title']));
                } else {
                    $_SESSION['CLEANCODED_errors']['CLEANCODED_facebook_title_error'] = __('Facebook title length must be 100 symbols maximum.', 'cleancoded-ssb');
                }
            }

            if (isset($postData['CLEANCODED_facebook_description'])) {

                if (mb_strlen(stripslashes($postData['CLEANCODED_facebook_description'])) <= 300) {
                    update_post_meta($post_id, 'CLEANCODED_facebook_description', sanitize_text_field($postData['CLEANCODED_facebook_description']));
                } else {
                    $_SESSION['CLEANCODED_errors']['CLEANCODED_facebook_description_error'] = __('Facebook description length must be 300 symbols maximum.', 'cleancoded-ssb');
                }
            }

            //Twitter field
            if (isset($postData['CLEANCODED_twitter_title'])) {
                if (mb_strlen(stripslashes($postData['CLEANCODED_twitter_title'])) <= 70) {
                    update_post_meta($post_id, 'CLEANCODED_twitter_title', sanitize_text_field($postData['CLEANCODED_twitter_title']));
                } else {
                    $_SESSION['CLEANCODED_errors']['CLEANCODED_twitter_title_error'] = __('Twitter title length must be 70 symbols maximum.', 'cleancoded-ssb');
                }
            }
            if (isset($postData['CLEANCODED_twitter_text'])) {
                if (mb_strlen(stripslashes($postData['CLEANCODED_twitter_text'])) <= 116) {
                    update_post_meta($post_id, 'CLEANCODED_twitter_text', sanitize_text_field($postData['CLEANCODED_twitter_text']));
                } else {
                    $_SESSION['CLEANCODED_errors']['CLEANCODED_twitter_text_error'] = __('Twitter text length must be 116 symbols maximum.', 'cleancoded-ssb');
                }
            }

            //Linkedin fields
            if (isset($postData['CLEANCODED_linkedin_title'])) {
                if (mb_strlen(stripslashes($postData['CLEANCODED_linkedin_title'])) <= 200) {
                    update_post_meta($post_id, 'CLEANCODED_linkedin_title', sanitize_text_field($postData['CLEANCODED_linkedin_title']));
                } else {
                    $_SESSION['CLEANCODED_errors']['CLEANCODED_linkedin_title_error'] = __('LinkedIn title length must be 200 symbols maximum.', 'cleancoded-ssb');
                }
            }

            if (isset($postData['CLEANCODED_linkedin_description'])) {
                if (mb_strlen(stripslashes($postData['CLEANCODED_linkedin_description'])) <= 256) {
                    update_post_meta($post_id, 'CLEANCODED_linkedin_description', sanitize_text_field($postData['CLEANCODED_linkedin_description']));
                } else {
                    $_SESSION['CLEANCODED_errors']['CLEANCODED_linkedin_description_error'] = __('LinkedIn summary length must be 256 symbols maximum.', 'cleancoded-ssb');
                }
            }

            if (isset($postData['CLEANCODED_show_on_page'])) {
                $SocialShareShowOnPageValue = 1;
                //Set value to 0, if field is set, but value is not 1
                if ($postData['CLEANCODED_show_on_page'] != 1) {
                    $SocialShareShowOnPageValue = 0;
                }
            } else {
                //Set value 0 if checkbox is not checked
                $SocialShareShowOnPageValue = 0;
            }
            if (isset($postData['CLEANCODED_twitter_card'])) {
                $SocialShareTwitterCardValue = $postData['CLEANCODED_twitter_card'];
                //Set value to 0, if field is set, but value is not 1
                if ($postData['CLEANCODED_twitter_card'] = 0) {
                    $SocialShareTwitterCardValue = 0;

                }
                if ($postData['CLEANCODED_twitter_card'] != 2 && $postData['CLEANCODED_twitter_card'] != 0) {
                    $SocialShareTwitterCardValue = 1;
                }
                if ($postData['CLEANCODED_twitter_card'] != 1 && $postData['CLEANCODED_twitter_card'] != 0) {
                    $SocialShareTwitterCardValue = 2;
                }
            } else {
                //Set value 0 if checkbox is not checked
                $SocialShareTwitterCardValue = 0;
            }
            update_post_meta($post_id, 'CLEANCODED_show_on_page', $SocialShareShowOnPageValue);
            update_post_meta($post_id, 'CLEANCODED_twitter_card', $SocialShareTwitterCardValue);

        }

        /**
         * Create Admin Menu
         */
        public function adminMenu()
        {
            //Create plugin options page
            add_options_page(
                __('cleancoded SSB Settings', 'cleancoded-ssb'),
                __('SocialShare Settings', 'cleancoded-ssb'),
                'manage_options',
                'cleancoded-ssb',
                array($this, 'adminPluginOptionsPage')
            );
        }

        /**
         * Load cleancoded SSB settings page
         */
        public function adminPluginOptionsPage()
        {
                echo $this->_loadView('admin-settings-page');
        }
    }
}