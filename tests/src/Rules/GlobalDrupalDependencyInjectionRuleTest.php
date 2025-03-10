<?php declare(strict_types=1);

namespace mglaman\PHPStanDrupal\Tests\Rules;

use mglaman\PHPStanDrupal\Rules\Drupal\GlobalDrupalDependencyInjectionRule;
use mglaman\PHPStanDrupal\Tests\DrupalRuleTestCase;

final class GlobalDrupalDependencyInjectionRuleTest extends DrupalRuleTestCase {

    protected function getRule(): \PHPStan\Rules\Rule
    {
        return new GlobalDrupalDependencyInjectionRule();
    }

    /**
     * @dataProvider resultData
     *
     * @param list<array{0: string, 1: int, 2?: string|null}> $errorMessages
     */
    public function testRule(string $path, array $errorMessages): void
    {
        $this->analyse([$path], $errorMessages);
    }

    public static function resultData(): \Generator
    {
        yield [
            __DIR__ . '/data/drupal-static.php',
            [],
        ];
        yield [
            __DIR__ . '/../../fixtures/drupal/modules/phpstan_fixtures/src/UsesDeprecatedUrlFunction.php',
            [
                [
                    '\Drupal calls should be avoided in classes, use dependency injection instead',
                    07
                ],
            ]
        ];
        yield [
            __DIR__ . '/../../fixtures/drupal/modules/phpstan_fixtures/src/TestServicesMappingExtension.php',
            [
                [
                    '\Drupal calls should be avoided in classes, use dependency injection instead',
                    07
                ],
                [
                    '\Drupal calls should be avoided in classes, use dependency injection instead',
                    13
                ],
            ]
        ];
        yield [
            __DIR__ . '/../../fixtures/drupal/modules/phpstan_fixtures/src/Entity/ReflectionEntityTest.php',
            [],
        ];

        yield [
            __DIR__ . '/data/bug-515.php',
            [],
        ];

        yield [
            __DIR__ . '/data/bug-580.php',
            [],
        ];

        yield [
            __DIR__ . '/data/bug-500.php',
            [],
        ];

    }


}
