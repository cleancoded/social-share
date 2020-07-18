<?php

if (!class_exists('CleancodedSSSetup')) {
    class CleancodedSSSetup
    {
        /**
         * Setup cleancoded SSB plugin on plugin activation
         */
        public function SocialShareActivate()
        {
            //Check if plugin is not cativated previously
            if (!get_option('CLEANCODED_display_auto')) {

                //Set auto display share buttons after post/page content
                update_option('CLEANCODED_display_auto', true);
            }
        }

    }

}