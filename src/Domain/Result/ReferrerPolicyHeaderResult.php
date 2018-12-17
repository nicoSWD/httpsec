<?php declare(strict_types=1);

/**
 * @license  http://opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/nicoSWD
 * @author   Nicolas Oelgart <nico@oelgart.com>
 */
namespace nicoSWD\SecHeaderCheck\Domain\Result;

final class ReferrerPolicyHeaderResult extends AbstractHeaderAuditResult
{
    private $mayLeakOrigin = true;
    private $doesNotLeakReferrer = false;

    public function isSecure(): bool
    {
        return $this->doesNotLeakReferrer();
    }

    public function isMayLeakOrigin(): bool
    {
        return $this->mayLeakOrigin;
    }

    public function setMayLeakOrigin(bool $mayLeakOrigin): void
    {
        $this->mayLeakOrigin = $mayLeakOrigin;
    }

    public function doesNotLeakReferrer(): bool
    {
        return $this->doesNotLeakReferrer;
    }

    public function setDoesNotLeakReferrer(bool $doesNotLeakReferrer): void
    {
        $this->doesNotLeakReferrer = $doesNotLeakReferrer;
    }
}
