<?php

declare(strict_types=1);

namespace App\Views\Pages\Home;

use AML\Engine\Actions;
use AML\Engine\ClientAction;
use AML\Engine\ClientInstruction;
use AML\Engine\EffectPlan;
use AML\Engine\Effects;
use AML\Engine\StateRef;
use AML\View\Effect;
use AML\View\Page;
use AML\View\State;
use AML\View\View;
use function AML\View\{
    Button,
    Heading,
    HStack,
    MainContent,
    Progress,
    Text,
    Toast,
    VStack
};

final class HomePage extends Page
{
    private const DURATION = 30;

    #[State]
    public int $remaining = self::DURATION;

    #[State]
    public bool $running = false;

    #[State]
    public bool $finished = false;

    #[Effect]
    protected function countdown(): EffectPlan
    {
        return Effects::interval(
            1000,
            Actions::when(
                'running',
                'truthy',
                true,
                Actions::when(
                    'remaining',
                    'gt',
                    1,
                    ClientAction::decrement('remaining'),
                    Actions::sequence(
                        ClientAction::set('remaining', 0),
                        ClientAction::set('running', false),
                        ClientAction::set('finished', true),
                    ),
                ),
            ),
        );
    }

    private function start(): ClientInstruction
    {
        return Actions::when(
            'remaining',
            'lte',
            0,
            Actions::sequence(
                ClientAction::set('remaining', self::DURATION),
                ClientAction::set('finished', false),
                ClientAction::set('running', true),
            ),
            Actions::sequence(
                ClientAction::set('finished', false),
                ClientAction::set('running', true),
            ),
        );
    }

    private function pause(): ClientInstruction
    {
        return ClientAction::set('running', false);
    }

    private function reset(): ClientInstruction
    {
        return Actions::sequence(
            ClientAction::set('running', false),
            ClientAction::set('remaining', self::DURATION),
            ClientAction::set('finished', false),
        );
    }

    public function body(): View
    {
        return MainContent(
            VStack(
                Text('PHPAML View')->class('label'),
                Heading('Minuteur', 1),
                HStack(
                    Text(StateRef::to('remaining', $this->remaining))->class('timer-value'),
                    Text('s')->class('timer-unit'),
                )->class('timer-display'),
                Progress(StateRef::to('remaining', $this->remaining), self::DURATION),
                HStack(
                    Button('Démarrer')->onClick($this->start()),
                    Button('Pause')->onClick($this->pause()),
                    Button('Réinitialiser')->onClick($this->reset()),
                )->class('timer-actions'),
                Toast(
                    StateRef::to('finished', $this->finished),
                    'Temps écoulé !',
                    'success',
                    4000,
                ),
            )->class('timer'),
        )->class('timer-page');
    }
}
