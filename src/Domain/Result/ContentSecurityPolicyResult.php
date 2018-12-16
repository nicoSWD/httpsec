<?php declare(strict_types=1);

/**
 * @license  http://opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/nicoSWD
 * @author   Nicolas Oelgart <nico@oelgart.com>
 */
namespace nicoSWD\SecHeaderCheck\Domain\Result;

use nicoSWD\SecHeaderCheck\Domain\Result\Warning\ContentSecurityPolicyMissingFrameAncestorsDirective;

final class ContentSecurityPolicyResult extends GenericHeaderAuditResult
{
    public function hasSecureFrameAncestorsDirective(): bool
    {
        return !$this->headerValidator->hasWarning(ContentSecurityPolicyMissingFrameAncestorsDirective::class);
    }
}
