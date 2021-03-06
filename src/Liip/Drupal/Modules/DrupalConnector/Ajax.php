<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012-2013 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Theme
 */

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Cumulates the ajax functions of Drupal 7 in one class.
 */
class Ajax
{
    /**
     * Renders a commands array into JSON.
     *
     * @param $commands
     *   A list of macro commands generated by the use of ajax_command_*()
     *   functions.
     */
    public function ajax_render($commands = array())
    {
        return ajax_render($commands);
    }

    /**
     * Gets a form submitted via #ajax during an Ajax callback.
     *
     * This will load a form from the form cache used during Ajax operations. It
     * pulls the form info from $_POST.
     *
     * @return
     *   An array containing the $form and $form_state. Use the list() function
     *   to break these apart:
     *   @code
     *     list($form, $form_state, $form_id, $form_build_id) = ajax_get_form();
     *   @endcode
     */
    public function ajax_get_form()
    {
        return ajax_get_form();
    }

    /**
     * Menu callback; handles Ajax requests for the #ajax Form API property.
     *
     * This rebuilds the form from cache and invokes the defined #ajax['callback']
     * to return an Ajax command structure for JavaScript. In case no 'callback' has
     * been defined, nothing will happen.
     *
     * The Form API #ajax property can be set both for buttons and other input
     * elements.
     *
     * This function is also the canonical example of how to implement
     * #ajax['path']. If processing is required that cannot be accomplished with
     * a callback, re-implement this function and set #ajax['path'] to the
     * enhanced function.
     *
     * @see system_menu()
     */
    public function ajax_form_callback()
    {
        return ajax_form_callback();
    }

    /**
     * Theme callback for Ajax requests.
     *
     * Many different pages can invoke an Ajax request to system/ajax or another
     * generic Ajax path. It is almost always desired for an Ajax response to be
     * rendered using the same theme as the base page, because most themes are built
     * with the assumption that they control the entire page, so if the CSS for two
     * themes are both loaded for a given page, they may conflict with each other.
     * For example, Bartik is Drupal's default theme, and Seven is Drupal's default
     * administration theme. Depending on whether the "Use the administration theme
     * when editing or creating content" checkbox is checked, the node edit form may
     * be displayed in either theme, but the Ajax response to the Field module's
     * "Add another item" button should be rendered using the same theme as the rest
     * of the page. Therefore, system_menu() sets the 'theme callback' for
     * 'system/ajax' to this function, and it is recommended that modules
     * implementing other generic Ajax paths do the same.
     *
     * @see system_menu()
     * @see file_menu()
     */
    public function ajax_base_page_theme()
    {
        return ajax_base_page_theme();
    }

    /**
     * Packages and sends the result of a page callback as an Ajax response.
     *
     * This function is the equivalent of drupal_deliver_html_page(), but for Ajax
     * requests. Like that function, it:
     * - Adds needed HTTP headers.
     * - Prints rendered output.
     * - Performs end-of-request tasks.
     *
     * @param $page_callback_result
     *   The result of a page callback. Can be one of:
     *   - NULL: to indicate no content.
     *   - An integer menu status constant: to indicate an error condition.
     *   - A string of HTML content.
     *   - A renderable array of content.
     *
     * @see drupal_deliver_html_page()
     */
    public function ajax_deliver($page_callback_result)
    {
        return ajax_deliver($page_callback_result);
    }

    /**
     * Converts the return value of a page callback into an Ajax commands array.
     *
     * @param $page_callback_result
     *   The result of a page callback. Can be one of:
     *   - NULL: to indicate no content.
     *   - An integer menu status constant: to indicate an error condition.
     *   - A string of HTML content.
     *   - A renderable array of content.
     *
     * @return
     *   An Ajax commands array that can be passed to ajax_render().
     */
    public function ajax_prepare_response($page_callback_result)
    {
        return ajax_prepare_response($page_callback_result);
    }

    /**
     * Performs end-of-Ajax-request tasks.
     *
     * This function is the equivalent of drupal_page_footer(), but for Ajax
     * requests.
     *
     * @see drupal_page_footer()
     */
    public function ajax_footer()
    {
        return ajax_footer();
    }

    /**
     * Form element processing handler for the #ajax form property.
     *
     * @param $element
     *   An associative array containing the properties of the element.
     *
     * @return
     *   The processed element.
     *
     * @see ajax_pre_render_element()
     */
    public function ajax_process_form($element, &$form_state)
    {
        return ajax_process_form($element, $form_state);
    }

    /**
     * Adds Ajax information about an element to communicate with JavaScript.
     *
     * If #ajax['path'] is set on an element, this additional JavaScript is added
     * to the page header to attach the Ajax behaviors. See ajax.js for more
     * information.
     *
     * @param $element
     *   An associative array containing the properties of the element.
     *   Properties used:
     *   - #ajax['event']
     *   - #ajax['prevent']
     *   - #ajax['path']
     *   - #ajax['options']
     *   - #ajax['wrapper']
     *   - #ajax['parameters']
     *   - #ajax['effect']
     *
     * @return
     *   The processed element with the necessary JavaScript attached to it.
     */
    public function ajax_pre_render_element($element)
    {
        return ajax_pre_render_element($element);
    }

    /**
     * @} End of "defgroup ajax".
     */

    /**
     * @defgroup ajax_commands Ajax framework commands
     * @{
     * Functions to create various Ajax commands.
     *
     * These functions can be used to create arrays for use with the
     * ajax_render() function.
     */

    /**
     * Creates a Drupal Ajax 'alert' command.
     *
     * The 'alert' command instructs the client to display a JavaScript alert
     * dialog box.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.alert()
     * defined in misc/ajax.js.
     *
     * @param $text
     *   The message string to display to the user.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     */
    public function ajax_command_alert($text)
    {
        return ajax_command_alert($text);
    }

    /**
     * Creates a Drupal Ajax 'insert' command using the method in #ajax['method'].
     *
     * This command instructs the client to insert the given HTML using whichever
     * jQuery DOM manipulation method has been specified in the #ajax['method']
     * variable of the element that triggered the request.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.insert()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $html
     *   The data to use with the jQuery method.
     * @param $settings
     *   An optional array of settings that will be used for this command only.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     */
    public function ajax_command_insert($selector, $html, $settings = NULL)
    {
        return ajax_command_insert($selector, $html, $settings);
    }

    /**
     * Creates a Drupal Ajax 'insert/replaceWith' command.
     *
     * The 'insert/replaceWith' command instructs the client to use jQuery's
     * replaceWith() method to replace each element matched matched by the given
     * selector with the given HTML.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.insert()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $html
     *   The data to use with the jQuery replaceWith() method.
     * @param $settings
     *   An optional array of settings that will be used for this command only.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * See
     * @link http://docs.jquery.com/Manipulation/replaceWith#content jQuery replaceWith command @endlink
     */
    public function ajax_command_replace($selector, $html, $settings = NULL)
    {
        return ajax_command_replace($selector, $html, $settings);
    }

    /**
     * Creates a Drupal Ajax 'insert/html' command.
     *
     * The 'insert/html' command instructs the client to use jQuery's html()
     * method to set the HTML content of each element matched by the given
     * selector while leaving the outer tags intact.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.insert()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $html
     *   The data to use with the jQuery html() method.
     * @param $settings
     *   An optional array of settings that will be used for this command only.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * @see http://docs.jquery.com/Attributes/html#val
     */
    public function ajax_command_html($selector, $html, $settings = NULL)
    {
        return ajax_command_html($selector, $html, $settings);
    }

    /**
     * Creates a Drupal Ajax 'insert/prepend' command.
     *
     * The 'insert/prepend' command instructs the client to use jQuery's prepend()
     * method to prepend the given HTML content to the inside each element matched
     * by the given selector.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.insert()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $html
     *   The data to use with the jQuery prepend() method.
     * @param $settings
     *   An optional array of settings that will be used for this command only.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * @see http://docs.jquery.com/Manipulation/prepend#content
     */
    public function ajax_command_prepend($selector, $html, $settings = NULL)
    {
        return ajax_command_prepend($selector, $html, $settings);
    }

    /**
     * Creates a Drupal Ajax 'insert/append' command.
     *
     * The 'insert/append' command instructs the client to use jQuery's append()
     * method to append the given HTML content to the inside of each element matched
     * by the given selector.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.insert()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $html
     *   The data to use with the jQuery append() method.
     * @param $settings
     *   An optional array of settings that will be used for this command only.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * @see http://docs.jquery.com/Manipulation/append#content
     */
    public function ajax_command_append($selector, $html, $settings = NULL)
    {
        return ajax_command_append($selector, $html, $settings);
    }

    /**
     * Creates a Drupal Ajax 'insert/after' command.
     *
     * The 'insert/after' command instructs the client to use jQuery's after()
     * method to insert the given HTML content after each element matched by
     * the given selector.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.insert()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $html
     *   The data to use with the jQuery after() method.
     * @param $settings
     *   An optional array of settings that will be used for this command only.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * @see http://docs.jquery.com/Manipulation/after#content
     */
    public function ajax_command_after($selector, $html, $settings = NULL)
    {
        return ajax_command_after($selector, $html, $settings);
    }

    /**
     * Creates a Drupal Ajax 'insert/before' command.
     *
     * The 'insert/before' command instructs the client to use jQuery's before()
     * method to insert the given HTML content before each of elements matched by
     * the given selector.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.insert()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $html
     *   The data to use with the jQuery before() method.
     * @param $settings
     *   An optional array of settings that will be used for this command only.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * @see http://docs.jquery.com/Manipulation/before#content
     */
    public function ajax_command_before($selector, $html, $settings = NULL)
    {
        return ajax_command_before($selector, $html, $settings);
    }

    /**
     * Creates a Drupal Ajax 'remove' command.
     *
     * The 'remove' command instructs the client to use jQuery's remove() method
     * to remove each of elements matched by the given selector, and everything
     * within them.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.remove()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * @see http://docs.jquery.com/Manipulation/remove#expr
     */
    public function ajax_command_remove($selector)
    {
        return ajax_command_remove($selector);
    }

    /**
     * Creates a Drupal Ajax 'changed' command.
     *
     * This command instructs the client to mark each of the elements matched by the
     * given selector as 'ajax-changed'.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.changed()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $asterisk
     *   An optional CSS selector which must be inside $selector. If specified,
     *   an asterisk will be appended to the HTML inside the $asterisk selector.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     */
    public function ajax_command_changed($selector, $asterisk = '')
    {
        return ajax_command_changed($selector, $asterisk);
    }

    /**
     * Creates a Drupal Ajax 'css' command.
     *
     * The 'css' command will instruct the client to use the jQuery css() method
     * to apply the CSS arguments to elements matched by the given selector.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.css()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $argument
     *   An array of key/value pairs to set in the CSS for the selector.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * @see http://docs.jquery.com/CSS/css#properties
     */
    public function ajax_command_css($selector, $argument)
    {
        return ajax_command_css($selector, $argument);
    }

    /**
     * Creates a Drupal Ajax 'settings' command.
     *
     * The 'settings' command instructs the client either to use the given array as
     * the settings for ajax-loaded content or to extend Drupal.settings with the
     * given array, depending on the value of the $merge parameter.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.settings()
     * defined in misc/ajax.js.
     *
     * @param $argument
     *   An array of key/value pairs to add to the settings. This will be utilized
     *   for all commands after this if they do not include their own settings
     *   array.
     * @param $merge
     *   Whether or not the passed settings in $argument should be merged into the
     *   global Drupal.settings on the page. By default (FALSE), the settings that
     *   are passed to Drupal.attachBehaviors will not include the global
     *   Drupal.settings.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     */
    public function ajax_command_settings($argument, $merge = FALSE)
    {
        return ajax_command_settings($argument, $merge);
    }

    /**
     * Creates a Drupal Ajax 'data' command.
     *
     * The 'data' command instructs the client to attach the name=value pair of
     * data to the selector via jQuery's data cache.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.data()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $name
     *   The name or key (in the key value pair) of the data attached to this
     *   selector.
     * @param $value
     *   The value of the data. Not just limited to strings can be any format.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     *
     * @see http://docs.jquery.com/Core/data#namevalue
     */
    public function ajax_command_data($selector, $name, $value)
    {
        return ajax_command_data($selector, $name, $value);
    }

    /**
     * Creates a Drupal Ajax 'invoke' command.
     *
     * The 'invoke' command will instruct the client to invoke the given jQuery
     * method with the supplied arguments on the elements matched by the given
     * selector. Intended for simple jQuery commands, such as attr(), addClass(),
     * removeClass(), toggleClass(), etc.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.invoke()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string. If the command is a response to a request from
     *   an #ajax form element then this value can be NULL.
     * @param $method
     *   The jQuery method to invoke.
     * @param $arguments
     *   (optional) A list of arguments to the jQuery $method, if any.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     */
    public function ajax_command_invoke($selector, $method, array $arguments = array())
    {
        return ajax_command_invoke($selector, $method, $arguments);
    }

    /**
     * Creates a Drupal Ajax 'restripe' command.
     *
     * The 'restripe' command instructs the client to restripe a table. This is
     * usually used after a table has been modified by a replace or append command.
     *
     * This command is implemented by Drupal.ajax.prototype.commands.restripe()
     * defined in misc/ajax.js.
     *
     * @param $selector
     *   A jQuery selector string.
     *
     * @return
     *   An array suitable for use with the ajax_render() function.
     */
    public function ajax_command_restripe($selector)
    {
        return ajax_command_restripe($selector);
    }
}
