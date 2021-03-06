<?php declare(strict_types=1);

/**
 * @license  http://opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/nicoSWD
 * @author   Nicolas Oelgart <nico@oelgart.com>
 */
namespace nicoSWD\SecHeaderCheck\Domain\Validator\Header;

use nicoSWD\SecHeaderCheck\Domain\Result\Result\ServerHeaderResult;
use nicoSWD\SecHeaderCheck\Domain\Validator\AbstractHeaderParser;

final class ServerHeader extends AbstractHeaderParser
{
    public function parse(): ServerHeaderResult
    {
        return (new ServerHeaderResult($this->getName(), $this->getValue()))
            ->setLeaksServerVersion($this->serverContainsVersionNumber());
    }

    private function serverContainsVersionNumber(): bool
    {
        return preg_match('~\d+\.\d+~', $this->getValue()) === 1;
    }
}
