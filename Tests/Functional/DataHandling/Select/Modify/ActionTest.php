<?php
namespace TYPO3\CMS\Workspaces\Tests\Functional\DataHandling\Select\Modify;

/***************************************************************
 * Copyright notice
 *
 * (c) 2014 Oliver Hader <oliver.hader@typo3.org>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

require_once dirname(dirname(__FILE__)) . '/AbstractActionTestCase.php';

/**
 * Functional test for the DataHandler
 */
class ActionTest extends \TYPO3\CMS\Workspaces\Tests\Functional\DataHandling\Select\AbstractActionTestCase {

	/**
	 * @var string
	 */
	protected $assertionDataSetDirectory = 'typo3/sysext/workspaces/Tests/Functional/DataHandling/Select/Modify/DataSet/';

	/**
	 * Relations
	 */

	/**
	 * @test
	 * @see DataSet/addElementRelation.csv
	 */
	public function addElementRelation() {
		parent::addElementRelation();
		$this->assertAssertionDataSet('addElementRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #1', 'Element #2', 'Element #3'));
	}

	/**
	 * @test
	 * @see DataSet/deleteElementRelation.csv
	 */
	public function deleteElementRelation() {
		parent::deleteElementRelation();
		$this->assertAssertionDataSet('deleteElementRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #1'));
		$this->assertThat($responseSections, $this->getRequestSectionStructureDoesNotHaveRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #2', 'Element #3'));
	}

	/**
	 * @test
	 * @see DataSet/changeElementSorting.csv
	 */
	public function changeElementSorting() {
		parent::changeElementSorting();
		$this->assertAssertionDataSet('changeElementSorting');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #1', 'Element #2'));
	}

	/**
	 * @test
	 * @see DataSet/changeElementRelationSorting.csv
	 */
	public function changeElementRelationSorting() {
		parent::changeElementRelationSorting();
		$this->assertAssertionDataSet('changeElementRelationSorting');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #1', 'Element #2'));
	}

	/**
	 * @test
	 * @see DataSet/createContentNAddRelation.csv
	 */
	public function createContentAndAddElementRelation() {
		parent::createContentAndAddElementRelation();
		$this->assertAssertionDataSet('createContentNAddRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionHasRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Testing #1'));
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . $this->recordIds['newContentId'])->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #1'));
	}

	/**
	 * @test
	 * @see DataSet/createContentNCreateRelation.csv
	 */
	public function createContentAndCreateElementRelation() {
		parent::createContentAndCreateElementRelation();
		$this->assertAssertionDataSet('createContentNCreateRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionHasRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Testing #1'));
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . $this->recordIds['newContentId'])->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Testing #1'));
	}

	/**
	 * @test
	 * @see DataSet/modifyElementOfRelation.csv
	 */
	public function modifyElementOfRelation() {
		parent::modifyElementOfRelation();
		$this->assertAssertionDataSet('modifyElementOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Testing #1', 'Element #2'));
	}

	/**
	 * @test
	 * @see DataSet/modifyContentOfRelation.csv
	 */
	public function modifyContentOfRelation() {
		parent::modifyContentOfRelation();
		$this->assertAssertionDataSet('modifyContentOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionHasRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Testing #1'));
	}

	/**
	 * @test
	 * @see DataSet/modifyBothSidesOfRelation.csv
	 */
	public function modifyBothSidesOfRelation() {
		parent::modifyBothSidesOfRelation();
		$this->assertAssertionDataSet('modifyBothSidesOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Testing #1', 'Element #2'));
		$this->assertThat($responseSections, $this->getRequestSectionHasRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Testing #1'));
	}

	/**
	 * @test
	 * @see DataSet/deleteContentOfRelation.csv
	 */
	public function deleteContentOfRelation() {
		parent::deleteContentOfRelation();
		$this->assertAssertionDataSet('deleteContentOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionDoesNotHaveRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Testing #1'));
	}

	/**
	 * @test
	 * @see DataSet/deleteElementOfRelation.csv
	 */
	public function deleteElementOfRelation() {
		parent::deleteElementOfRelation();
		$this->assertAssertionDataSet('deleteElementOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureDoesNotHaveRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #1'));
	}

	/**
	 * @test
	 * @see DataSet/copyContentOfRelation.csv
	 */
	public function copyContentOfRelation() {
		parent::copyContentOfRelation();
		$this->assertAssertionDataSet('copyContentOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		// Referenced elements are not copied with the "parent", which is expected and correct
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . $this->recordIds['copiedContentId'])->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #2', 'Element #3'));
	}

	/**
	 * @test
	 * @see DataSet/copyElementOfRelation.csv
	 */
	public function copyElementOfRelation() {
		parent::copyElementOfRelation();
		$this->assertAssertionDataSet('copyElementOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #1'));
		// Referenced elements are not updated at the "parent", which is expected and correct
		$this->assertThat($responseSections, $this->getRequestSectionStructureDoesNotHaveRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #1 (copy 1)'));
	}

	/**
	 * @test
	 * @see DataSet/localizeContentOfRelation.csv
	 */
	public function localizeContentOfRelation() {
		parent::localizeContentOfRelation();
		$this->assertAssertionDataSet('localizeContentOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, self::VALUE_LanguageId, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdLast)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #2', 'Element #3'));
	}

	/**
	 * @test
	 * @see DataSet/localizeElementOfRelation.csv
	 */
	public function localizeElementOfRelation() {
		parent::localizeElementOfRelation();
		$this->assertAssertionDataSet('localizeElementOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, self::VALUE_LanguageId, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('[Translate to Dansk:] Element #1', 'Element #2'));
	}

	/**
	 * @test
	 * @see DataSet/moveContentOfRelationToDifferentPage.csv
	 */
	public function moveContentOfRelationToDifferentPage() {
		parent::moveContentOfRelationToDifferentPage();
		$this->assertAssertionDataSet('moveContentOfRelationToDifferentPage');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageIdTarget, 0, self::VALUE_BackendUserId, self::VALUE_WorkspaceId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdLast)->setRecordField(self::FIELD_ContentElement)
			->setTable(self::TABLE_Element)->setField('title')->setValues('Element #2', 'Element #3'));
	}

}
