<?php
/*
 * @copyright   Copyright (C) 2010-2021 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */


namespace Combodo\iTop\CombodoEmailSynchro\Test\UnitTest\Unitary;

use Combodo\iTop\Test\UnitTest\ItopTestCase;
use RawEmailMessage;

/**
 * Class ValidateEmlFilesTest
 *
 * Use EML files in `/test/emailsSample`
 *
 * @package Combodo\iTop\Test\UnitTest\CombodoEmailSynchro
 */
class ValidateEmlFilesTest extends ItopTestCase
{

	/**
	 * @inheritDoc
	 */
	protected function LoadRequiredItopFiles(): void
	{
		parent::LoadRequiredItopFiles();

		$this->RequireOnceItopFile('env-production/combodo-email-synchro/classes/rawemailmessage.class.inc.php');
	}

	/**
	 * @dataProvider EmailMessageProvider
	 */
	public function testEmailMessage($sFileName, $sComment, $bToIsEmpty)
	{
		$oEmail = RawEmailMessage::FromFile($sFileName);

		$sSubject = $oEmail->GetSubject();
		$this->assertNotEmpty($sSubject);

		$aSender = $oEmail->GetSender();
		$this->assertValidEmailCollection($aSender, 'Sender is valid');

		$aTo = $oEmail->GetTo();
		if ($bToIsEmpty)
		{
			$this->assertEmptyCollection($aTo, 'To is empty');
		}
		else
		{
			$this->assertValidEmailCollection($aTo, 'To is valid');
		}

		$aCc = $oEmail->GetCc();
		$this->assertValidEmailCollection($aCc, 'CC is valid');


		$sTextBody = $oEmail->GetTextBody();
		$sHTMLBody = $oEmail->GetHTMLBody();

		$this->assertFalse(($sTextBody == null) && ($sHTMLBody == null), 'No body found. (neither text not HTML).');


		$aAttachments = $oEmail->GetAttachments();
		foreach ($aAttachments as $aAttachment)
		{
			$this->assertArrayHasKey('filename', $aAttachment);
			$this->assertArrayHasKey('mimeType', $aAttachment);
			$this->assertArrayHasKey('content', $aAttachment);
		}
	}

	private function assertEmptyCollection($aEmails, $message = '')
	{
		foreach ($aEmails as $aAddr)
		{
			$this->assertEmpty($aAddr['email'], $message);
		}
	}

	private function assertValidEmailCollection($aEmails, $message = '')
	{
		foreach ($aEmails as $aAddr)
		{
			$this->assertArrayHasKey('email', $aAddr, $message);
			$this->assertValidEmail($aAddr['email'], $message);
		}
	}

	private function assertValidEmail($email, $message = '')
	{
		$qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
		$dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
		$atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.
			'\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
		$quoted_pair = '\\x5c[\\x00-\\x7f]';
		$domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";
		$quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";
		$domain_ref = $atom;
		$sub_domain = "($domain_ref|$domain_literal)";
		$word = "($atom|$quoted_string)";
		$domain = "$sub_domain(\\x2e$sub_domain)*.?";
		$local_part = "$word(\\x2e$word)*";
		$addr_spec = "$local_part\\x40$domain";
		$this->assertMatchesRegularExpression("!^$addr_spec$!", $email, $message);
	}

	public function EmailMessageProvider()
	{
		$aFiles = glob(__DIR__ . '/../resources/email-samples/*.eml');

		$aMetaData = array(
			'email_042.eml' => array(
				'bToIsEmpty' => true,
			),
			'email_045.eml' => array(
				'bToIsEmpty' => true,
			),
		);

		$aReturn = array();
		foreach ($aFiles as $sFile)
		{
			$sTestName = basename($sFile);

			$aReturn[$sTestName] = array(
				'sFile'      => $sFile,
				'sComment'   => isset($aMetaData[$sTestName]['sComment']) ? $aMetaData[$sTestName]['sComment'] : '',
				'bToIsEmpty' => isset($aMetaData[$sTestName]['bToIsEmpty']) ? $aMetaData[$sTestName]['bToIsEmpty'] : false,
			);
		}

		return $aReturn;
	}

	/**
	 * @dataProvider MultilineLongSubjectsProvider
	 */
	public function testMultilineLongSubjects($sEmailFilename, $sSubjectExpectedValue): void
	{
		$sEmlFilePath = __DIR__.'/../resources/email-samples/'.$sEmailFilename;
		$this->assertFileExists($sEmlFilePath, 'EML file is not existing');

		$oEmail = RawEmailMessage::FromFile($sEmlFilePath);
		$sSubjectActualValue = $oEmail->GetSubject();
		$this->assertSame($sSubjectExpectedValue, $sSubjectActualValue, "File `{$sEmailFilename}` : decoded subject has a wrong value");
	}

	public function MultilineLongSubjectsProvider(): array
	{
		return [
			['multi_lines_header_parsing.eml', 'Re: autonet backup: nanobeam-ma15-sec-kunde.mgmt (1047) [Space.NET R-201909190397]'],
			['email_133_kb4170_multiple_lines_encoded_data.eml', 'FW: ⚠ This is a test with an emoji in the subject and a long subject message which will cause multi line subjects and encoding'],
			['email_065.eml', 'Re: iTop - Enhancement request - Classes et héritage'],
			['email_077.eml', 'Vente Flash Otto Office ! Spécial High-Tech, attention stocks limités !'],
			['email_107.eml', 'Fwd: Suite entretien téléphonique de ce jour'],
			['test gmail.eml', 'Test de mail envoyé avec Gmail et contenant un très très long sujet avec d\'aillleurs aussi des caractères accentués histoire de voir ce qui se passe dans ce cas là. Je sais c\'est un peu exagéré, enfin à peine...'],
		];
	}
}
