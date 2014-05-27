<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 * @package    DrupalConnector
 * @subpackage User
 */

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Cumulates the user functions of Drupal 7 in one class.
 * Please order the functions alphabetically!
 */
class User
{
    /**
     * Determine whether the user has a given privilege.
     *
     * @param string $string The permission, such as "administer nodes", being checked for
     * @param null $account [Optional] The account to check, if not given use currently logged in user.
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
     * @param string $name Username to be used.
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
     * @param \stdClass $user The user itś roles to be checked.
     * @param array $roles The set of roles to be verified against.
     *
     * @return array Set of differences
     */
    public function user_compare_roles(\stdClass $user, array $roles)
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
     * @return boolean »true«, if the user has already been authenticated, else »false«
     */
    public function user_is_logged_in()
    {
        return user_is_logged_in();
    }

    /**
     * Loads a user object.
     *
     * @param integer $uid Numeric identifier of the user to be loaded.
     * @param boolean $reset If »true«, an internal cache will be purged before the user is loaded.
     *
     * @return \stdClass|false The fully loaded user, else false.
     */
    public function user_load($uid, $reset = false)
    {
        return user_load($uid, $reset);
    }

    /**
     * Fetch a user object by email address.
     *
     * @param string $mail String with the account's e-mail address.
     *
     * @return \srdClass|FALSE
     *   A fully-loaded $user object upon successful user load or FALSE if user
     *   cannot be loaded.
     * @see user_load_multiple()
     */
    function user_load_by_mail($mail)
    {
        return user_load_by_mail($mail);
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
     * Retrieve an array of roles matching specified conditions.
     *
     * @param boolean $membersonly
     *   Set this to TRUE to exclude the 'anonymous' role.
     * @param string $permission
     *   A string containing a permission. If set, only roles containing that
     *   permission are returned.
     *
     * @return array
     *   An associative array with the role id as the key and the role name as
     *   value.
     */
    public function user_roles($membersonly = false, $permission = null)
    {
        return user_roles($membersonly, $permission);
    }

    /**
     * Grant permissions to a user role.
     *
     * @param string $rid Identifier of a user role to alter.
     * @param array $permissions Set user_role_grant_permissions
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
     * Fetches a user role by role name.
     *
     * @param string $roleName
     *   A string representing the role name.
     *
     * @return \stdClass|false
     *   A fully-loaded role object if a role with the given name exists, or FALSE
     *   otherwise.
     * @see user_role_load()
     */
    public function user_role_load_by_name($roleName)
    {
        return user_role_load_by_name($roleName);
    }

    /**
     * Determine the permissions for one or more roles.
     *
     * @param array $roles
     *   An array whose keys are the role IDs of interest, such as $user->roles.
     *
     * @return array
     *   An array indexed by role ID. Each value is an array whose keys are the
     *   permission strings for the given role ID.
     */
    public function user_role_permissions(array $roles = array())
    {
        return user_role_permissions($roles);
    }

    /**
     * Revoke permissions from a user role.
     *
     * @param integer $rid
     *   The ID of a user role to alter.
     * @param array $permissions
     *   A list of permission names to revoke.
     *
     * @see user_role_change_permissions()
     * @see user_role_grant_permissions()
     */
    public function user_role_revoke_permissions($rid, array $permissions = array())
    {
        user_role_revoke_permissions($rid, $permissions);
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
     * @param \stdClass $account The user to be stored.
     * @param array $array An array of fields and values to save
     * @param string $category [Optional] The category for storing profile information in.
     *
     * @return \stdClass|false  A fully-loaded $user object upon successful save or FALSE if the save failed.
     * @throws \Exception in case of an error
     */
    public function user_save(\stdClass $account, array $array = array(), $category = 'account')
    {
        return user_save($account, $array, $category);
    }

    /**
     * Return the global user object
     * TODO: this does not wrap a function of the user module, find out if this function belongs here.
     * @return \stdClass
     */
    public function current_user()
    {
        global $user;

        return $user;
    }
    
    /**
     * Override the global user.
     */
    public function set_current_user($new_user)
    {
        global $user;
        
        $user = $new_user;
    }
}
