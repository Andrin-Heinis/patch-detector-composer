<?php declare(strict_types=1);

namespace aheinis\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;


class PatchRiskDetectorPlugin implements PluginInterface, EventSubscriberInterface {

    public static function getSubscribedEvents(): array {
        return [
            ScriptEvents::POST_INSTALL_CMD => 'checkPatchRisk',
            ScriptEvents::POST_UPDATE_CMD  => 'checkPatchRisk',
        ];
    }

    public function activate(Composer $composer, IOInterface $io): void {}
    public function deactivate(Composer $composer, IOInterface $io): void {}
    public function uninstall(Composer $composer, IOInterface $io): void {}

    public function checkPatchRisk(Event $event): void {
        $io = $event->getIO();
        $composer = $event->getComposer();
        $extra = $composer->getPackage()->getExtra();

        if (empty($extra['patches'])) {
            $io->info('No patches found.');
            return;
        }
        $hasRiskyPatch = false;
        foreach ($extra['patches'] as $patches) {
            foreach ($patches as $url) {
                if ($this->isRiskyPatch($url)) {
                    $hasRiskyPatch = true;
                    $io->error( 'Patch poses code injection risk: ' . $url );
                }
            }

        }
        if ($hasRiskyPatch) {
            $io->error('<info>At least one risky patch found.</info>');
            throw new \RuntimeException('At least one risky patch found.');

        }
    }

    private function isRiskyPatch(string $url): bool {
        $riskyPatterns = [
            '/git\.drupalcode\.org\/.*\/merge_requests\//', // Merge Requests
        ];

        foreach ($riskyPatterns as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }
        return false;
    }
}
