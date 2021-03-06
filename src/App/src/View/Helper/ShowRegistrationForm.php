<?php
/**
 * This file is part of the mimmi20/mezzio-sample-project package.
 *
 * Copyright (c) 2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

/**
 * viewhelper to show the Novum registration form
 */

namespace App\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Mezzio\Template\TemplateRendererInterface;

final class ShowRegistrationForm extends AbstractHelper
{
    /** @var array<string, array<string, string>|string> */
    private array $novumConfig;

    private TemplateRendererInterface $template;

    /**
     * @param array<string, array<string, string>|string> $novumConfig
     */
    public function __construct(TemplateRendererInterface $template, array $novumConfig)
    {
        $this->template    = $template;
        $this->novumConfig = $novumConfig;
    }

    /**
     * Output the register form
     */
    public function __invoke(string $novumPartner, bool $includetipGiver = false): string
    {
        $data = [
            'novumConfig' => $this->novumConfig,
            'includetipGiver' => true,
            'layout' => false,
        ];

        if ($includetipGiver) {
            $data['partnerCode']     = $novumPartner;
            $data['includetipGiver'] = true;
        }

        return $this->template->render(
            'components::container/register-novum.phtml',
            $data
        );
    }
}
