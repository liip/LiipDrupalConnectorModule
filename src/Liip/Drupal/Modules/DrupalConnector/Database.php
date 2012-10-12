<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package DrupalConnector
 * @subpackage Database
 */

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Cumulates the database functions of Drupal 7 in one class.
 */
class Database
{
    /**
     * Adds a new field to a table.
     *
     * @param $table
     *   Name of the table to be altered.
     * @param $field
     *   Name of the field to be added.
     * @param $spec
     *   The field specification array, as taken from a schema definition. The
     *   specification may also contain the key 'initial'; the newly-created field
     *   will be set to the value of the key in all rows. This is most useful for
     *   creating NOT NULL columns with no default value in existing tables.
     * @param $keys_new
     *   Optional keys and indexes specification to be created on the table along
     *   with adding the field. The format is the same as a table specification, but
     *   without the 'fields' element. If you are adding a type 'serial' field, you
     *   MUST specify at least one key or index including it in this array. See
     *   db_change_field() for more explanation why.
     *
     * @see db_change_field()
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_add_field/7
     */
    function db_add_field($table, $field, $spec, $keys_new = array()) {
        db_add_field($table, $field, $spec, $keys_new);
    }

    /**
     * Adds an index.
     *
     * @param $table
     *   The table to be altered.
     * @param $name
     *   The name of the index.
     * @param $fields
     *   An array of field names.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_add_index/7
     */
    function db_add_index($table, $name, $fields) {
        return db_add_index($table, $name, $fields);
    }

    /**
     * Adds a primary key to a database table.
     *
     * @param $table
     *   Name of the table to be altered.
     * @param $fields
     *   Array of fields for the primary key.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_add_primary_key/7
     */
    function db_add_primary_key($table, $fields) {
        return db_add_primary_key($table, $fields);
    }

    /**
     * Adds a unique key.
     *
     * @param $table
     *   The table to be altered.
     * @param $name
     *   The name of the key.
     * @param $fields
     *   An array of field names.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_add_unique_key/7
     */
    function db_add_unique_key($table, $name, $fields) {
        return db_add_unique_key($table, $name, $fields);
    }

    /**
     * Returns a new DatabaseCondition, set to "AND" all conditions together.
     *
     * @return DatabaseCondition
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_and/7
     */
    function db_and() {
        return db_and();
    }

    /**
     * Changes a field definition.
     *
     * IMPORTANT NOTE: To maintain database portability, you have to explicitly
     * recreate all indices and primary keys that are using the changed field.
     *
     * That means that you have to drop all affected keys and indexes with
     * db_drop_{primary_key,unique_key,index}() before calling db_change_field().
     * To recreate the keys and indices, pass the key definitions as the optional
     * $keys_new argument directly to db_change_field().
     *
     * For example, suppose you have:
     * @code
     * $schema['foo'] = array(
     *   'fields' => array(
     *     'bar' => array('type' => 'int', 'not null' => TRUE)
     *   ),
     *   'primary key' => array('bar')
     * );
     * @endcode
     * and you want to change foo.bar to be type serial, leaving it as the primary
     * key. The correct sequence is:
     * @code
     * db_drop_primary_key('foo');
     * db_change_field('foo', 'bar', 'bar',
     *   array('type' => 'serial', 'not null' => TRUE),
     *   array('primary key' => array('bar')));
     * @endcode
     *
     * The reasons for this are due to the different database engines:
     *
     * On PostgreSQL, changing a field definition involves adding a new field and
     * dropping an old one which causes any indices, primary keys and sequences
     * (from serial-type fields) that use the changed field to be dropped.
     *
     * On MySQL, all type 'serial' fields must be part of at least one key or index
     * as soon as they are created. You cannot use
     * db_add_{primary_key,unique_key,index}() for this purpose because the ALTER
     * TABLE command will fail to add the column without a key or index
     * specification. The solution is to use the optional $keys_new argument to
     * create the key or index at the same time as field.
     *
     * You could use db_add_{primary_key,unique_key,index}() in all cases unless you
     * are converting a field to be type serial. You can use the $keys_new argument
     * in all cases.
     *
     * @param $table
     *   Name of the table.
     * @param $field
     *   Name of the field to change.
     * @param $field_new
     *   New name for the field (set to the same as $field if you don't want to
     *   change the name).
     * @param $spec
     *   The field specification for the new field.
     * @param $keys_new
     *   Optional keys and indexes specification to be created on the table along
     *   with changing the field. The format is the same as a table specification
     *   but without the 'fields' element.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_change_field/7
     */
    function db_change_field($table, $field, $field_new, $spec, $keys_new = array()) {
        return db_change_field($table, $field, $field_new, $spec, $keys_new);
    }

    /**
     * Closes the active database connection.
     *
     * @param $options
     *   An array of options to control which connection is closed. Only the target
     *   key has any meaning in this case.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_close/7
     */
    function db_close(array $options = array()) {
        db_close($options);
    }

    /**
     * Returns a new DatabaseCondition, set to the specified conjunction.
     *
     * Internal API function call.  The db_and(), db_or(), and db_xor()
     * functions are preferred.
     *
     * @param $conjunction
     *   The conjunction to use for query conditions (AND, OR or XOR).
     * @return DatabaseCondition
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_condition/7
     */
    function db_condition($conjunction) {
        return db_condition($conjunction);
    }

    /**
     * Creates a new table from a Drupal table definition.
     *
     * @param $name
     *   The name of the table to create.
     * @param $table
     *   A Schema API table definition array.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_create_table/7
     */
    function db_create_table($name, $table) {
        return db_create_table($name, $table);
    }

    /**
     * Returns a new DeleteQuery object for the active database.
     *
     * @param $table
     *   The table from which to delete.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return DeleteQuery
     *   A new DeleteQuery object for this connection.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_delete/7
     */
    function db_delete($table, array $options = array()) {
        return db_delete($table, $options);
    }

    /**
     * Retrieves the name of the currently active database driver.
     *
     * @return
     *   The name of the currently active database driver.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_driver/7
     */
    function db_driver() {
        return db_driver();
    }

    /**
     * Drops a field.
     *
     * @param $table
     *   The table to be altered.
     * @param $field
     *   The field to be dropped.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_drop_field/7
     */
    function db_drop_field($table, $field) {
        db_drop_field($table, $field);
    }

    /**
     * Drops an index.
     *
     * @param $table
     *   The table to be altered.
     * @param $name
     *   The name of the index.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_drop_index/7
     */
    function db_drop_index($table, $name) {
        return db_drop_index($table, $name);
    }

    /**
     * Drops the primary key of a database table.
     *
     * @param $table
     *   Name of the table to be altered.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_drop_primary_key/7
     */
    function db_drop_primary_key($table) {
        return db_drop_primary_key($table);
    }

    /**
     * Drops a table.
     *
     * @param $table
     *   The table to be dropped.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_drop_table/7
     */
    function db_drop_table($table) {
        db_drop_table($table);
    }

    /**
     * Drops a unique key.
     *
     * @param $table
     *   The table to be altered.
     * @param $name
     *   The name of the key.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_drop_unique_key/7
     */
    function db_drop_unique_key($table, $name) {
        return db_drop_unique_key($table, $name);
    }

    /**
     * Restricts a dynamic column or constraint name to safe characters.
     *
     * Only keeps alphanumeric and underscores.
     *
     * @param $field
     *   The field name to escape.
     *
     * @return
     *   The escaped field name as a string.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_escape_field/7
     */
    function db_escape_field($field) {
        return db_escape_field($field);
    }

    /**
     * Restricts a dynamic table name to safe characters.
     *
     * Only keeps alphanumeric and underscores.
     *
     * @param $table
     *   The table name to escape.
     *
     * @return
     *   The escaped table name as a string.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_escape_table/7
     */
    function db_escape_table($table) {
        return db_escape_table($table);
    }

    /**
     * Checks if a column exists in the given table.
     *
     * @param $table
     *   The name of the table in drupal (no prefixing).
     * @param $field
     *   The name of the field.
     *
     * @return
     *   TRUE if the given column exists, otherwise FALSE.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_field_exists/7
     */
    function db_field_exists($table, $field) {
        return db_field_exists($table, $field);
    }

    /**
     * Returns an array of field names from an array of key/index column specifiers.
     *
     * This is usually an identity function but if a key/index uses a column prefix
     * specification, this function extracts just the name.
     *
     * @param $fields
     *   An array of key/index column specifiers.
     *
     * @return
     *   An array of field names.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_field_names/7
     */
    function db_field_names($fields) {
        return db_field_names($fields);
    }

    /**
     * Sets the default value for a field.
     *
     * @param $table
     *   The table to be altered.
     * @param $field
     *   The field to be altered.
     * @param $default
     *   Default value to be set. NULL for 'default NULL'.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_field_set_default/7
     */
    function db_field_set_default($table, $field, $default) {
        return db_field_set_default($table, $field, $default);
    }

    /**
     * Sets a field to have no default value.
     *
     * @param $table
     *   The table to be altered.
     * @param $field
     *   The field to be altered.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_field_set_no_default/7
     */
    function db_field_set_no_default($table, $field) {
        return db_field_set_no_default($table, $field);
    }

    /**
     * Finds all tables that are like the specified base table name.
     *
     * @param $table_expression
     *   An SQL expression, for example "simpletest%" (without the quotes).
     *   BEWARE: this is not prefixed, the caller should take care of that.
     *
     * @return
     *   Array, both the keys and the values are the matching tables.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_find_tables/7
     */
    function db_find_tables($table_expression) {
        return db_find_tables($table_expression);
    }

    /**
     * Sets a session variable specifying the lag time for ignoring a slave server.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_ignore_slave/7
     */
    function db_ignore_slave() {
        db_ignore_slave();
    }

    /**
     * Checks if an index exists in the given table.
     *
     * @param $table
     *   The name of the table in drupal (no prefixing).
     * @param $name
     *   The name of the index in drupal (no prefixing).
     *
     * @return
     *   TRUE if the given index exists, otherwise FALSE.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_index_exists/7
     */
    function db_index_exists($table, $name) {
        return db_index_exists($table, $name);
    }

    /**
     * Returns a new InsertQuery object for the active database.
     *
     * @param $table
     *   The table into which to insert.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return InsertQuery
     *   A new InsertQuery object for this connection.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_insert/7
     */
    function db_insert($table, array $options = array()) {
        return db_insert($table, $options);
    }

    /**
     * Escapes characters that work as wildcard characters in a LIKE pattern.
     *
     * The wildcard characters "%" and "_" as well as backslash are prefixed with
     * a backslash. Use this to do a search for a verbatim string without any
     * wildcard behavior.
     *
     * For example, the following does a case-insensitive query for all rows whose
     * name starts with $prefix:
     * @code
     * $result = db_query(
     *   'SELECT * FROM person WHERE name LIKE :pattern',
     *   array(':pattern' => db_like($prefix) . '%')
     * );
     * @endcode
     *
     * Backslash is defined as escape character for LIKE patterns in
     * DatabaseCondition::mapConditionOperator().
     *
     * @param $string
     *   The string to escape.
     *
     * @return
     *   The escaped string.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_like/7
     */
    function db_like($string) {
        return db_like($string);
    }

    /**
     * Returns a new MergeQuery object for the active database.
     *
     * @param $table
     *   The table into which to merge.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return MergeQuery
     *   A new MergeQuery object for this connection.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_merge/7
     */
    function db_merge($table, array $options = array()) {
        return db_merge($table, $options);
    }

    /**
     * Retrieves a unique id.
     *
     * Use this function if for some reason you can't use a serial field. Using a
     * serial field is preferred, and InsertQuery::execute() returns the value of
     * the last ID inserted.
     *
     * @param $existing_id
     *   After a database import, it might be that the sequences table is behind, so
     *   by passing in a minimum ID, it can be assured that we never issue the same
     *   ID.
     *
     * @return
     *   An integer number larger than any number returned before for this sequence.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_next_id/7
     */
    function db_next_id($existing_id = 0) {
        return db_next_id($existing_id);
    }

    /**
     * Returns a new DatabaseCondition, set to "OR" all conditions together.
     *
     * @return DatabaseCondition
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_or/7
     */
    function db_or() {
        return db_or();
    }

    /**
     * Executes an arbitrary query string against the active database.
     *
     * Use this function for SELECT queries if it is just a simple query string.
     * If the caller or other modules need to change the query, use db_select()
     * instead.
     *
     * Do not use this function for INSERT, UPDATE, or DELETE queries. Those should
     * be handled via db_insert(), db_update() and db_delete() respectively.
     *
     * @param $query
     *   The prepared statement query to run. Although it will accept both named and
     *   unnamed placeholders, named placeholders are strongly preferred as they are
     *   more self-documenting.
     * @param $args
     *   An array of values to substitute into the query. If the query uses named
     *   placeholders, this is an associative array in any order. If the query uses
     *   unnamed placeholders (?), this is an indexed array and the order must match
     *   the order of placeholders in the query string.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return DatabaseStatementInterface
     *   A prepared statement object, already executed.
     *
     * @see DatabaseConnection::defaultOptions()
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_query/7
     */
    public function db_query() {
        $args = func_get_args();
        return call_user_func_array('db_query', $args);
    }

    /**
     * Executes a query against the active database, restricted to a range.
     *
     * @param $query
     *   The prepared statement query to run. Although it will accept both named and
     *   unnamed placeholders, named placeholders are strongly preferred as they are
     *   more self-documenting.
     * @param $from
     *   The first record from the result set to return.
     * @param $count
     *   The number of records to return from the result set.
     * @param $args
     *   An array of values to substitute into the query. If the query uses named
     *   placeholders, this is an associative array in any order. If the query uses
     *   unnamed placeholders (?), this is an indexed array and the order must match
     *   the order of placeholders in the query string.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return DatabaseStatementInterface
     *   A prepared statement object, already executed.
     *
     * @see DatabaseConnection::defaultOptions()
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_query_range/7
     */
    public function db_query_range($query, $from, $count, array $args = array(), array $options = array()) {
        return db_query_range($query, $from, $count, $args, $options);
    }

    /**
     * Executes a query string and saves the result set to a temporary table.
     *
     * The execution of the query string happens against the active database.
     *
     * @param $query
     *   The prepared statement query to run. Although it will accept both named and
     *   unnamed placeholders, named placeholders are strongly preferred as they are
     *   more self-documenting.
     * @param $args
     *   An array of values to substitute into the query. If the query uses named
     *   placeholders, this is an associative array in any order. If the query uses
     *   unnamed placeholders (?), this is an indexed array and the order must match
     *   the order of placeholders in the query string.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return
     *   The name of the temporary table.
     *
     * @see DatabaseConnection::defaultOptions()
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_query_temporary/7
     */
    function db_query_temporary($query, array $args = array(), array $options = array()) {
        return db_query_temporary($query, $args, $options);
    }

    /**
     * Renames a table.
     *
     * @param $table
     *   The table to be renamed.
     * @param $new_name
     *   The new name for the table.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_rename_table/7
     */
    function db_rename_table($table, $new_name) {
        db_rename_table($table, $new_name);
    }

    /**
     * Returns a new SelectQuery object for the active database.
     *
     * @param $table
     *   The base table for this query. May be a string or another SelectQuery
     *   object. If a query object is passed, it will be used as a subselect.
     * @param $alias
     *   The alias for the base table of this query.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return SelectQuery
     *   A new SelectQuery object for this connection.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_select/7
     */
    function db_select($table, $alias = NULL, array $options = array()) {
        return db_select($table, $alias, $options);
    }

    /**
     * Sets a new active database.
     *
     * @param $key
     *   The key in the $databases array to set as the default database.
     *
     * @return
     *   The key of the formerly active database.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_set_active/7
     */
    function db_set_active($key = 'default') {
        return db_set_active($key);
    }

    /**
     * Checks if a table exists.
     *
     * @param $table
     *   The name of the table in drupal (no prefixing).
     *
     * @return
     *   TRUE if the given table exists, otherwise FALSE.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_table_exists/7
     */
    function db_table_exists($table) {
        return db_table_exists($table);
    }

    /**
     * Returns a new transaction object for the active database.
     *
     * @param string $name
     *   Optional name of the transaction.
     * @param array $options
     *   An array of options to control how the transaction operates:
     *   - target: The database target name.
     *
     * @return DatabaseTransaction
     *   A new DatabaseTransaction object for this connection.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_transaction/7
     */
    function db_transaction($name = NULL, array $options = array()) {
        return db_transaction($name, $options);
    }

    /**
     * Returns a new TruncateQuery object for the active database.
     *
     * @param $table
     *   The table from which to delete.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return TruncateQuery
     *   A new TruncateQuery object for this connection.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_truncate/7
     */
    function db_truncate($table, array $options = array()) {
        return db_truncate($table, $options);
    }

    /**
     * Returns a new UpdateQuery object for the active database.
     *
     * @param $table
     *   The table to update.
     * @param $options
     *   An array of options to control how the query operates.
     *
     * @return UpdateQuery
     *   A new UpdateQuery object for this connection.
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_update/7
     */
    public function db_update($table, array $options = array()) {
        return db_update($table, $options);
    }

    /**
     * Returns a new DatabaseCondition, set to "XOR" all conditions together.
     *
     * @return DatabaseCondition
     *
     * @link http://api.drupal.org/api/drupal/includes!database!database.inc/function/db_xor/7
     */
    function db_xor() {
        return db_xor();
    }
}
