<?php

// Implementor
interface Renderer {
    public function renderCircle(float $radius): string;
}

// Concrete Implementors
class VectorRenderer implements Renderer {
    public function renderCircle(float $radius): string {
        return "Drawing a circle of radius {$radius} using vectors";
    }
}

class RasterRenderer implements Renderer {
    public function renderCircle(float $radius): string {
        return "Drawing a circle of radius {$radius} using pixels";
    }
}

// Abstraction
abstract class Shape {
    protected Renderer $renderer;

    public function __construct(Renderer $renderer) {
        $this->renderer = $renderer;
    }

    abstract public function draw(): string;
}

// Refined Abstraction
class Circle extends Shape {
    private float $radius;

    public function __construct(Renderer $renderer, float $radius) {
        parent::__construct($renderer);
        $this->radius = $radius;
    }

    public function draw(): string {
        return $this->renderer->renderCircle($this->radius);
    }
}

// Client
$vectorCircle = new Circle(new VectorRenderer(), 5);
$rasterCircle = new Circle(new RasterRenderer(), 10);

echo $vectorCircle->draw() . PHP_EOL;
echo $rasterCircle->draw();