<?php

namespace Awps;

/**
 * Class LoadClasses
 */
class LoadClasses {

	/**
	 * The root path to load classes from
	 *
	 * @var string
	 */
	public $load_from_path;

	/**
	 * The namespace of loaded classes
	 *
	 * @var string
	 */
	public $namespace;

	/**
	 * Construct
	 *
	 * @param string $load_from_path
	 * @param string $namespace
	 */
	public function __construct( $load_from_path, $namespace ) {
		$this->load_from_path = $load_from_path;
		$this->namespace      = $namespace;

		spl_autoload_register( array( $this, 'autoload' ) );
	}

	/**
	 * Autoload
	 *
	 * @param string $class
	 *
	 * @return void
	 */
	public function autoload( $class ) {
		$prefix = trim( $this->namespace ) . '\\';

		$this->locateClassFile( $class, $prefix, $this->load_from_path );
	}

	/**
	 * Locate files for loader
	 *
	 * @param string $class
	 * @param string $prefix
	 * @param string $load_from_path
	 *
	 * @return void
	 */
	public static function locateClassFile( $class, $prefix, $load_from_path ) {
		// does the class use the namespace prefix?
		$len = strlen( $prefix );
		if ( strncmp( $prefix, $class, $len ) !== 0 ) {
			// no, move to the next registered loader
			return;
		}

		// get the relative class name
		$relative_class = substr( $class, $len );

		// replace the namespace prefix with the base directory, replace namespace
		// separators with directory separators in the relative class name, append
		// with .php
		$file = $load_from_path . str_replace( '\\', '/', $relative_class ) . '.php';

		// if the file exists, require it
		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}

}
