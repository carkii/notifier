<?php

namespace Carkii\Notifier\contracts;

interface NotifierInterface
{
	/**
	 * Get only what is not acknowledged	 
	 * @return array notifications
	 */
	public function get();
	
	/**
	 * Get all notifications		 
	 * @return array notifications
	 */
	public function getAll();

	/**
	 * Number of not acknowledged notifications 	 
	 * @return init|null number of notifications
	 */
	public function count();

	/**
	 * Number of all notifications 	 
	 * @return init|null number of notifications
	 */
	public function countAll();

}