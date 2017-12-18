<?php

namespace Awps;

/**
 * Class Loader
 *
 * Simple loader that is designed to work with both classes and normal PHP files.
 *
 * @package Awps
 */
class Loader {

	/**
	 * Register classes autoloader
	 *
	 * @param string $load_from_path
	 * @param string $namespace
	 */
	public static function loadClasses( $load_from_path, $namespace ) {
		new LoadClasses( static::normalizeSlash( $load_from_path ), $namespace );
	}

	/**
	 * Autoload php files
	 *
	 * @param string $load_from_path
	 * @param string $pattern
	 */
	public static function loadFiles( $load_from_path, $pattern ) {
		new LoadFiles( static::normalizeSlash( $load_from_path ), $pattern );
	}

	/**
	 * Normalize last slash.
	 *
	 * Appends a trailing slash if one does not exists and also replaces the backslash;
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public static function normalizeSlash( $string ) {
		return rtrim( $string, '/\\' ) . '/';
	}

}
