<?php

namespace Awps;

class LoadFiles {

	/**
	 * The root path to load files from
	 *
	 * @var string
	 */
	public $load_from_path;

	/**
	 * The pattern to match in file name
	 *
	 * @var string
	 */
	public $pattern;

	/**
	 * LoadFiles constructor.
	 *
	 * @param string $load_from_path
	 * @param string $pattern
	 * @param bool   $recursive
	 */
	public function __construct( $load_from_path, $pattern, $recursive = true ) {
		$this->load_from_path = $load_from_path;
		$this->pattern        = $pattern;

		$this->requireFiles( $load_from_path, $recursive );
	}

	/**
	 * Include PHP files
	 *
	 * @param string $load_from_path
	 * @param bool   $recursive
	 */
	public function requireFiles( $load_from_path, $recursive = true ) {
		$flags    = \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS;
		$iterator = new \FilesystemIterator( $load_from_path, $flags );

		foreach ( $iterator as $path => $item ) {
			if ( $item->isDir() && $recursive ) {
				$this->requireFiles( $path );
			}
			elseif (
				$item->isFile() &&
				strpos( $item->getFilename(), $this->pattern ) !== false &&
				strpos( $item->getFilename(), '.php' ) !== false
			) {
				require_once $path;
			}
		}
	}

}
