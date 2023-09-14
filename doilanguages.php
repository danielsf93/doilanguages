<?php

import('lib.pkp.classes.plugins.GenericPlugin');

class doilanguages extends GenericPlugin
{
    public function register($category, $path, $mainContextId = null)
    {
        $success = parent::register($category, $path);
        if ($success && $this->getEnabled()) {
            //hooky da página de artigos
            HookRegistry::register('TemplateResource::getFilename', [$this, '_overridePluginTemplates']);
        }

        return $success;
    }

    public function _overridePluginTemplates($hookName, $args)
    {
        $templatePath = $args[0];
        if ($templatePath === 'templates/frontend/objects/article_details.tpl') {
            $args[0] = 'plugins/generic/doilanguages/templates/frontend/objects/article_details.tpl';
        }

        return false;
    }

    /**
     * Provide a name for this plugin.
     *
     * The name will appear in the plugins list where editors can
     * enable and disable plugins.
     */
    public function getDisplayName()
    {
        return __('doilanguages');
    }

    /**
     * Provide a description for this plugin.
     *
     * The description will appear in the plugins list where editors can
     * enable and disable plugins.
     */
    public function getDescription()
    {
        return __('doilanguages');
    }

    /**
     * Get the name of the settings file to be installed on new context
     * creation.
     *
     * @return string
     */
    public function getContextSpecificPluginSettingsFile()
    {
        return $this->getPluginPath().'/settings.xml';
    }
}
