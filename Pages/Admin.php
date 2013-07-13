<?php

    /**
     * Plugin administration
     */

    namespace IdnoPlugins\Twitter\Pages {

        /**
         * Default class to serve the homepage
         */
        class Admin extends \Idno\Common\Page
        {

            function getContent()
            {
                $this->adminGatekeeper(); // Admins only
                $t = \Idno\Core\site()->template();
                $body = $t->draw('admin/twitter');
                $t->__(['title' => 'Twitter', 'body' => $body])->drawPage();
            }

            function postContent() {
                $this->adminGatekeeper(); // Admins only
                $consumer_key = $this->getInput('consumer_key');
                $consumer_secret = $this->getInput('consumer_secret');
                \Idno\Core\site()->config->config['twitter'] = [
                    'consumer_key' => $consumer_key,
                    'consumer_secret' => $consumer_secret
                ];
                \Idno\Core\site()->config()->save();
                \Idno\Core\site()->session()->addMessage('Your Twitter application details were saved.');
                $this->forward('/admin/twitter/');
            }

        }

    }