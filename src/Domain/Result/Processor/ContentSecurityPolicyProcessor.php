<?php declare(strict_types=1);

/**
 * @license  http://opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/nicoSWD
 * @author   Nicolas Oelgart <nico@oelgart.com>
 */
namespace nicoSWD\SecHeaderCheck\Domain\Result\Processor;

use nicoSWD\SecHeaderCheck\Domain\Result\ObservationCollection;
use nicoSWD\SecHeaderCheck\Domain\Result\Result\ContentSecurityPolicyHeaderResult;
use nicoSWD\SecHeaderCheck\Domain\Result\ParsedHeaders;
use nicoSWD\SecHeaderCheck\Domain\Result\Warning\ContentSecurityPolicyMissingFrameAncestorsDirectiveWarning;

final class ContentSecurityPolicyProcessor extends AbstractProcessor
{
    public function process(ParsedHeaders $parsedHeaders): void
    {
        $contentSecurityPolicyHeader = $this->header();
        $hasSecureFrameAncestors = false;
        $hasSecureXFrameOptions = false;
        $observations = new ObservationCollection();

        if ($contentSecurityPolicyHeader->isSecure()) {
            $hasSecureFrameAncestors = true;
        }

        $xFrameOptionsHeader = $parsedHeaders->getXFrameOptionsResult();

        if ($xFrameOptionsHeader && $xFrameOptionsHeader->isSecure()) {
            $hasSecureXFrameOptions = true;
        }

        if (!$hasSecureXFrameOptions) {
            if ($contentSecurityPolicyHeader && !$hasSecureFrameAncestors) {
                $observations->addWarning(new ContentSecurityPolicyMissingFrameAncestorsDirectiveWarning());
            }
        }

        $this->addObservations($observations);
    }

    private function header(): ContentSecurityPolicyHeaderResult
    {
        return $this->parsedHeader;
    }
}
