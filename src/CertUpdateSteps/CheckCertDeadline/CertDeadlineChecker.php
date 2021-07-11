<?php

namespace It5\CertUpdateSteps\CheckCertDeadline;

use It5\DebugLibs\DebugLib;
use It5\Localization\Ru;

class CertDeadlineChecker
{
    public function check(string $certPath, int $criticalRemainingDays): bool
    {
        $result = true;

        if (filetype($certPath)) {
            $certDeadline = $this->getCertDeadlineString($certPath);
            if (!$this->checkNeedUpdate($certDeadline, $criticalRemainingDays)) {
                $result = false;
            }
        }

        return $result;
    }

    private function getCertDeadlineString(string $certPath): string
    {
        $commandResult = `openssl x509 -enddate -noout -in {$certPath}`;
        $commandResult = str_replace("\n", '', $commandResult);
        $commandResult = trim($commandResult);
        $commandResult = str_replace('notAfter=', '', $commandResult);
        $testTime = strtotime($commandResult);
        if (!$testTime) {
            DebugLib::dump(Ru::get('errors.openssl_error'));
        }

        return $commandResult;
    }

    private function checkNeedUpdate(string $certDeadline, int $criticalRemainingDays): bool
    {
        $deadLineTimestamp = strtotime($certDeadline);
        $currentTimestamp = time();

        if ($deadLineTimestamp) {
            $needUpdate = ($deadLineTimestamp - $currentTimestamp) < $criticalRemainingDays * 24 * 3600;
        } else {
            $needUpdate = false;
        }

        return $needUpdate;
    }
}