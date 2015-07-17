<?php
/**
 * @package	Joomla.Plugin
 * @subpackage	Quickicon.Joomla
 *
 * @copyright	Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Joomla! php max vars Plugin
 *
 * @since       3.5
 */
class PlgQuickiconMaxvars extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @param   object  &$subject  The object to observe
	 * @param   array   $config    An optional associative array of configuration settings.
	 *                             Recognized key values include 'name', 'group', 'params', 'language'
	 *                             (this list is not meant to be comprehensive).
	 *
	 * @since   3.5
	 */
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);

		$this->loadLanguage();
	}

	/**
	 * This method is called when the Quick Icons module is constructing its set
	 * of icons. You can return an array which defines a single icon and it will
	 * be rendered right after the stock Quick Icons.
	 *
	 * @param   $context  The calling context
	 *
	 * @return  array  A list of icon definition associative arrays, consisting of the
	 *				   keys link, image, text and access.
	 *
	 * @since   3.5
	 */
	public function onGetIcons($context)
	{
		$text         = JText::_('PLG_MAX_VARS');
		$maxinputvars = @ini_get('max_input_vars');
		$varcount     = 0;

		$tables = array(
			'#__categories',
			'#__menu',
			'#__modules',
			'#__usergroups',
		);

		// Get a db connection.
		$db = JFactory::getDbo();

		foreach ($tables as $tableToCheck)
		{
				// Create a new query object.
				$query = $db->getQuery(true);

				$query->select($db->quoteName('id'));
				$query->from($db->quoteName($tableToCheck));

				$db->setQuery($query);
				$db->execute();
				$varcount = $varcount + $db->getNumRows();
		}

		if ($varcount >= $maxinputvars)
		{
			JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_MAX_VARS_FAIL', $text), 'error');
		}
		if (((($maxinputvars - $varcount) / $maxinputvars) * 100) > 80)
		{
			JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_MAX_VARS_WARN', $text), 'warning');
		}
	}	
}
