<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * This is the categories-action, it will display the overview of categories
 *
 * @author Bart Lagerweij <bart@webleads.nl>
 */
class BackendNavigationBlockCategories extends BackendBaseActionIndex
{
	/**
	 * Execute the action
	 */
	public function execute()
	{
		parent::execute();
		$this->loadDataGrid();

		$this->parse();
		$this->display();
	}

	/**
	 * Load the dataGrid
	 */
	private function loadDataGrid()
	{
		$this->dataGrid = new BackendDataGridDB(
			BackendNavigationBlockModel::QRY_DATAGRID_BROWSE_CATEGORIES,
			BL::getWorkingLanguage()
		);

		// check if this action is allowed
		if(BackendAuthentication::isAllowedAction('edit_category'))
		{
			$this->dataGrid->addColumn(
				'edit', null, BL::lbl('Edit'),
				BackendModel::createURLForAction('edit_category') . '&amp;id=[id]',
				BL::lbl('Edit')
			);
		}

		// sequence
		$this->dataGrid->enableSequenceByDragAndDrop();
		$this->dataGrid->setAttributes(array('data-action' => 'sequence_categories'));
	}

	/**
	 * Parse & display the page
	 */
	protected function parse()
	{
		$this->tpl->assign('dataGrid', (string) $this->dataGrid->getContent());
	}
}
