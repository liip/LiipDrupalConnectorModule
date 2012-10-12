<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package    DrupalConnector
 * @subpackage User
 */

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Cumulates the user functions of Drupal 7 in one class.
 */
class User
{
    /**
     * Determine whether the user has a given privilege.
     *
     * @param string $string  The permission, such as "administer nodes", being checked for
     * @param null   $account [Optional] The account to check, if not given use currently logged in user.
     *
     * @return bool  »true« if the current user has the requested permission.
     */
    public function user_access($string, $account = null)
    {
        return user_access($string, $account);
    }

    /**
     * Try to validate the user's login credentials locally.
     *
     * @param string $name     Username to be used.
     * @param string $password Password to be used for authentication.
     *
     * @return integer|false The unique identifier of the user, else »false«.
     */
    public function user_authenticate($name, $password)
    {
        return user_authenticate($name, $password);
    }

    /**
     * Determines, if there is a difference between the given user and the set of roles provided.
     *
     * @param \stdClass $user  The user itś roles to be checked.
     * @param array     $roles The set of roles to be verified against.
     *
     * @return array Set of differences
     */
    public function user_compare_roles(stdClass $user, array $roles)
    {
        return array_intersect($user->roles, $roles);
    }

    /**
     * Permanently deletes the user data.
     *
     * @param integer $uid Identifier of the user to be pruged.
     */
    public function user_delete($uid)
    {
        user_delete($uid);
    }

    /**
     * Determines, if the user is already logged in.
     *
     * @return boolean »true«, if the user has already been authenticated, else »false«
     */
    public function user_is_logged_in()
    {
        return user_is_logged_in();
    }

    /**
     * Loads a user object.
     *
     * @param integer $uid   Numeric identifier of the user to be loaded.
     * @param boolean $reset If »true«, an internal cache will be purged before the user is loaded.
     *
     * @return \stdClass|false The fully loaded user, else false.
     */
    public function user_load($uid, $reset = false)
    {
        return user_load($user_info, $reset);
    }

    /**
     * Generate a random alphanumeric password.
     *
     * @param int $length Amount of characters the generated password shall have.
     *
     * @return string The generated password.
     */
    public function user_password($length = 10)
    {
        return user_password($length);
    }

    /**
     * Grant permissions to a user role.
     *
     * @param string $rid         Identifier of a user role to alter.
     * @param array  $permissions Set user_role_grant_permissions
     */
    public function user_role_grant_permissions($rid, array $permissions = array())
    {
        user_role_grant_permissions($rid, $permissions);
    }

    /**
     * Delete a user role from database.
     *
     * @param string|integer $role Identifier of the role to be deleted.
     */
    public function user_role_delete($role)
    {
        user_role_delete($role);
    }

    /**
     * Save a user role to the database.
     *
     * @param \stdClass $role A role object to modify or add.
     *
     * @return false|integer Status indicating if the action was successful.
     */
    public function user_role_save(\stdClass $role)
    {
        return user_role_save($role);
    }

    /**
     * Persists the given account to the storage container.
     *
     * @param \stdClass $account  The user to be stored.
     * @param array     $array    An array of fields and values to save
     * @param string    $category [Optional] The category for storing profile information in.
     *
     * @return \stdClass|false  A fully-loaded $user object upon successful save or FALSE if the save failed.
     */
    public function user_save(\stdClass $account, array $array = array(), $category = 'account')
    {
        return user_save($account, $array, $category);
    }
}
