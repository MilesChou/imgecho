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
    public function sample(): void
    {
        $this->assertTrue((new ImgEcho())->alwaysTrue());
    }
}
