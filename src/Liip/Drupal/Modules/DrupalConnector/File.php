<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Patrick Jezek <patrick.jezek@liip.ch>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Module
 */

namespace Liip\Drupal\Modules\DrupalConnector;

class File
{
    /**
     * Deletes a file and its database record.
     *
     * If the $force parameter is not TRUE, file_usage_list() will be called to
     * determine if the file is being used by any modules. If the file is being
     * used the delete will be canceled.
     *
     * @param $file
     *   A file object.
     * @param $force
     *   Boolean indicating that the file should be deleted even if the file is
     *   reported as in use by the file_usage table.
     *
     * @return mixed
     *   TRUE for success, FALSE in the event of an error, or an array if the file
     *   is being used by any modules.
     *
     * @see file_unmanaged_delete()
     * @see file_usage_list()
     * @see file_usage_delete()
     * @see hook_file_delete()
     */
    function file_delete(\stdClass $file, $force = FALSE) {
        return file_delete($file, $force);
    }

    /**
     * Loads a single file object from the database.
     *
     * @param $fid
     *   A file ID.
     *
     * @return
     *   An object representing the file, or FALSE if the file was not found.
     *
     * @see hook_file_load()
     * @see file_load_multiple()
     */
    function file_load($fid) {
        return file_load($fid);
    }

    /**
     * Gets the default file stream implementation.
     *
     * @return
     *   'public', 'private' or any other file scheme defined as the default.
     */
    function file_default_scheme() {
        return file_default_scheme();
    }

    /**
     * Checks that the directory exists and is writable.
     *
     * Directories need to have execute permissions to be considered a directory by
     * FTP servers, etc.
     *
     * @param $directory
     *   A string reference containing the name of a directory path or URI. A
     *   trailing slash will be trimmed from a path.
     * @param $options
     *   A bitmask to indicate if the directory should be created if it does
     *   not exist (FILE_CREATE_DIRECTORY) or made writable if it is read-only
     *   (FILE_MODIFY_PERMISSIONS).
     *
     * @return
     *   TRUE if the directory exists (or was created) and is writable. FALSE
     *   otherwise.
     */
    function file_prepare_directory(&$directory, $options = FILE_MODIFY_PERMISSIONS) {
        return file_prepare_directory($directory, $options);
    }

    /**
     * Normalizes a URI by making it syntactically correct.
     *
     * A stream is referenced as "scheme://target".
     *
     * The following actions are taken:
     * - Remove trailing slashes from target
     * - Trim erroneous leading slashes from target. e.g. ":///" becomes "://".
     *
     * @param $uri
     *   String reference containing the URI to normalize.
     *
     * @return
     *   The normalized URI.
     */
    function file_stream_wrapper_uri_normalize($uri) {
        return file_stream_wrapper_uri_normalize($uri);
    }

    /**
     * Saves a file to the specified destination and creates a database entry.
     *
     * @param $data
     *   A string containing the contents of the file.
     * @param $destination
     *   A string containing the destination URI. This must be a stream wrapper URI.
     *   If no value is provided, a randomized name will be generated and the file
     *   will be saved using Drupal's default files scheme, usually "public://".
     * @param $replace
     *   Replace behavior when the destination file already exists:
     *   - FILE_EXISTS_REPLACE - Replace the existing file. If a managed file with
     *       the destination name exists then its database entry will be updated. If
     *       no database entry is found then a new one will be created.
     *   - FILE_EXISTS_RENAME - Append _{incrementing number} until the filename is
     *       unique.
     *   - FILE_EXISTS_ERROR - Do nothing and return FALSE.
     *
     * @return
     *   A file object, or FALSE on error.
     *
     * @see file_unmanaged_save_data()
     */
    function file_save_data($data, $destination = NULL, $replace = FILE_EXISTS_RENAME) {
        return file_save_data($data, $destination, $replace);
    }

}
