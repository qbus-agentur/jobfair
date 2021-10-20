<?php
namespace Dan\Jobfair\Utility;

use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * This class provides misc functions (mostly file related) for the jobfair extension.
 *
 * @author Dan <typo3dev@outlook.com>
 */
class Div {

	/**
	 * configurationManager
	 *
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 */
	protected $configurationManager;

    public function __construct(ConfigurationManager $configurationManager)
    {
        $this->configurationManager = $configurationManager;
    }

	/**
	 * Upload file
	 *
	 * @param \array $attachmentFile
	 * @return mixed	false or file.xyz
	 */
	public function uploadFile($attachmentFile) {
		// create new filename and upload it
		$basicFileFunctions = GeneralUtility::makeInstance('TYPO3\CMS\Core\Utility\File\BasicFileUtility');
		$newFile = $basicFileFunctions->getUniqueName(
				$attachmentFile['name'],
				GeneralUtility::getFileAbsFileName( self::getUploadFolderFromTca() )
		);
		#\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newFile,'$newFile in uploadFile()');
		if (GeneralUtility::upload_copy_move($attachmentFile['tmp_name'], $newFile)) {
			$fileInfo = pathinfo($newFile);
			return $fileInfo['basename'];
		}
		return FALSE;
	}

	/**
	 * Check extension of given filename
	 *
	 * @param \string		Filename like (upload.png)
	 * @return \bool		If Extension is allowed
	 */
	public static function checkExtension($filename) {
		$extensionList = $GLOBALS['TCA']['tx_jobfair_domain_model_application']['columns']['attachment']['config']['allowed'];
		$fileInfo = pathinfo($filename);
		if (!empty($fileInfo['extension']) && GeneralUtility::inList($extensionList, strtolower($fileInfo['extension']))) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Read upload folder of the attachment from TCA
	 *
	 * @return \string path - standard "uploads/pics"
	 */
	public static function getUploadFolderFromTca() {
		$path = $GLOBALS['TCA']['tx_jobfair_domain_model_application']['columns']['attachment']['config']['uploadfolder'];
		if (empty($path)) {
			$path = 'uploads/pics';
		}
		return $path;
	}

	/**
	 * Generate and send Email
	 *
	 * @param \string Template file in Templates/Email/
	 * @param \array $receiver Combination of Email => Name
	 * @param \array $receiverCc Combination of Email => Name
	 * @param \array $receiverBcc Combination of Email => Name
	 * @param Address $sender Combination of Email => Name
	 * @param \string $subject Mail subject
	 * @param \array $variables Variables for assignMultiple
	 * @param \string $fileName
	 * @return \bool Mail was sent?
	 */
	public function sendEmail($template, $receiver, $receiverCc, $receiverBcc, $sender, $subject, $variables, $fileName) {
        $email = GeneralUtility::makeInstance(FluidEmail::class);
        $email
            ->to(...$receiver)
            ->from($sender)
            ->subject($subject)
            ->format('html')
            ->setTemplate($template)
            ->assignMultiple($variables);

        if ($fileName) {
            $absFilePath = GeneralUtility::getFileAbsFileName('uploads/tx_jobfair/' . $fileName);
            $email->attachFromPath($absFilePath);
        }

        $mailer = GeneralUtility::makeInstance(Mailer::class);
        $mailer->send($email);

		return $mailer->getSentMessage() !== null;
	}
}
