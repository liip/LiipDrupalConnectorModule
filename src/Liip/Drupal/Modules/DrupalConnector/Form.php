<?php

    /**
     * Abstraction of the procedural Drupal world into OOP.
     *
     * @author     Bastian Feder <drupal@bastian-feder.de>
     * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
     * @copyright  Copyright (c) 2012-2013 liip ag
     *
     * @package    DrupalConnector
     * @subpackage Form
     */

namespace Liip\Drupal\Modules\DrupalConnector;


class Form
{
    /**
     * Returns a renderable form array for a given form ID.
     *
     * This function should be used instead of drupal_build_form() when $form_state
     * is not needed (i.e., when initially rendering the form) and is often
     * used as a menu callback.
     *
     * @param $form_id
     *   The unique string identifying the desired form. If a function with that
     *   name exists, it is called to build the form array. Modules that need to
     *   generate the same form (or very similar forms) using different $form_ids
     *   can implement hook_forms(), which maps different $form_id values to the
     *   proper form constructor function. Examples may be found in node_forms(),
     *   and search_forms().
     * @param ...
     *   Any additional arguments are passed on to the functions called by
     *   drupal_get_form(), including the unique form constructor function. For
     *   example, the node_edit form requires that a node object is passed in here
     *   when it is called. These are available to implementations of
     *   hook_form_alter() and hook_form_FORM_ID_alter() as the array
     *   $form_state['build_info']['args'].
     *
     * @return
     *   The form array.
     *
     * @see drupal_build_form()
     */
    public function drupal_get_form($form_id)
    {
        return call_user_func_array('drupal_get_form', func_get_args());
    }

    /**
     * Files an error against a form element.
     *
     * When a validation error is detected, the validator calls form_set_error() to
     * indicate which element needs to be changed and provide an error message. This
     * causes the Form API to not execute the form submit handlers, and instead to
     * re-display the form to the user with the corresponding elements rendered with
     * an 'error' CSS class (shown as red by default).
     *
     * The standard form_set_error() behavior can be changed if a button provides
     * the #limit_validation_errors property. Multistep forms not wanting to
     * validate the whole form can set #limit_validation_errors on buttons to
     * limit validation errors to only certain elements. For example, pressing the
     * "Previous" button in a multistep form should not fire validation errors just
     * because the current step has invalid values. If #limit_validation_errors is
     * set on a clicked button, the button must also define a #submit property
     * (may be set to an empty array). Any #submit handlers will be executed even if
     * there is invalid input, so extreme care should be taken with respect to any
     * actions taken by them. This is typically not a problem with buttons like
     * "Previous" or "Add more" that do not invoke persistent storage of the
     * submitted form values. Do not use the #limit_validation_errors property on
     * buttons that trigger saving of form values to the database.
     *
     * The #limit_validation_errors property is a list of "sections" within
     * $form_state['values'] that must contain valid values. Each "section" is an
     * array with the ordered set of keys needed to reach that part of
     * $form_state['values'] (i.e., the #parents property of the element).
     *
     * Example 1: Allow the "Previous" button to function, regardless of whether any
     * user input is valid.
     *
     * @code
     *   $form['actions']['previous'] = array(
     *     '#type' => 'submit',
     *     '#value' => t('Previous'),
     *     '#limit_validation_errors' => array(),       // No validation.
     *     '#submit' => array('some_submit_function'),  // #submit required.
     *   );
     * @endcode
     *
     * Example 2: Require some, but not all, user input to be valid to process the
     * submission of a "Previous" button.
     *
     * @code
     *   $form['actions']['previous'] = array(
     *     '#type' => 'submit',
     *     '#value' => t('Previous'),
     *     '#limit_validation_errors' => array(
     *       array('step1'),       // Validate $form_state['values']['step1'].
     *       array('foo', 'bar'),  // Validate $form_state['values']['foo']['bar'].
     *     ),
     *     '#submit' => array('some_submit_function'), // #submit required.
     *   );
     * @endcode
     *
     * This will require $form_state['values']['step1'] and everything within it
     * (for example, $form_state['values']['step1']['choice']) to be valid, so
     * calls to form_set_error('step1', $message) or
     * form_set_error('step1][choice', $message) will prevent the submit handlers
     * from running, and result in the error message being displayed to the user.
     * However, calls to form_set_error('step2', $message) and
     * form_set_error('step2][groupX][choiceY', $message) will be suppressed,
     * resulting in the message not being displayed to the user, and the submit
     * handlers will run despite $form_state['values']['step2'] and
     * $form_state['values']['step2']['groupX']['choiceY'] containing invalid
     * values. Errors for an invalid $form_state['values']['foo'] will be
     * suppressed, but errors flagging invalid values for
     * $form_state['values']['foo']['bar'] and everything within it will be
     * flagged and submission prevented.
     *
     * Partial form validation is implemented by suppressing errors rather than by
     * skipping the input processing and validation steps entirely, because some
     * forms have button-level submit handlers that call Drupal API functions that
     * assume that certain data exists within $form_state['values'], and while not
     * doing anything with that data that requires it to be valid, PHP errors
     * would be triggered if the input processing and validation steps were fully
     * skipped.
     *
     * @param $name
     *   The name of the form element. If the #parents property of your form
     *   element is array('foo', 'bar', 'baz') then you may set an error on 'foo'
     *   or 'foo][bar][baz'. Setting an error on 'foo' sets an error for every
     *   element where the #parents array starts with 'foo'.
     * @param $message
     *   The error message to present to the user.
     * @param $limit_validation_errors
     *   Internal use only. The #limit_validation_errors property of the clicked
     *   button, if it exists.
     *
     * @return
     *   Return value is for internal use only. To get a list of errors, use
     *   form_get_errors() or form_get_error().
     *
     * @see http://drupal.org/node/370537
     * @see http://drupal.org/node/763376
     */
    public function form_set_error($name = NULL, $message = '', $limit_validation_errors = NULL)
    {
        return form_set_error($name, $message, $limit_validation_errors);
    }

    /**
     * Clears all errors against all form elements made by form_set_error().
     */
    public function form_clear_error() {
        form_clear_error();
    }

    /**
     * Returns an associative array of all errors.
     *
     * @return array
     */
    public function form_get_errors() {
        return form_get_errors();
    }

    /**
     * Returns the error message filed against the given form element.
     * Form errors higher up in the form structure override deeper errors as well as
     * errors on the element itself.
     *
     * @param array $element
     *
     * @return string
     */
    function form_get_error(array $element) {
        return form_get_error($element);
    }

    /**
     * Changes submitted form values during form validation.
     *
     * @param array $element
     * @param mixed $value
     * @param array $form_atate
     */
    function form_set_value(array $element, $value, array &$form_atate)
    {
        form_set_value($element, $value, $form_atate);
    }
}
