<?php

// State Interface
interface State {
    public function handle(Context $context): void;
}

// Concrete States
class ConcreteStateA implements State {
    public function handle(Context $context): void {
        echo "State A handling request\n";
        $context->setState(new ConcreteStateB());
    }
}

class ConcreteStateB implements State {
    public function handle(Context $context): void {
        echo "State B handling request\n";
        $context->setState(new ConcreteStateA());
    }
}

// Context
class Context {
    private State $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function setState(State $state): void {
        $this->state = $state;
    }

    public function request(): void {
        $this->state->handle($this);
    }
}

// Client
$context = new Context(new ConcreteStateA());
$context->request();
$context->request();
$context->request();
