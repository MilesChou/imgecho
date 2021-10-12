<?php

declare(strict_types=1);

namespace Tests\Unit;

use MilesChou\ImgEcho\ImgEcho;
use Tests\TestCase;

class ImgEchoTest extends TestCase
{
    /**
     * @test
     */
    public function testShouldOutputStringImage(): void
    {
        $actual = (new ImgEcho())
            ->withImage('image')
            ->build();

        $this->assertStringContainsString(':' . base64_encode('image') . "\007", $actual);
    }

    /**
     * @test
     */
    public function testShouldOutputCallableStringImage(): void
    {
        $actual = (new ImgEcho())
            ->withImage(function () {
                return 'image';
            })
            ->build();


        $this->assertStringContainsString(':' . base64_encode('image') . "\007", $actual);
    }

    /**
     * @test
     */
    public function testShouldOutputNameOption(): void
    {
        $actual = (new ImgEcho())
            ->withName('whatever')
            ->withImage('dummy')
            ->build();

        $this->assertStringContainsString('name=whatever', $actual);
    }

    /**
     * @test
     */
    public function testShouldOutputWidthOption(): void
    {
        $actual = (new ImgEcho())
            ->withWidth('100%')
            ->withImage('dummy')
            ->build();

        $this->assertStringContainsString('width=100%', $actual);
    }

    /**
     * @test
     */
    public function testShouldOutputHeightOption(): void
    {
        $actual = (new ImgEcho())
            ->withHeight('100%')
            ->withImage('dummy')
            ->build();

        $this->assertStringContainsString('height=100%', $actual);
    }

    /**
     * @test
     */
    public function testShouldOutputDisableAspectRatioOption(): void
    {
        $actual = (new ImgEcho())
            ->disableAspectRatio()
            ->withImage('dummy')
            ->build();

        $this->assertStringContainsString('preserveAspectRatio=0', $actual);
    }
}
