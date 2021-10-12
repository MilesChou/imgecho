<?php

declare(strict_types=1);

namespace MilesChou\ImgEcho;

/**
 * @see https://iterm2.com/documentation-images.html
 */
class ImgEcho
{
    public static $program = 'iTerm.app';

    /**
     * @var bool
     */
    private $aspectRatio = true;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var callable
     */
    private $image;

    /**
     * Check terminal app
     *
     * @return bool
     */
    public static function isSupport(): bool
    {
        return self::$program === getenv('TERM_PROGRAM');
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withWidth($width): self
    {
        $this->width = $width;

        return $this;
    }

    public function withHeight($height): self
    {
        $this->height = $height;

        return $this;
    }

    public function disableAspectRatio(): self
    {
        $this->aspectRatio = false;

        return $this;
    }

    public function enableAspectRatio(): self
    {
        $this->aspectRatio = true;

        return $this;
    }

    /**
     * @param string|callable $image Binary or callable to resolve binary
     * @return $this
     */
    public function withImage($image): self
    {
        if (is_string($image) || !is_callable($image)) {
            $image = static function () use ($image) {
                return $image;
            };
        }

        $this->image = $image;

        return $this;
    }

    public function build(): string
    {
        $str = "\033]1337;File=inline=1;";

        if ($this->name) {
            $str .= "name={$this->name};";
        }

        if ($this->width) {
            $str .= "width={$this->width};";
        }

        if ($this->height) {
            $str .= "height={$this->height};";
        }

        if (!$this->aspectRatio) {
            $str .= "preserveAspectRatio=0;";
        }

        return $str . ':' . base64_encode($this->resolveImage()) . "\007";
    }

    /**
     * Send to terminal
     *
     * @param bool $newline
     */
    public function send(bool $newline = true): void
    {
        echo $this->build();

        if ($newline) {
            echo PHP_EOL;
        }
    }

    private function resolveImage(): string
    {
        $callable = $this->image;

        return $callable($this);
    }
}
